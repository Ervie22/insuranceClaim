<?php // app/Http/Controllers/Auth/ForgotPasswordController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\ResetPasswordMail;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.forgotpassword');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->input('email'),
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $email = $request->input('email');
        $action_link = route('password.reset.get', ['token' => $token, 'email' => $email]);
        $body = "We are in receipt of your password reset request for MED * A-Eye application. You can reset your password by clicking the link below";

        try {
            Mail::to($email)->send(new ResetPasswordMail($action_link, $body));
        } catch (\Exception $e) {
            return back()->with('error', 'Mail could not be sent. Error: ' . $e->getMessage());
        }

        return back()->with('message', 'We have sent you a reset password link.');
    }
}
