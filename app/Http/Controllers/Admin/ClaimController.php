<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\patient;


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
    public function createHcfaClaim(Request $request)
    {
        $patients = Patient::where('is_deleted', '0')->where('active', '1')->get();
        return view('admin.claims.create-hcfa-claim', compact('patients'));
    }
    public function createUb92Claim(Request $request)
    {
        $patients = Patient::where('is_deleted', '0')->where('active', '1')->get();
        return view('admin.claims.create-ub92-claim', compact('patients'));
    }
    public function getPatient($id)
    {
        $patients = Patient::leftJoin('patients_insurance_details as pid', 'pid.patient_id', '=', 'patients.id')
            ->leftJoin('patients_guarantors_details as pgd', 'pgd.patient_id', '=', 'patients.id')
            ->leftJoin('patients_employer_emergency_details as peed', 'peed.patient_id', '=', 'patients.id')
            ->leftJoin('patients_file_details as pfd', 'pfd.patient_id', '=', 'patients.id')
            ->leftJoin('patients_notes as pn', 'pn.patient_id', '=', 'patients.id')
            ->where('patients.id', $id)
            ->select('patients.id as patientID', 'patients.*', 'pid.*', 'pgd.*', 'peed.*', 'pfd.*', 'pn.*')
            ->first();

        return response()->json([
            'success' => true,
            'data' => $patients
        ]);
    }
}
