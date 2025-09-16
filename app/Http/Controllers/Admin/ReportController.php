<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class ReportController extends Controller
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
    public function agingReports()
    {

        return view('admin.reports.aging-reports');
    }
    public function billingReports()
    {

        return view('admin.reports.billing-reports');
    }
    public function claimReports()
    {

        return view('admin.reports.claim-reports');
    }
    public function collectionReports()
    {

        return view('admin.reports.collection-reports');
    }
    public function inventoryReports()
    {

        return view('admin.reports.inventory-reports');
    }
    public function managementReports()
    {

        return view('admin.reports.management-reports');
    }
    public function patientReports()
    {

        return view('admin.reports.patient-reports');
    }
    public function payerReports()
    {

        return view('admin.reports.payer-reports');
    }
    public function paymentsReports()
    {

        return view('admin.reports.payments-reports');
    }
    public function timelyReports()
    {

        return view('admin.reports.timely-reports');
    }
}
