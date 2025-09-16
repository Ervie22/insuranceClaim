<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function userManagement()
    {
        $getUsers = User::where('active', '=', '1')->get()->toArray();
        return view('admin.user.user-management', compact('getUsers'));
    }
    public function updateEnable(Request $request)
    {
        $user = User::find($request->user_id);
        if ($user) {
            $user->enabled = $request->enabled;
            $user->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }
    public function getUpdateUser(Request $request)
    {
        $input = $request->all();
        $uid = $input['uid'];
        $getUser = User::where('id', $uid)->first();

        return $getUser;
    }
    public function updateUser(Request $request)
    {
        $input = $request->all();
        $uid = $input['user_id'];
        $name = $input['first_name'];
        $filename = "";
        $filepath = "";
        $file = $request->file('profileUpload');
        if (isset($file)) {
            $extension = $file->getClientOriginalExtension();
            $filename =  $uid . '-' . $name . '.' . $extension;
            $filepath = $file->storeAs('public/patho/profileImages', $filename);
            $file->move(storage_path('app/public/patho/profileImages'), $filename);
        }

        // dd($filename);
        $updateUser = User::where('id', $uid)->first();
        $updateUser->first_name = $input['first_name'];
        $updateUser->last_name = isset($input['last_name']) ? $input['last_name'] : '';
        $updateUser->email = isset($input['email']) ? $input['email'] : '';
        $updateUser->mobile = isset($input['phone']) ? $input['phone'] : '';
        $updateUser->address1 = isset($input['address1']) ? $input['address1'] : '';
        $updateUser->address2 = isset($input['address2']) ? $input['address2'] : '';
        $updateUser->city = isset($input['city']) ? $input['city'] : '';
        $updateUser->state = isset($input['state']) ? $input['state'] : '';
        $updateUser->zip = isset($input['zip']) ? $input['zip'] : '';
        $updateUser->country = isset($input['country']) ? $input['country'] : '';
        $updateUser->roles = isset($input['roles']) ? $input['roles'] : '';
        $updateUser->profile_image_path = isset($file) ? $filepath : $updateUser['profile_image_path'];
        $updateUser->save();
        return redirect()->back();
    }
    public function resetPassword(Request $request)
    {
        $input = $request->all();
        $updateUser = User::where('id', $input['user_id'])->first();
        $updateUser->password = Hash::make($input['password']);
        $updateUser->save();
        // dd($input);
        return 1;
    }
    public function createUser(Request $request)
    {
        $input = $request->all();
        // dd($input);
        $password = $input['firstname'] . '@123$';
        $updateUser = new User;
        $updateUser->first_name = $input['firstname'];
        $updateUser->last_name = isset($input['lastname']) ? $input['lastname'] : '';
        $updateUser->email = isset($input['email']) ? $input['email'] : '';
        $updateUser->email_verified_at = date('Y-m-d H:i:s');
        $updateUser->mobile = isset($input['phone']) ? $input['phone'] : '';
        $updateUser->address1 = isset($input['address1']) ? $input['address1'] : '';
        $updateUser->address2 = isset($input['address2']) ? $input['address2'] : '';
        $updateUser->city = isset($input['city']) ? $input['city'] : '';
        $updateUser->state = isset($input['state']) ? $input['state'] : '';
        $updateUser->zip = isset($input['first_name']) ? $input['first_name'] : '';
        $updateUser->country = isset($input['country']) ? $input['country'] : '';
        $updateUser->password = Hash::make($password);
        $updateUser->roles = 'consumers';
        $updateUser->enabled = 1;
        $updateUser->save();
        return 1;
    }
    public function removeUser(Request $request)
    {
        $input = $request->all();
        $uid = $input['uid'];
        $removeUser = User::where('id', $uid)->first();
        $removeUser->active = '0';
        $removeUser->save();
        return 1;
    }
}
