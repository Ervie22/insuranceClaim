<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\BrevoTestMail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dd('validator');
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // dd('create');
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'roles' => 2, // Default role is User (2)
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */


    public function saveSignup(Request $request)
    {
        $input = $request->all();
        // dd($input);
        $updateUser = new User;
        $updateUser->first_name = $input['firstname'];
        $updateUser->last_name = isset($input['lastname']) ? $input['lastname'] : '';
        $updateUser->email = isset($input['email']) ? $input['email'] : '';
        $updateUser->mobile = isset($input['phone']) ? $input['phone'] : '';
        $updateUser->address1 = isset($input['address1']) ? $input['address1'] : '';
        $updateUser->address2 = isset($input['address2']) ? $input['address2'] : '';
        $updateUser->city = isset($input['city']) ? $input['city'] : '';
        $updateUser->state = isset($input['state']) ? $input['state'] : '';
        $updateUser->zip = isset($input['first_name']) ? $input['first_name'] : '';
        $updateUser->country = isset($input['country']) ? $input['country'] : '';
        $updateUser->password = Hash::make($input['password']);
        $updateUser->roles = 'consumers';
        $updateUser->save();
        // event(new Registered($updateUser)); // <- Sends em
        // Auth::login($updateUser);
        $userId = $updateUser->id;
        // dd($userId);
        if ($userId) {
            $user = User::find($userId);
            // dd($user);
            if ($user && !$user->hasVerifiedEmail()) {
                // dd($user->sendEmailVerificationNotification());
                $user->sendEmailVerificationNotification();

                return 1;
            }
        }

        return 2;
    }
    public function sendBrevoTestEmail()
    {
        try {
            Mail::to('ecvijay08@gmail.com')->send(new BrevoTestMail());
            return response()->json(['message' => 'Test email sent successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function resendVerificationEmail()
    {
        $userId = Session::get('unverified_user_id');
        // dd($userId);
        if ($userId) {
            $user = User::find($userId);
            // dd($user);
            if ($user && !$user->hasVerifiedEmail()) {
                // dd($user->sendEmailVerificationNotification());
                $user->sendEmailVerificationNotification();

                return redirect()->route('login')->with('message', 'Verification email resent!');
            }
        }

        return redirect()->route('login')->with('error', 'Unable to resend verification email.');
    }
    public function verifyEmail($id, $token)
    {
        return view('auth.verify-email', compact('id'));
    }
    public function saveVerify(Request $request)
    {
        $id = $request->user_id;
        $user = User::where('id', $id)->first();
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->save();
        return redirect()->route('login')->with('messager', 'Email Verified!');
    }
}
