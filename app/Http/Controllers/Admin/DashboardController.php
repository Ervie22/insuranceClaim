<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\File;
use App\Models\FileJob;

class DashboardController extends Controller
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
        $uploaded = FileJob::whereMonth('created_at', $month)->count('id');
        $pending = FileJob::whereMonth('created_at', $month)->where('status', '=', '1')->count('id');
        $inProgress = FileJob::whereMonth('created_at', $month)->where('status', '=', '2')->count('id');
        $completed = FileJob::where('status', '=', '5')->count('id');
        $analyzisError = FileJob::where('status', '=', '6')->count('id');

        $file = FileJob::whereMonth('created_at', $month)->get();
        $recentFiles = array();
        foreach ($file as $key => $val) {
            $study_id = $val['study_id'];
            $recentFiles[$key]['study_id'] = $study_id;
            $recentFiles[$key]['status'] = $val['status'];
            $recentFiles[$key]['upload_date'] = $val['created_at'];
        }
        // dd($recentFiles);
        $allUsers = User::where('active', '=', '1')->get();
        return view('admin.dashboard', compact('analyzisError', 'allUsers', 'user', 'userName', 'completed', 'inProgress', 'pending', 'uploaded', 'recentFiles'));
    }
}
