<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class SettingsController extends Controller
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
    public function administration()
    {
        return view('admin.settings.administration');
    }
    public function dxicdSetup()
    {
        return view('admin.settings.dxicd-setup');
    }
    public function interfaceSetup()
    {
        return view('admin.settings.interface-setup');
    }
    public function payerSetup()
    {
        return view('admin.settings.payer-setup');
    }
    public function practiceReferences()
    {
        return view('admin.settings.practice-references');
    }
    public function practiceSetup()
    {
        return view('admin.settings.practice-setup');
    }
    public function printSetup()
    {
        return view('admin.settings.print-setup');
    }
    public function providerSetup()
    {
        return view('admin.settings.provider-setup');
    }
    public function statementSetup()
    {
        return view('admin.settings.statement-setup');
    }
    public function userSetup()
    {
        return view('admin.settings.user-setup');
    }
}
