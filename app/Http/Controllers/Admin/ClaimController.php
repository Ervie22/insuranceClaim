<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class ClaimController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('roles:admin');
    // }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $uid = Auth::user()->id;
        $user = User::where('id', $uid)->first();
        $fname = $user['first_name'];
        $lname = isset($user['first_name']) ? $user['first_name'] : '';
        $userName = $fname . ' ' . $lname;
        $month = date('m');

        // dd($recentFiles);
        $allUsers = User::where('active', '=', '1')->get();
        return view('admin.claims.claims', compact('allUsers', 'user', 'userName'));
    }
}
