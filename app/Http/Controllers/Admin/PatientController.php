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
use App\Models\PatientHistory;
use App\Models\PatientNote;
use Illuminate\Support\Facades\Storage;
use App\Services\IpGeoService;


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
    public function uploadPatientImage(Request $request, IpGeoService $geoService)
    {
        $request->validate([
            'patient_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $patient = Patient::find($request->patient_id); // Pass patient_id if needed

        if ($request->hasFile('patient_image')) {
            $image = $request->file('patient_image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Save image in 'public/patient_images' folder
            $path = $image->storeAs('patient/patient_images', $imageName);

            // Save image path in database
            $patient->profile_image_path = $imageName; // or $path depending on how you want to store
            $patient->save();

            $uid = Auth::user()->id;
            $ip = $request->ip();
            $geo = $geoService->lookup($ip);
            $user = User::where('id', $uid)->first();
            $userName = trim($user->first_name . ' ' . $user->last_name);

            // Save history
            PatientHistory::create([
                'user_id'    => $uid,
                'user_name'  => $userName,
                'action'     => "Patient Image Changed",
                'patient_id' => $request->patient_id,
                'ip_address' => $ip ?? 'NA',
                'user_agent' => substr($request->header('User-Agent') ?? '', 0, 1000),
                'country'    => $geo['country'] ?? null,
                'region'     => $geo['region'] ?? null,
                'city'       => $geo['city'] ?? null,
                'latitude'   => $geo['latitude'] ?? null,
                'longitude'  => $geo['longitude'] ?? null,
                'isp'        => $geo['org'] ?? null,
                'raw_geo'    => $geo,
                'notes'      => null,
            ]);
        }

        return back()->with('success', 'Patient image uploaded successfully!');
    }
    public function uploadPatientNote(Request $request, IpGeoService $geoService)
    {

        $uid = Auth::user()->id;
        $patient = new PatientNote;
        $patient->patient_id = $request->patient_id;
        $patient->notes = $request->patient_notes; // or $path depending on how you want to store
        $patient->created_by = $uid;
        $patient->updated_by = $uid;
        $patient->save();
        // Get user info
        $uid = Auth::user()->id;
        $ip = $request->ip();
        $geo = $geoService->lookup($ip);
        $user = User::where('id', $uid)->first();
        $userName = trim($user->first_name . ' ' . $user->last_name);

        // Save history
        PatientHistory::create([
            'user_id'    => $uid,
            'user_name'  => $userName,
            'action'     => "Patient Note Changed",
            'patient_id' => $request->patient_id,
            'ip_address' => $ip ?? 'NA',
            'user_agent' => substr($request->header('User-Agent') ?? '', 0, 1000),
            'country'    => $geo['country'] ?? null,
            'region'     => $geo['region'] ?? null,
            'city'       => $geo['city'] ?? null,
            'latitude'   => $geo['latitude'] ?? null,
            'longitude'  => $geo['longitude'] ?? null,
            'isp'        => $geo['org'] ?? null,
            'raw_geo'    => $geo,
            'notes'      => null,
        ]);

        return back()->with('success', 'Patient notes updated successfully!');
    }

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
        // return view('admin.patients.create-patient');
        return view('admin.patients.new-form-patient');
    }
    public function oldCreatePatient(Request $request)
    {
        return view('admin.patients.create-patient');
        // return view('admin.patients.new-form-patient');
    }
    function getClientIps(\Illuminate\Http\Request $request): array
    {
        $ip = $request->ip(); // main client IP (could be v4 or v6)

        $forwarded = $request->header('X-Forwarded-For');
        $ips = $forwarded ? array_map('trim', explode(',', $forwarded)) : [$ip];
        // dd($ip);
        $ipv4 = null;
        $ipv6 = null;

        foreach ($ips as $candidate) {
            if (filter_var($candidate, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                $ipv4 = $candidate;
            }
            if (filter_var($candidate, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
                $ipv6 = $candidate;
            }
        }
        // dd($ipv4, $ipv6);
        return [
            'ipv4' => $ipv4,
            'ipv6' => $ipv6,
            'all'  => $ips,  // optional: full chain of forwarded IPs
        ];
    }

    public function updatePersonalInfo(Request $request, IpGeoService $geoService)
    {
        $input = $request->all();

        $uid = Auth::user()->id;
        $patientId = $input['patient_id'];

        // Fetch old patient details before update
        $patientDetails = Patient::where('id', $patientId)->firstOrFail();
        $oldData = $patientDetails->toArray();

        // Fields we want to check for changes
        $fields = [
            'first_name' => 'Patient First Name',
            'last_name' => 'Patient Last Name',
            'mi' => 'Patient Middle Initial',
            'dob' => 'Patient Date of Birth',
            'sex' => 'Patient Sex',
            'ssn' => 'Patient  SSN',
            'homephone' => 'Patient  Home Phone',
            'mobilephone' => 'Patient Mobile Phone',
            'email' => 'Patient Email',
            'address1' => 'Patient Address Line 1',
            'address2' => 'Patient Address Line 2',
            'city' => 'Patient City',
            'state' => 'Patient State',
            'postcode' => 'Patient Postcode',
        ];

        // Update patient details
        $patientDetails->first_name   = $input['firstname'];
        $patientDetails->last_name    = $input['lastname'];
        $patientDetails->mi           = $input['mi'];
        $patientDetails->dob          = $input['dob'];
        $patientDetails->sex          = $input['sex'];
        $patientDetails->ssn          = $input['ssn'];
        $patientDetails->homephone    = $input['homephone'];
        $patientDetails->mobilephone  = $input['mobilephone'];
        $patientDetails->email        = $input['email'];
        $patientDetails->address1     = $input['address1'];
        $patientDetails->address2     = $input['address2'];
        $patientDetails->city         = $input['city'];
        $patientDetails->state        = $input['state'];
        $patientDetails->postcode     = $input['postcode'];
        $patientDetails->updated_by   = $uid;
        $patientDetails->save();

        // Compare new vs old and log changes
        $changes = [];
        foreach ($fields as $dbField => $label) {
            $newValue = $patientDetails->$dbField;
            $oldValue = $oldData[$dbField] ?? null;

            if ($oldValue != $newValue) {
                $changes[] = "$label changed from '{$oldValue}' to '{$newValue}'";
            }
        }

        $actionText = !empty($changes)
            ? implode("; ", $changes)
            : "Patient Personal details updated (no field changes)";

        // Get user info
        $ip = $request->ip();
        $geo = $geoService->lookup($ip);
        $user = User::where('id', $uid)->first();
        $userName = trim($user->first_name . ' ' . $user->last_name);

        // Save history
        PatientHistory::create([
            'user_id'    => $uid,
            'user_name'  => $userName,
            'action'     => $actionText,
            'patient_id' => $patientId,
            'ip_address' => $ip ?? 'NA',
            'user_agent' => substr($request->header('User-Agent') ?? '', 0, 1000),
            'country'    => $geo['country'] ?? null,
            'region'     => $geo['region'] ?? null,
            'city'       => $geo['city'] ?? null,
            'latitude'   => $geo['latitude'] ?? null,
            'longitude'  => $geo['longitude'] ?? null,
            'isp'        => $geo['org'] ?? null,
            'raw_geo'    => $geo,
            'notes'      => null,
        ]);

        return redirect()->back()->with('success', 'Patient information updated successfully!');
    }

    public function updateguarantorInfo(Request $request, IpGeoService $geoService)
    {
        $input = $request->all();
        $uid = Auth::user()->id;
        $patientId = $input['patient_id'];
        $guarantorDetails = PatientGuarantor::where('patient_id', $patientId)->first();
        $oldData = $guarantorDetails->toArray();

        // Fields we want to check for changes
        $fields = [
            'first_name' => 'Guarantors First Name',
            'last_name' => 'Guarantors Last Name',
            'mi' => 'Guarantors Middle Initial',
            'dob' => 'Guarantors Date of Birth',
            'status' => 'Guarantors Status',
            'relationship' => 'Guarantors Relationship',
            'homephone' => 'Guarantors Home Phone',
            'mobilephone' => 'Guarantors Mobile Phone',
            'email' => 'Guarantors Email',
            'address1' => 'Guarantors Address Line 1',
            'address2' => 'Guarantors Address Line 2',
            'city' => 'Guarantors City',
            'state' => 'Guarantors State',
            'postcode' => 'Guarantors Postcode',
        ];

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

        // Compare new vs old and log changes
        $changes = [];
        foreach ($fields as $dbField => $label) {
            $newValue = $guarantorDetails->$dbField;
            $oldValue = $oldData[$dbField] ?? null;

            if ($oldValue != $newValue) {
                $changes[] = "$label changed from '{$oldValue}' to '{$newValue}'";
            }
        }

        $actionText = !empty($changes)
            ? implode("; ", $changes)
            : "Patient Guarantor details updated (no field changes)";

        // Get user info
        $ip = $request->ip();
        $geo = $geoService->lookup($ip);
        $user = User::where('id', $uid)->first();
        $userName = trim($user->first_name . ' ' . $user->last_name);

        // Save history
        PatientHistory::create([
            'user_id'    => $uid,
            'user_name'  => $userName,
            'action'     => $actionText,
            'patient_id' => $patientId,
            'ip_address' => $ip ?? 'NA',
            'user_agent' => substr($request->header('User-Agent') ?? '', 0, 1000),
            'country'    => $geo['country'] ?? null,
            'region'     => $geo['region'] ?? null,
            'city'       => $geo['city'] ?? null,
            'latitude'   => $geo['latitude'] ?? null,
            'longitude'  => $geo['longitude'] ?? null,
            'isp'        => $geo['org'] ?? null,
            'raw_geo'    => $geo,
            'notes'      => null,
        ]);
        // Redirect back to the same page with success message
        return redirect()->back()->with('success', 'Patient information updated successfully!');
    }
    public function updateEmployerInfo(Request $request, IpGeoService $geoService)
    {
        $input = $request->all();
        $uid = Auth::user()->id;
        $patientId = $input['patient_id'];
        $patientEmployer = PatientEmployer::where('patient_id', $patientId)->first();
        $oldData = $patientEmployer->toArray();

        // Fields we want to check for changes
        $fields = [
            'employer_name' => 'Employer Name',
            'department' => 'Employer Department',
            'employer_phone' => 'Employer Phone',
            'email' => 'Employer Email',
            'address1' => 'Employer Address Line 1',
            'address2' => 'Employer Address Line 2',
            'city' => 'Employer City',
            'state' => 'Employer State',
            'postcode' => 'Employer Postcode',
        ];

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

        // Compare new vs old and log changes
        $changes = [];
        foreach ($fields as $dbField => $label) {
            $newValue = $patientEmployer->$dbField;
            $oldValue = $oldData[$dbField] ?? null;

            if ($oldValue != $newValue) {
                $changes[] = "$label changed from '{$oldValue}' to '{$newValue}'";
            }
        }

        $actionText = !empty($changes)
            ? implode("; ", $changes)
            : "Patient Employer details updated (no field changes)";

        // Get user info
        $ip = $request->ip();
        $geo = $geoService->lookup($ip);
        $user = User::where('id', $uid)->first();
        $userName = trim($user->first_name . ' ' . $user->last_name);

        // Save history
        PatientHistory::create([
            'user_id'    => $uid,
            'user_name'  => $userName,
            'action'     => $actionText,
            'patient_id' => $patientId,
            'ip_address' => $ip ?? 'NA',
            'user_agent' => substr($request->header('User-Agent') ?? '', 0, 1000),
            'country'    => $geo['country'] ?? null,
            'region'     => $geo['region'] ?? null,
            'city'       => $geo['city'] ?? null,
            'latitude'   => $geo['latitude'] ?? null,
            'longitude'  => $geo['longitude'] ?? null,
            'isp'        => $geo['org'] ?? null,
            'raw_geo'    => $geo,
            'notes'      => null,
        ]);
        // Redirect back to the same page with success message
        return redirect()->back()->with('success', 'Patient information updated successfully!');
    }
    public function updateEmergencyInfo(Request $request, IpGeoService $geoService)
    {
        $input = $request->all();
        $uid = Auth::user()->id;
        $patientId = $input['patient_id'];
        $patientEmployer = PatientEmployer::where('patient_id', $patientId)->first();
        $oldData = $patientEmployer->toArray();

        // Fields we want to check for changes
        $fields = [
            'emergency_contact' => 'Emergency Contact Name',
            'relationship' => 'Emergency Relationship',
            'kin_phone' => 'Emergency contact phone',
            'kin_address' => 'Emergency contact address',
        ];

        $patientEmployer->emergency_contact = $input['emergency_contact'];
        $patientEmployer->relationship = $input['emergency_relationship'];
        $patientEmployer->kin_phone = $input['kin_phone'];
        $patientEmployer->kin_address = $input['kin_address'];
        $patientEmployer->save();
        // Compare new vs old and log changes
        $changes = [];
        foreach ($fields as $dbField => $label) {
            $newValue = $patientEmployer->$dbField;
            $oldValue = $oldData[$dbField] ?? null;

            if ($oldValue != $newValue) {
                $changes[] = "$label changed from '{$oldValue}' to '{$newValue}'";
            }
        }

        $actionText = !empty($changes)
            ? implode("; ", $changes)
            : "Patient Emergency Contact details updated (no field changes)";

        // Get user info
        $ip = $request->ip();
        $geo = $geoService->lookup($ip);
        $user = User::where('id', $uid)->first();
        $userName = trim($user->first_name . ' ' . $user->last_name);

        // Save history
        PatientHistory::create([
            'user_id'    => $uid,
            'user_name'  => $userName,
            'action'     => $actionText,
            'patient_id' => $patientId,
            'ip_address' => $ip ?? 'NA',
            'user_agent' => substr($request->header('User-Agent') ?? '', 0, 1000),
            'country'    => $geo['country'] ?? null,
            'region'     => $geo['region'] ?? null,
            'city'       => $geo['city'] ?? null,
            'latitude'   => $geo['latitude'] ?? null,
            'longitude'  => $geo['longitude'] ?? null,
            'isp'        => $geo['org'] ?? null,
            'raw_geo'    => $geo,
            'notes'      => null,
        ]);
        // Redirect back to the same page with success message
        return redirect()->back()->with('success', 'Patient information updated successfully!');
    }
    public function updateFileInfo(Request $request, IpGeoService $geoService)
    {
        $input = $request->all();
        $uid = Auth::user()->id;
        $patientId = $input['patient_id'];
        $patientFile = PatientFile::where('patient_id', $patientId)->first();
        $oldData = $patientFile->toArray();

        // Fields we want to check for changes
        $fields = [
            'pcp_name' => 'Patient PCP Name',
            'pcp_phone' => 'Patient PCP Phone',
            'npi' => 'Patient NPI',
            'npi' => 'Patient NPI',
            'abn' => 'ABN Signature on file status',
            'privacy_notice' => 'Privacy Notice status',
            'roi' => 'ROI Signature on file status',
            'language' => 'Patient Language',
            'Race' => 'Patient Race',
            'ethnicity' => 'Patient Ethnicity',
            'marital_status' => 'Patient Marital Status',
            'gender' => 'Patient Gender Identity',
            'method_of_contact' => 'Patient method of contact',
        ];

        $patientFile->pcp_name = $input['pcp_name'];
        $patientFile->pcp_phone = $input['pcp_phone'];
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

        // Compare new vs old and log changes
        $changes = [];
        foreach ($fields as $dbField => $label) {
            $newValue = $patientFile->$dbField;
            $oldValue = $oldData[$dbField] ?? null;

            if ($oldValue != $newValue) {
                $changes[] = "$label changed from '{$oldValue}' to '{$newValue}'";
            }
        }

        $actionText = !empty($changes)
            ? implode("; ", $changes)
            : "Patient Emergency Consent on details updated (no field changes)";

        // Get user info
        $ip = $request->ip();
        $geo = $geoService->lookup($ip);
        $user = User::where('id', $uid)->first();
        $userName = trim($user->first_name . ' ' . $user->last_name);

        // Save history
        PatientHistory::create([
            'user_id'    => $uid,
            'user_name'  => $userName,
            'action'     => $actionText,
            'patient_id' => $patientId,
            'ip_address' => $ip ?? 'NA',
            'user_agent' => substr($request->header('User-Agent') ?? '', 0, 1000),
            'country'    => $geo['country'] ?? null,
            'region'     => $geo['region'] ?? null,
            'city'       => $geo['city'] ?? null,
            'latitude'   => $geo['latitude'] ?? null,
            'longitude'  => $geo['longitude'] ?? null,
            'isp'        => $geo['org'] ?? null,
            'raw_geo'    => $geo,
            'notes'      => null,
        ]);
        // Redirect back to the same page with success message
        return redirect()->back()->with('success', 'Patient information updated successfully!');
    }
    public function updatePresentInfo(Request $request,  IpGeoService $geoService)
    {
        $input = $request->all();
        $uid = Auth::user()->id;
        $patientId = $input['patient_id'];
        $patientInsurance = PatientInsurance::where('patient_id', $patientId)->first();
        $oldData = $patientInsurance->toArray();

        // Fields we want to check for changes
        $fields = [
            'present_subscriber_id' => 'Primary Insurance Subsriber ID',
            'present_group' => 'Primary Insurance Group',
            'present_payer_id' => 'Primary Insurance Payer ID',
            'present_address' => 'Primary Insurance Address',
            'present_phone' => 'Primary Insurance Phone',
            'present_fax' => 'Primary Insurance Fax',
            'present_effective_date' => 'Primary Insurance Effective Date',
            'present_termination_date' => 'Primary Insurance Termination Date',
        ];

        $patientInsurance->present_subscriber_id = $input['present_subscriber_id'];
        $patientInsurance->present_group = $input['present_group'];
        $patientInsurance->present_payer_id = $input['present_payer_id'];
        $patientInsurance->present_address = $input['present_address'];
        $patientInsurance->present_phone = $input['present_phone'];
        $patientInsurance->present_fax = $input['present_fax'];
        $patientInsurance->present_effective_date = $input['present_effective_date'];
        $patientInsurance->present_termination_date = $input['present_termination_date'];
        $patientInsurance->save();

        // Compare new vs old and log changes
        $changes = [];
        foreach ($fields as $dbField => $label) {
            $newValue = $patientInsurance->$dbField;
            $oldValue = $oldData[$dbField] ?? null;

            if ($oldValue != $newValue) {
                $changes[] = "$label changed from '{$oldValue}' to '{$newValue}'";
            }
        }

        $actionText = !empty($changes)
            ? implode("; ", $changes)
            : "Patient Primary Insurance details updated (no field changes)";

        // Get user info
        $ip = $request->ip();
        $geo = $geoService->lookup($ip);
        $user = User::where('id', $uid)->first();
        $userName = trim($user->first_name . ' ' . $user->last_name);

        // Save history
        PatientHistory::create([
            'user_id'    => $uid,
            'user_name'  => $userName,
            'action'     => $actionText,
            'patient_id' => $patientId,
            'ip_address' => $ip ?? 'NA',
            'user_agent' => substr($request->header('User-Agent') ?? '', 0, 1000),
            'country'    => $geo['country'] ?? null,
            'region'     => $geo['region'] ?? null,
            'city'       => $geo['city'] ?? null,
            'latitude'   => $geo['latitude'] ?? null,
            'longitude'  => $geo['longitude'] ?? null,
            'isp'        => $geo['org'] ?? null,
            'raw_geo'    => $geo,
            'notes'      => null,
        ]);
        // Redirect back to the same page with success message
        return redirect()->back()->with('success', 'Patient information updated successfully!');
    }
    public function updateSecondaryInfo(Request $request, IpGeoService $geoService)
    {
        $input = $request->all();
        $uid = Auth::user()->id;
        $patientId = $input['patient_id'];
        $patientInsurance = PatientInsurance::where('patient_id', $patientId)->first();
        $oldData = $patientInsurance->toArray();

        // Fields we want to check for changes
        $fields = [
            'secondary_subscriber_id' => 'Secondary Insurance Subsriber ID',
            'secondary_group' => 'Secondary Insurance Group',
            'secondary_payer_id' => 'Secondary Insurance Payer ID',
            'secondary_address' => 'Secondary Insurance Address',
            'secondary_phone' => 'Secondary Insurance Phone',
            'secondary_fax' => 'Secondary Insurance Fax',
            'secondary_effective_date' => 'Secondary Insurance Effective Date',
            'secondary_termination_date' => 'Secondary Insurance Termination Date',
        ];
        $patientInsurance->secondary_subscriber_id = $input['secondary_subscriber_id'];
        $patientInsurance->secondary_group = $input['secondary_group'];
        $patientInsurance->secondary_payer_id = $input['secondary_payer_id'];
        $patientInsurance->secondary_address = $input['secondary_address'];
        $patientInsurance->secondary_phone = $input['secondary_phone'];
        $patientInsurance->secondary_fax = $input['secondary_fax'];
        $patientInsurance->secondary_effective_date = $input['secondary_effective_date'];
        $patientInsurance->secondary_termination_date = $input['secondary_termination_date'];
        $patientInsurance->save();

        // Compare new vs old and log changes
        $changes = [];
        foreach ($fields as $dbField => $label) {
            $newValue = $patientInsurance->$dbField;
            $oldValue = $oldData[$dbField] ?? null;

            if ($oldValue != $newValue) {
                $changes[] = "$label changed from '{$oldValue}' to '{$newValue}'";
            }
        }

        $actionText = !empty($changes)
            ? implode("; ", $changes)
            : "Patient Secondary Insurance details updated (no field changes)";

        // Get user info
        $ip = $request->ip();
        $geo = $geoService->lookup($ip);
        $user = User::where('id', $uid)->first();
        $userName = trim($user->first_name . ' ' . $user->last_name);

        // Save history
        PatientHistory::create([
            'user_id'    => $uid,
            'user_name'  => $userName,
            'action'     => $actionText,
            'patient_id' => $patientId,
            'ip_address' => $ip ?? 'NA',
            'user_agent' => substr($request->header('User-Agent') ?? '', 0, 1000),
            'country'    => $geo['country'] ?? null,
            'region'     => $geo['region'] ?? null,
            'city'       => $geo['city'] ?? null,
            'latitude'   => $geo['latitude'] ?? null,
            'longitude'  => $geo['longitude'] ?? null,
            'isp'        => $geo['org'] ?? null,
            'raw_geo'    => $geo,
            'notes'      => null,
        ]);
        // Redirect back to the same page with success message
        return redirect()->back()->with('success', 'Patient information updated successfully!');
    }
    public function updatetTritaryInfo(Request $request, IpGeoService $geoService)
    {
        $input = $request->all();
        $uid = Auth::user()->id;
        $patientId = $input['patient_id'];
        $patientInsurance = PatientInsurance::where('patient_id', $patientId)->first();
        $oldData = $patientInsurance->toArray();

        // Fields we want to check for changes
        $fields = [
            'tritary_subscriber_id' => 'Tritary Insurance Subsriber ID',
            'tritary_group' => 'Tritary Insurance Group',
            'tritary_payer_id' => 'Tritary Insurance Payer ID',
            'tritary_address' => 'Tritary Insurance Address',
            'tritary_phone' => 'Tritary Insurance Phone',
            'tritary_fax' => 'Tritary Insurance Fax',
            'tritary_effective_date' => 'Tritary Insurance Effective Date',
            'tritary_termination_date' => 'Tritary Insurance Termination Date',
        ];
        $patientInsurance->tritary_subscriber_id = $input['tritary_subscriber_id'];
        $patientInsurance->tritary_group = $input['tritary_group'];
        $patientInsurance->tritary_payer_id = $input['tritary_payer_id'];
        $patientInsurance->tritary_address = $input['tritary_address'];
        $patientInsurance->tritary_phone = $input['tritary_phone'];
        $patientInsurance->tritary_fax = $input['tritary_fax'];
        $patientInsurance->tritary_effective_date = $input['tritary_effective_date'];
        $patientInsurance->tritary_termination_date = $input['tritary_termination_date'];
        $patientInsurance->save();

        // Compare new vs old and log changes
        $changes = [];
        foreach ($fields as $dbField => $label) {
            $newValue = $patientInsurance->$dbField;
            $oldValue = $oldData[$dbField] ?? null;

            if ($oldValue != $newValue) {
                $changes[] = "$label changed from '{$oldValue}' to '{$newValue}'";
            }
        }

        $actionText = !empty($changes)
            ? implode("; ", $changes)
            : "Patient Secondary Insurance details updated (no field changes)";

        // Get user info
        $ip = $request->ip();
        $geo = $geoService->lookup($ip);
        $user = User::where('id', $uid)->first();
        $userName = trim($user->first_name . ' ' . $user->last_name);

        // Save history
        PatientHistory::create([
            'user_id'    => $uid,
            'user_name'  => $userName,
            'action'     => $actionText,
            'patient_id' => $patientId,
            'ip_address' => $ip ?? 'NA',
            'user_agent' => substr($request->header('User-Agent') ?? '', 0, 1000),
            'country'    => $geo['country'] ?? null,
            'region'     => $geo['region'] ?? null,
            'city'       => $geo['city'] ?? null,
            'latitude'   => $geo['latitude'] ?? null,
            'longitude'  => $geo['longitude'] ?? null,
            'isp'        => $geo['org'] ?? null,
            'raw_geo'    => $geo,
            'notes'      => null,
        ]);
        // Redirect back to the same page with success message
        return redirect()->back()->with('success', 'Patient information updated successfully!');
    }
    public function storePatients(Request $request, IpGeoService $geoService)
    {
        $input = $request->all();
        $uid = Auth::user()->id;
        $patient = new Patient;
        $patient->group_name = $input['group_name'];
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
        $patient->created_by = $uid;
        $patient->is_deleted = '0';
        $patient->save();
        $patientNote = new PatientNote;
        $patientNote->patient_id = $patient->id;
        $patientNote->notes = $input['patient_notes'];
        $patientNote->created_by = $uid;
        $patientNote->updated_by = $uid;
        $patientNote->save();
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
        $patientEmployer->kin_phone = $input['kin_phone'];
        $patientEmployer->kin_address = $input['kin_address'];
        $patientEmployer->save();

        $patientFile = new PatientFile;
        $patientFile->patient_id = $patient->id;
        $patientFile->pcp_name = $input['pcp_name'];
        $patientFile->pcp_phone = $input['pcp_phone'];
        $patientFile->npi = $input['npi'];
        $patientFile->abn = $input['abn'];
        $patientFile->privacy_notice = $input['privacy_notice'];
        $patientFile->roi = $input['roi'];
        $patientFile->language = $input['language'];
        $patientFile->race = $input['race'];
        $patientFile->ethnicity = $input['ethnicity'];
        $patientFile->marital_status = isset($input['marital_status']) ? $input['marital_status'] : "";
        $patientFile->gender = $input['gender'];
        $patientFile->method_of_contact = $input['method_of_contact'];
        $patientFile->save();


        $patientInsurance = new PatientInsurance;
        $patientInsurance->patient_id = $patient->id;
        $patientInsurance->present_subscriber_id = $input['present_subscriber_id'];
        $patientInsurance->present_group = $input['present_group'];
        $patientInsurance->present_payer_id = $input['present_payer_id'];
        $patientInsurance->present_address = $input['present_address'];
        $patientInsurance->present_phone = $input['present_phone'];
        $patientInsurance->present_fax = $input['present_fax'];
        $patientInsurance->present_effective_date = isset($input['present_effective_date']) ? $input['present_effective_date'] : "";
        $patientInsurance->present_termination_date = isset($input['present_termination_date']) ? $input['present_termination_date'] : "";
        $patientInsurance->secondary_subscriber_id = isset($input['secondary_subscriber_id']) ? $input['secondary_subscriber_id'] : "";
        $patientInsurance->secondary_group = isset($input['secondary_group']) ? $input['secondary_group'] : "";
        $patientInsurance->secondary_payer_id = isset($input['secondary_payer_id']) ? $input['secondary_payer_id'] : "";
        $patientInsurance->secondary_address = isset($input['secondary_address']) ? $input['secondary_address'] : "";
        $patientInsurance->secondary_phone = isset($input['secondary_phone']) ? $input['secondary_phone'] : "";
        $patientInsurance->secondary_fax = isset($input['secondary_fax']) ? $input['secondary_fax'] : "";
        $patientInsurance->secondary_effective_date = isset($input['secondary_effective_date']) ? $input['secondary_effective_date'] : date('Y-m-d');
        $patientInsurance->secondary_termination_date = isset($input['secondary_termination_date']) ? $input['secondary_termination_date'] : date('Y-m-d');
        $patientInsurance->tritary_subscriber_id = isset($input['tritary_subscriber_id']) ? $input['tritary_subscriber_id'] : "";
        $patientInsurance->tritary_group = isset($input['tritary_group']) ? $input['tritary_group'] : "";
        $patientInsurance->tritary_payer_id = isset($input['tritary_payer_id']) ? $input['tritary_payer_id'] : "";
        $patientInsurance->tritary_address = isset($input['tritary_address']) ? $input['tritary_address'] : "";
        $patientInsurance->tritary_phone = isset($input['tritary_phone']) ? $input['tritary_phone'] : "";
        $patientInsurance->tritary_fax = isset($input['tritary_fax']) ? $input['tritary_fax'] : "";
        $patientInsurance->tritary_effective_date = isset($input['tritary_effective_date']) ? $input['tritary_effective_date'] : date('Y-m-d');
        $patientInsurance->tritary_termination_date = isset($input['tritary_termination_date']) ? $input['tritary_termination_date'] : date('Y-m-d');
        $patientInsurance->save();
        $ip = $request->ip();
        $geo = $geoService->lookup($ip);
        $uid = Auth::user()->id;
        $user = User::where('id', $uid)->first();
        $fname = $user['first_name'];
        $lname = isset($user['first_name']) ? $user['first_name'] : '';
        $userName = $fname . ' ' . $lname;
        PatientHistory::create([
            'user_id' => $uid,
            'user_name' => $userName,
            'action' => "Patient Created",
            'patient_id' => $patient->id,
            'ip_address' => isset($ip) ? $ip : 'NA',
            'user_agent' => substr($request->header('User-Agent') ?? '', 0, 1000),
            'country' => $geo['country'] ?? null,
            'region' => $geo['region'] ?? null,
            'city' => $geo['city'] ?? null,
            'latitude' => $geo['latitude'] ?? null,
            'longitude' => $geo['longitude'] ?? null,
            'isp' => $geo['org'] ?? null,
            'raw_geo' => $geo,
            'notes' => null
        ]);
        // return view('admin.patients.create-patient');
        return redirect('/patients')->with('success', 'Patient created successfully!');
        // dd($input);
    }
    public function viewPatient($id, Request $request, IpGeoService $geoService)
    {
        // dd($id);

        $ip = $request->ip();
        $geo = $geoService->lookup($ip);
        $patientDetails = Patient::where('id', $id)->first();
        $employerDetails = PatientEmployer::where('patient_id', $id)->first();
        $fileDetails = PatientFile::where('patient_id', $id)->first();
        $guarantorDetails = PatientGuarantor::where('patient_id', $id)->first();
        $insuranceDetails = PatientInsurance::where('patient_id', $id)->first();
        $ip = $request->ip();
        $geo = $geoService->lookup($ip);
        $uid = Auth::user()->id;
        $user = User::where('id', $uid)->first();
        $fname = $user['first_name'];
        $lname = isset($user['first_name']) ? $user['first_name'] : '';
        $userName = $fname . ' ' . $lname;
        PatientHistory::create([
            'user_id' => $uid,
            'user_name' => $userName,
            'action' => "Patient Viewed",
            'patient_id' => $id,
            'ip_address' => isset($ip) ? $ip : 'NA',
            'user_agent' => substr($request->header('User-Agent') ?? '', 0, 1000),
            'country' => $geo['country'] ?? null,
            'region' => $geo['region'] ?? null,
            'city' => $geo['city'] ?? null,
            'latitude' => $geo['latitude'] ?? null,
            'longitude' => $geo['longitude'] ?? null,
            'isp' => $geo['org'] ?? null,
            'raw_geo' => $geo,
            'notes' => null
        ]);
        $patientHistory = PatientHistory::where('patient_id', $id)->orderBy('id', 'desc')->get();
        $patientNote = PatientNote::where('patient_id', $id)->orderBy('id', 'desc')->first();
        $patientNoteList = PatientNote::leftJoin('users as u', 'u.id', '=', 'patients_notes.updated_by')
            ->where('patients_notes.patient_id', $id)
            ->orderBy('patients_notes.id', 'desc')
            ->select('patients_notes.notes', 'u.first_name', 'u.last_name', 'patients_notes.updated_at')
            ->get();
        // dd($patientNote);
        return view('admin.patients.new-view', compact('patientNoteList', 'patientNote', 'patientHistory', 'patientDetails', 'insuranceDetails', 'guarantorDetails', 'fileDetails', 'employerDetails', 'id'));
    }
}
