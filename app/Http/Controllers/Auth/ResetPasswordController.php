<?php
// app/Http/Controllers/Auth/ResetPasswordController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token)
    {
        return view('auth.passwords.reset', ['token' => $token, 'email' => $request->email]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $email = $request->input('email');
        $token = $request->input('token');
        $password = Hash::make($request->input('password'));

        // Get latest password reset request
        $check = DB::table('password_resets')
            ->where('email', $email)
            ->orderBy('created_at', 'desc')
            ->first();

        // Check if token and email exist
        if ($check) {
            if (hash_equals($check->token, $token)) {
                // Update user's password
                User::where('email', $email)->update([
                    'password' => $password
                ]);

                // Delete used token
                DB::table('password_resets')->where('email', $email)->delete();

                return redirect()->route('login')->with('message', 'Password reset successfully');
            } else {
                return back()->with('error', 'Token mismatch or expired. Please request a new password reset link.');
            }
        } else {
            return back()->with('error', 'Invalid email address or reset request not found.');
        }
    }
}
