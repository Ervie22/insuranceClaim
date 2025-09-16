<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class PaymentController extends Controller
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
    public function capitationPayments()
    {

        return view('admin.payments.capitation-payments');
    }
    public function insurancePayouts()
    {

        return view('admin.payments.insurance-payouts');
    }
    public function patientPayments()
    {

        return view('admin.payments.patient-payments');
    }
    public function providerWriteoffs()
    {

        return view('admin.payments.provider-writeoffs');
    }
}
