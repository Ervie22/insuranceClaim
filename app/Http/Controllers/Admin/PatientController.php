<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Patient;
use App\Models\PatientEmployer;
use App\Models\PatientFile;
use App\Models\PatientGuarantor;
use App\Models\PatientInsurance;


class PatientController extends Controller
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
        $patients = Patient::orderBy('id', 'DESC')->get();
        // dd($recentFiles);
        $allUsers = User::where('active', '=', '1')->get();
        return view('admin.patients.patients', compact('patients', 'allUsers', 'user', 'userName'));
    }
    public function createPatient(Request $request)
    {
        return view('admin.patients.create-patient');
    }
    public function updatePersonalInfo(Request $request)
    {
        $input = $request->all();
        $uid = Auth::user()->id;
        $patientId = $input['patient_id'];
        $patientDetails = Patient::where('id', $patientId)->first();
        $patientDetails->first_name = $input['firstname'];
        $patientDetails->last_name = $input['lastname'];
        $patientDetails->mi = $input['mi'];
        $patientDetails->dob = $input['dob'];
        $patientDetails->sex = $input['sex'];
        $patientDetails->ssn = $input['ssn'];
        $patientDetails->homephone = $input['homephone'];
        $patientDetails->mobilephone = $input['mobilephone'];
        $patientDetails->email = $input['email'];
        $patientDetails->address1 = $input['address1'];
        $patientDetails->address2 = $input['address2'];
        $patientDetails->city = $input['city'];
        $patientDetails->state = $input['state'];
        $patientDetails->postcode = $input['postcode'];
        $patientDetails->updated_by = $uid;
        $patientDetails->save();

        // Redirect back to the same page with success message
        return redirect()->back()->with('success', 'Patient information updated successfully!');
    }
    public function updateguarantorInfo(Request $request)
    {
        $input = $request->all();
        $uid = Auth::user()->id;
        $patientId = $input['patient_id'];
        $guarantorDetails = PatientGuarantor::where('patient_id', $patientId)->first();
        $guarantorDetails->first_name = $input['guarantors_firstname'];
        $guarantorDetails->last_name = $input['guarantors_lastname'];
        $guarantorDetails->mi = $input['guarantors_mi'];
        $guarantorDetails->dob = $input['guarantors_dob'];
        $guarantorDetails->status = $input['guarantors_status'];
        $guarantorDetails->relationship = $input['guarantors_relationship'];
        $guarantorDetails->homephone = $input['guarantors_homephone'];
        $guarantorDetails->mobilephone = $input['guarantors_mobilephone'];
        $guarantorDetails->email = $input['guarantors_email'];
        $guarantorDetails->address1 = $input['guarantors_address1'];
        $guarantorDetails->address2 = $input['guarantors_address2'];
        $guarantorDetails->city = $input['guarantors_city'];
        $guarantorDetails->state = $input['guarantors_state'];
        $guarantorDetails->postcode = $input['guarantors_postcode'];
        $guarantorDetails->save();
        // Redirect back to the same page with success message
        return redirect()->back()->with('success', 'Patient information updated successfully!');
    }
    public function updateEmployerInfo(Request $request)
    {
        $input = $request->all();
        $uid = Auth::user()->id;
        $patientId = $input['patient_id'];
        $patientEmployer = PatientEmployer::where('patient_id', $patientId)->first();
        $patientEmployer->employer_name = $input['employer_name'];
        $patientEmployer->department = $input['department'];
        $patientEmployer->employer_phone = $input['employer_phone'];
        $patientEmployer->email = $input['employer_email'];
        $patientEmployer->address1 = $input['employer_address1'];
        $patientEmployer->address2 = $input['employer_address2'];
        $patientEmployer->city = $input['employer_city'];
        $patientEmployer->state = $input['employer_state'];
        $patientEmployer->postcode = $input['employer_postcode'];
        $patientEmployer->save();
        // Redirect back to the same page with success message
        return redirect()->back()->with('success', 'Patient information updated successfully!');
    }
    public function updateEmergencyInfo(Request $request)
    {
        $input = $request->all();
        $uid = Auth::user()->id;
        $patientId = $input['patient_id'];
        $patientEmployer = PatientEmployer::where('patient_id', $patientId)->first();
        $patientEmployer->emergency_contact = $input['emergency_contact'];
        $patientEmployer->relationship = $input['emergency_relationship'];
        $patientEmployer->kin_phone = $input['emergency_phone'];
        $patientEmployer->kin_address = $input['emergency_address'];
        $patientEmployer->save();
        // Redirect back to the same page with success message
        return redirect()->back()->with('success', 'Patient information updated successfully!');
    }
    public function updateFileInfo(Request $request)
    {
        $input = $request->all();
        $uid = Auth::user()->id;
        $patientId = $input['patient_id'];
        $patientFile = PatientFile::where('patient_id', $patientId)->first();
        $patientFile->pcp_name = $input['pcp_name'];
        $patientFile->npi = $input['npi'];
        $patientFile->abn = $input['abn'];
        $patientFile->privacy_notice = $input['privacy_notice'];
        $patientFile->roi = $input['roi'];
        $patientFile->language = $input['language'];
        $patientFile->race = $input['race'];
        $patientFile->ethnicity = $input['ethnicity'];
        $patientFile->marital_status = $input['marital_status'];
        $patientFile->gender = $input['gender'];
        $patientFile->method_of_contact = $input['method_of_contact'];
        $patientFile->save();
        // Redirect back to the same page with success message
        return redirect()->back()->with('success', 'Patient information updated successfully!');
    }
    public function updatePresentInfo(Request $request)
    {
        $input = $request->all();
        $uid = Auth::user()->id;
        $patientId = $input['patient_id'];
        $patientInsurance = PatientInsurance::where('patient_id', $patientId)->first();
        $patientInsurance->present_subscriber_id = $input['primary_subscriberid'];
        $patientInsurance->present_group = $input['primary_group'];
        $patientInsurance->present_payer_id = $input['primary_payerid'];
        $patientInsurance->present_address = $input['primary_address'];
        $patientInsurance->present_phone = $input['primary_phone'];
        $patientInsurance->present_fax = $input['primary_fax'];
        $patientInsurance->present_effective_date = $input['primary_effective_date'];
        $patientInsurance->present_termination_date = $input['primary_termination_date'];
        $patientInsurance->save();
        // Redirect back to the same page with success message
        return redirect()->back()->with('success', 'Patient information updated successfully!');
    }
    public function updateSecondaryInfo(Request $request)
    {
        $input = $request->all();
        $uid = Auth::user()->id;
        $patientId = $input['patient_id'];
        $patientInsurance = PatientInsurance::where('patient_id', $patientId)->first();
        $patientInsurance->secondary_subscriber_id = $input['secondary_subscriberid'];
        $patientInsurance->secondary_group = $input['secondary_group'];
        $patientInsurance->secondary_payer_id = $input['secondary_payerid'];
        $patientInsurance->secondary_address = $input['secondary_address'];
        $patientInsurance->secondary_phone = $input['secondary_phone'];
        $patientInsurance->secondary_fax = $input['secondary_fax'];
        $patientInsurance->secondary_effective_date = $input['secondary_effective_date'];
        $patientInsurance->secondary_termination_date = $input['secondary_termination_date'];
        $patientInsurance->save();
        // Redirect back to the same page with success message
        return redirect()->back()->with('success', 'Patient information updated successfully!');
    }
    public function updatetTritaryInfo(Request $request)
    {
        $input = $request->all();
        $uid = Auth::user()->id;
        $patientId = $input['patient_id'];
        $patientInsurance = PatientInsurance::where('patient_id', $patientId)->first();
        $patientInsurance->tritary_subscriber_id = $input['tritary_subscriberid'];
        $patientInsurance->tritary_group = $input['tritary_group'];
        $patientInsurance->tritary_payer_id = $input['tritary_payerid'];
        $patientInsurance->tritary_address = $input['tritary_address'];
        $patientInsurance->tritary_phone = $input['tritary_phone'];
        $patientInsurance->tritary_fax = $input['tritary_fax'];
        $patientInsurance->tritary_effective_date = $input['tritary_effective_date'];
        $patientInsurance->tritary_termination_date = $input['tritary_termination_date'];
        $patientInsurance->save();
        // Redirect back to the same page with success message
        return redirect()->back()->with('success', 'Patient information updated successfully!');
    }
    public function storePatients(Request $request)
    {
        $input = $request->all();
        $uid = Auth::user()->id;
        $patient = new Patient;
        $patient->first_name = $input['firstname'];
        $patient->last_name = $input['lastname'];
        $patient->mi = $input['mi'];
        $patient->dob = $input['dob'];
        $patient->sex = $input['sex'];
        $patient->ssn = $input['ssn'];
        $patient->homephone = $input['homephone'];
        $patient->mobilephone = $input['mobilephone'];
        $patient->email = $input['email'];
        $patient->address1 = $input['address1'];
        $patient->address2 = $input['address2'];
        $patient->city = $input['city'];
        $patient->state = $input['state'];
        $patient->postcode = $input['postcode'];
        $patient->notes = $input['patient_notes'];
        $patient->created_by = $uid;
        $patient->save();

        $patientGuarantor = new PatientGuarantor;
        $patientGuarantor->patient_id = $patient->id;
        $patientGuarantor->first_name = $input['guarantors_firstname'];
        $patientGuarantor->last_name = $input['guarantors_lastname'];
        $patientGuarantor->mi = $input['guarantors_mi'];
        $patientGuarantor->dob = $input['guarantors_dob'];
        $patientGuarantor->status = $input['guarantors_status'];
        $patientGuarantor->relationship = $input['guarantors_relationship'];
        $patientGuarantor->homephone = $input['guarantors_homephone'];
        $patientGuarantor->mobilephone = $input['guarantors_mobilephone'];
        $patientGuarantor->email = $input['guarantors_email'];
        $patientGuarantor->address1 = $input['guarantors_address1'];
        $patientGuarantor->address2 = $input['guarantors_address2'];
        $patientGuarantor->city = $input['guarantors_city'];
        $patientGuarantor->state = $input['guarantors_state'];
        $patientGuarantor->postcode = $input['guarantors_postcode'];
        $patientGuarantor->save();

        $patientEmployer = new PatientEmployer;
        $patientEmployer->patient_id = $patient->id;
        $patientEmployer->employer_name = $input['employer_name'];
        $patientEmployer->department = $input['department'];
        $patientEmployer->employer_phone = $input['employer_phone'];
        $patientEmployer->email = $input['employer_email'];
        $patientEmployer->address1 = $input['employer_address1'];
        $patientEmployer->address2 = $input['employer_address2'];
        $patientEmployer->city = $input['employer_city'];
        $patientEmployer->state = $input['employer_state'];
        $patientEmployer->postcode = $input['employer_postcode'];
        $patientEmployer->emergency_contact = $input['emergency_contact'];
        $patientEmployer->relationship = $input['emergency_relationship'];
        $patientEmployer->kin_phone = $input['emergency_phone'];
        $patientEmployer->kin_address = $input['emergency_address'];
        $patientEmployer->save();

        $patientFile = new PatientFile;
        $patientFile->patient_id = $patient->id;
        $patientFile->pcp_name = $input['pcp_name'];
        $patientFile->npi = $input['npi'];
        $patientFile->abn = $input['abn'];
        $patientFile->privacy_notice = $input['privacy_notice'];
        $patientFile->roi = $input['roi'];
        $patientFile->language = $input['language'];
        $patientFile->race = $input['race'];
        $patientFile->ethnicity = $input['ethnicity'];
        $patientFile->marital_status = $input['marital_status'];
        $patientFile->gender = $input['gender'];
        $patientFile->method_of_contact = $input['method_of_contact'];
        $patientFile->save();


        $patientInsurance = new PatientInsurance;
        $patientInsurance->patient_id = $patient->id;
        $patientInsurance->present_subscriber_id = $input['primary_subscriberid'];
        $patientInsurance->present_group = $input['primary_group'];
        $patientInsurance->present_payer_id = $input['primary_payerid'];
        $patientInsurance->present_address = $input['primary_address'];
        $patientInsurance->present_phone = $input['primary_phone'];
        $patientInsurance->present_fax = $input['primary_fax'];
        $patientInsurance->present_effective_date = $input['primary_effective_date'];
        $patientInsurance->present_termination_date = $input['primary_termination_date'];
        $patientInsurance->secondary_subscriber_id = $input['secondary_subscriberid'];
        $patientInsurance->secondary_group = $input['secondary_group'];
        $patientInsurance->secondary_payer_id = $input['secondary_payerid'];
        $patientInsurance->secondary_address = $input['secondary_address'];
        $patientInsurance->secondary_phone = $input['secondary_phone'];
        $patientInsurance->secondary_fax = $input['secondary_fax'];
        $patientInsurance->secondary_effective_date = $input['secondary_effective_date'];
        $patientInsurance->secondary_termination_date = $input['secondary_termination_date'];
        $patientInsurance->tritary_subscriber_id = $input['tritary_subscriberid'];
        $patientInsurance->tritary_group = $input['tritary_group'];
        $patientInsurance->tritary_payer_id = $input['tritary_payerid'];
        $patientInsurance->tritary_address = $input['tritary_address'];
        $patientInsurance->tritary_phone = $input['tritary_phone'];
        $patientInsurance->tritary_fax = $input['tritary_fax'];
        $patientInsurance->tritary_effective_date = $input['tritary_effective_date'];
        $patientInsurance->tritary_termination_date = $input['tritary_termination_date'];
        $patientInsurance->save();
        // return view('admin.patients.create-patient');
        return redirect('/patients')->with('success', 'Patient created successfully!');
        // dd($input);
    }
    public function viewPatient($id)
    {
        // dd($id);
        $patientDetails = Patient::where('id', $id)->first();
        $employerDetails = PatientEmployer::where('patient_id', $id)->first();
        $fileDetails = PatientFile::where('patient_id', $id)->first();
        $guarantorDetails = PatientGuarantor::where('patient_id', $id)->first();
        $insuranceDetails = PatientInsurance::where('patient_id', $id)->first();
        return view('admin.patients.view-patient', compact('patientDetails', 'insuranceDetails', 'guarantorDetails', 'fileDetails', 'employerDetails', 'id'));
    }
}
