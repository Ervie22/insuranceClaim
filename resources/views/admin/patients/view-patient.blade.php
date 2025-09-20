@extends('layouts.app')

@section('content')
<style>
    .viewPatientPage {
        font-family: "Segoe UI", Tahoma, Verdana, Arial, sans-serif;
        font-weight: 700;
        /* bold */
        font-size: 11px;

    }
</style>
<!-- upload image modal starts-->
<div class="modal fade" id="upload_image_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color:#67C090;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Patient Image</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit " class="btn text-white" style="background-color:#67C090;">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- upload image modal ends-->
<!-- update personal info modal starts-->
<div class="modal fade" id="update_personal_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color:#67C090;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Personal Info</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('patients.update-personal-info') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <input type="hidden" id="patient_id" name="patient_id" value="{{$id}}">
                            <div class="row g-3">
                                <div class="col-md-2">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" value="{{$patientDetails['first_name'] ? $patientDetails['first_name']:''}}" id="firstname" name="firstname" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" value="{{$patientDetails['last_name'] ? $patientDetails['last_name']:''}}" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">MI</label>
                                    <input type="text" class="form-control" id="mi" name="mi" value="{{$patientDetails['mi'] ? $patientDetails['mi']:''}}" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">DOB</label>
                                    <input type="date" class="form-control" value="{{$patientDetails['dob'] ? $patientDetails['dob']:''}}" name="dob" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Sex at Birth</label>
                                    <select class="form-control" name="sex" id="sex" required>
                                        <option value="">Select Sex</option>
                                        <option value="male" {{ (isset($patientDetails['sex']) && $patientDetails['sex'] == 'male') ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ (isset($patientDetails['sex']) && $patientDetails['sex'] == 'female') ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">SSN</label>
                                    <input type="text" class="form-control" id="ssn" name="ssn" value="{{$patientDetails['ssn'] ? $patientDetails['ssn']:''}}" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Home Phone</label>
                                    <input type="text" class="form-control" id="homephone" name="homephone" value="{{$patientDetails['homephone'] ? $patientDetails['homephone']:''}}" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Mobile Phone</label>
                                    <input type="text" class="form-control" id="mobilephone" name="mobilephone" value="{{$patientDetails['mobilephone'] ? $patientDetails['mobilephone']:''}}" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{$patientDetails['email'] ? $patientDetails['email']:''}}" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Address 1</label>
                                    <input type="text" class="form-control" id="address1" name="address1" value="{{$patientDetails['address1'] ? $patientDetails['address1']:''}}" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Address 2</label>
                                    <input type="text" class="form-control" id="address2" name="address2" value="{{$patientDetails['address2'] ? $patientDetails['address2']:''}}" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city" value="{{$patientDetails['city'] ? $patientDetails['city']:''}}" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">State</label>
                                    <input type="text" class="form-control" id="state" name="state" value="{{$patientDetails['state'] ? $patientDetails['state']:''}}" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Post Code</label>
                                    <input type="text" class="form-control" id="postcode" name="postcode" value="{{$patientDetails['postcode'] ? $patientDetails['postcode']:''}}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit " class="btn text-white" style="background-color:#67C090;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update personal infomodal ends-->
<!-- update guarantor info modal starts-->
<div class="modal fade" id="update_guarantor_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color:#67C090;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Guarantor Image</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('patients.update-guarantor-info') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <input type="hidden" id="patient_id" name="patient_id" value="{{$id}}">
                            <div class="row g-3">
                                <div class="col-md-2">
                                    <label class="form-label">First Name</label>
                                    <input type="text" value="{{$guarantorDetails['first_name'] ? $guarantorDetails['first_name']:''}}" class="form-control" id="guarantors_firstname" name="guarantors_firstname" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" value="{{$guarantorDetails['las_name'] ? $guarantorDetails['las_name']:''}}" class="form-control" id="guarantors_lastname" name="guarantors_lastname" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">MI</label>
                                    <input type="text" value="{{$guarantorDetails['mi'] ? $guarantorDetails['mi']:''}}" class="form-control" id="guarantors_mi" name="guarantors_mi" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">DOB</label>
                                    <input type="date" value="{{$guarantorDetails['dob'] ? $guarantorDetails['dob']:''}}" class="form-control" id="guarantors_dob" name="guarantors_dob" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Status</label>
                                    <select class="form-control" name="guarantors_status" id="guarantors_status" required>
                                        <option value="">Select Status</option>
                                        <option {{ (isset($guarantorDetails['status']) && $guarantorDetails['status'] == '1') ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ (isset($guarantorDetails['status']) && $guarantorDetails['status'] == '0') ? 'selected' : '' }} value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Realtionship With Patient</label>
                                    <input type="text" value="{{$guarantorDetails['relationship'] ? $guarantorDetails['relationship']:''}}" class="form-control" id="guarantors_relationship" name="guarantors_relationship" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Home Phone</label>
                                    <input type="text" value="{{$guarantorDetails['homephone'] ? $guarantorDetails['homephone']:''}}" class="form-control" id="guarantors_homephone" name="guarantors_homephone" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Mobile Phone</label>
                                    <input type="text" value="{{$guarantorDetails['mobilephone'] ? $guarantorDetails['mobilephone']:''}}" class="form-control" id="guarantors_mobilephone" name="guarantors_mobilephone" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Email</label>
                                    <input type="email" value="{{$guarantorDetails['email'] ? $guarantorDetails['email']:''}}" class="form-control" id="guarantors_email" name="guarantors_email" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Address 1</label>
                                    <input type="text" value="{{$guarantorDetails['address1'] ? $guarantorDetails['address1']:''}}" class="form-control" id="guarantors_address1" name="guarantors_address1" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Address 2</label>
                                    <input type="text" value="{{$guarantorDetails['address2'] ? $guarantorDetails['address2']:''}}" class="form-control" id="guarantors_address2" name="guarantors_address2" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">City</label>
                                    <input type="text" value="{{$guarantorDetails['city'] ? $guarantorDetails['city']:''}}" class="form-control" id="guarantors_city" name="guarantors_city" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">State</label>
                                    <input type="text" value="{{$guarantorDetails['state'] ? $guarantorDetails['state']:''}}" class="form-control" id="guarantors_state" name="guarantors_state" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Post Code</label>
                                    <input type="text" value="{{$guarantorDetails['pastcode'] ? $guarantorDetails['pastcode']:''}}" class="form-control" id="guarantors_postcode" name="guarantors_postcode" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit " class="btn text-white" style="background-color:#67C090;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update guarantor infomodal ends-->
<!-- update Employer info modal starts-->
<div class="modal fade" id="update_employer_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color:#67C090;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Employer Image</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('patients.update-employer-info') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3">
                                <input type="hidden" id="patient_id" name="patient_id" value="{{$id}}">
                                <div class="col-md-2">
                                    <label class="form-label">Employer Name</label>
                                    <input type="text" value="{{$employerDetails['employer_name'] ? $employerDetails['employer_name']:''}}" class="form-control" id="employer_name" name="employer_name" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Department</label>
                                    <input type="text" value="{{$employerDetails['department'] ? $employerDetails['department']:''}}" class="form-control" id="department" name="department" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Phone</label>
                                    <input type="text" value="{{$employerDetails['employer_phone'] ? $employerDetails['employer_phone']:''}}" class="form-control" id="employer_phone" name="employer_phone" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Work Email</label>
                                    <input type="email" value="{{$employerDetails['email'] ? $employerDetails['email']:''}}" class="form-control" id="employer_email" name="employer_email" required>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Address 1</label>
                                    <input type="text" class="form-control" value="{{$employerDetails['address1'] ? $employerDetails['address1']:''}}" id="employer_address1" name="employer_address1" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Address 2</label>
                                    <input type="text" value="{{$employerDetails['address2'] ? $employerDetails['address2']:''}}" class="form-control" id="employer_address2" name="employer_address2" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">City</label>
                                    <input type="text" value="{{$employerDetails['city'] ? $employerDetails['city']:''}}" class="form-control" id="employer_city" name="employer_city" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">State</label>
                                    <input type="text" value="{{$employerDetails['state'] ? $employerDetails['state']:''}}" class="form-control" id="employer_state" name="employer_state" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Post Code</label>
                                    <input type="text" value="{{$employerDetails['postcode'] ? $employerDetails['postcode']:''}}" class="form-control" id="employer_postcode" name="employer_postcode" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit " class="btn text-white" style="background-color:#67C090;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update employer infomodal ends-->
<!-- update Emergency info modal starts-->
<div class="modal fade" id="update_emergency_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color:#67C090;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Emergency Info</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('patients.update-emergency-info') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3">
                                <input type="hidden" id="patient_id" name="patient_id" value="{{$id}}">
                                <div class="col-md-2">
                                    <label class="form-label">Emergency Contact</label>
                                    <input value="{{$employerDetails['emergency_contact'] ? $employerDetails['emergency_contact']:''}}" type="text" class="form-control" id="emergency_contact" name="emergency_contact" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Relationship</label>
                                    <input value="{{$employerDetails['relationship'] ? $employerDetails['relationship']:''}}" type="text" class="form-control" id="emergency_relationship" name="emergency_relationship" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Phone</label>
                                    <input type="text" value="{{$employerDetails['kin_phone'] ? $employerDetails['kin_phone']:''}}" class="form-control" id="emergency_phone" name="emergency_phone" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Address</label>
                                    <input value="{{$employerDetails['kin_address'] ? $employerDetails['kin_address']:''}}" type="text" class="form-control" id="emergency_address" name="emergency_address" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit " class="btn text-white" style="background-color:#67C090;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update emergency infomodal ends-->
<!-- update file info modal starts-->
<div class="modal fade" id="update_file_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color:#67C090;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update File Info</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('patients.update-file-info') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3">
                                <input type="hidden" id="patient_id" name="patient_id" value="{{$id}}">
                                <div class="col-md-2">
                                    <label class="form-label">PCP Name</label>
                                    <input value="{{$fileDetails['pcp_name'] ? $fileDetails['pcp_name']:''}}" type="text" class="form-control" id="pcp_name" name="pcp_name" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">NPI</label>
                                    <input value="{{$fileDetails['npi'] ? $fileDetails['npi']:''}}" type="text" class="form-control" id="npi" name="npi" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">ABN Signature on file</label>
                                    <input value="{{$fileDetails['abn'] ? $fileDetails['abn']:''}}" type="text" class="form-control" id="abn" name="abn" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Privay Notice</label>
                                    <input type="text" value="{{$fileDetails['privacy_notice'] ? $fileDetails['privacy_notice']:''}}" class="form-control" id="privacy_notice" name="privacy_notice" required>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">ROI Signature on file</label>
                                    <input type="text" value="{{$fileDetails['roi'] ? $fileDetails['roi']:''}}" class="form-control" id="roi" name="roi" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Language</label>
                                    <input type="text" value="{{$fileDetails['language'] ? $fileDetails['language']:''}}" class="form-control" id="language" name="language" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Race</label>
                                    <input type="text" value="{{$fileDetails['race'] ? $fileDetails['race']:''}}" class="form-control" id="race" name="race" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Ethnicity</label>
                                    <input type="text" value="{{$fileDetails['ethnicity'] ? $fileDetails['ethnicity']:''}}" class="form-control" id="ethnicity" name="ethnicity" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Marital Status</label>
                                    <select class="form-control" name="marital_status" id="marital_status" required>
                                        <option value="">Select </option>
                                        <option {{ (isset($fileDetails['marital_status']) && $fileDetails['marital_status'] == 'Single') ? 'selected' : '' }} value="Single">Single</option>
                                        <option {{ (isset($fileDetails['marital_status']) && $fileDetails['marital_status'] == 'Married') ? 'selected' : '' }} value="Married">Married</option>
                                        <option {{ (isset($fileDetails['marital_status']) && $fileDetails['marital_status'] == 'Divorced') ? 'selected' : '' }} value="Divorced">Divorced</option>
                                        <option {{ (isset($fileDetails['marital_status']) && $fileDetails['marital_status'] == 'Widowed') ? 'selected' : '' }} value="Widowed">Widowed</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Gender identity / Pronouns</label>
                                    <input type="text" value="{{$fileDetails['gender'] ? $fileDetails['gender']:''}}" class="form-control" id="gender" name="gender" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Preferred Method of Contact</label>
                                    <select class="form-control" name="method_of_contact" id="method_of_contact" required>
                                        <option value="">Select Method</option>
                                        <option {{ (isset($fileDetails['method_of_contact']) && $fileDetails['method_of_contact'] == 'Widowed') ? 'Call' : '' }} value="Call">Call</option>
                                        <option {{ (isset($fileDetails['method_of_contact']) && $fileDetails['method_of_contact'] == 'Widowed') ? 'Text' : '' }} value="Text">Text</option>
                                        <option {{ (isset($fileDetails['method_of_contact']) && $fileDetails['method_of_contact'] == 'Widowed') ? 'Email' : '' }} value="Email">Email</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Patient Notes</label>
                                    <textarea class="form-control" name="patient_notes" id="patient_notes">{{$patientDetails['notes'] ? $patientDetails['notes']:''}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit " class="btn text-white" style="background-color:#67C090;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update file infomodal ends-->
<!-- update present info modal starts-->
<div class="modal fade" id="update_present_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color:#67C090;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Present Insurance Info</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('patients.update-present-info') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3">
                                <input type="hidden" id="patient_id" name="patient_id" value="{{$id}}">
                                <div class="col-md-2">
                                    <label class="form-label">Subscriber ID</label>
                                    <input value="{{$insuranceDetails['present_subscriber_id'] ? $insuranceDetails['present_subscriber_id']:''}}" type="text" class="form-control" id="primary_subscriberid" name="primary_subscriberid" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Group</label>
                                    <input value="{{$insuranceDetails['present_group'] ? $insuranceDetails['present_group']:''}}" type="text" class="form-control" id="primary_group" name="primary_group" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Payer ID</label>
                                    <input type="text" value="{{$insuranceDetails['present_payer_id'] ? $insuranceDetails['present_payer_id']:''}}" class="form-control" id="primary_payerid" name="primary_payerid" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Address</label>
                                    <input type="text" value="{{$insuranceDetails['present_address'] ? $insuranceDetails['present_address']:''}}" class="form-control" id="primary_address" name="primary_address" required>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Phone</label>
                                    <input type="text" value="{{$insuranceDetails['present_phone'] ? $insuranceDetails['present_phone']:''}}" class="form-control" id="primary_phone" name="primary_phone" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Fax</label>
                                    <input type="text" value="{{$insuranceDetails['present_fax'] ? $insuranceDetails['present_fax']:''}}" class="form-control" id="primary_fax" name="primary_fax" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Effective Date</label>
                                    <input type="date" value="{{$insuranceDetails['present_effective_date'] ? date('d-m-Y', strtotime($insuranceDetails['present_effective_date'])):''}}" class="form-control" id="primary_effective_date" name="primary_effective_date" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Termination Date</label>
                                    <input type="date" value="{{$insuranceDetails['present_termination_date'] ? date('d-m-Y', strtotime($insuranceDetails['present_termination_date'])):''}}" class="form-control" id="primary_termination_date" name="primary_termination_date" required>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit " class="btn text-white" style="background-color:#67C090;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update present infomodal ends-->
<!-- update secondary info modal starts-->
<div class="modal fade" id="update_secondary_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color:#67C090;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Secondary Insurance Info</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('patients.update-secondary-info') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3">
                                <input type="hidden" id="patient_id" name="patient_id" value="{{$id}}">
                                <div class="col-md-2">
                                    <label class="form-label">Subscriber ID</label>
                                    <input value="{{$insuranceDetails['secondary_subscriber_id'] ? $insuranceDetails['secondary_subscriber_id']:''}}" type="text" class="form-control" id="primary_subscriberid" name="primary_subscriberid" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Group</label>
                                    <input value="{{$insuranceDetails['secondary_group'] ? $insuranceDetails['secondary_group']:''}}" type="text" class="form-control" id="primary_group" name="primary_group" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Payer ID</label>
                                    <input type="text" value="{{$insuranceDetails['secondary_payer_id'] ? $insuranceDetails['secondary_payer_id']:''}}" class="form-control" id="primary_payerid" name="primary_payerid" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Address</label>
                                    <input type="text" value="{{$insuranceDetails['secondary_address'] ? $insuranceDetails['secondary_address']:''}}" class="form-control" id="primary_address" name="primary_address" required>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Phone</label>
                                    <input type="text" value="{{$insuranceDetails['secondary_phone'] ? $insuranceDetails['secondary_phone']:''}}" class="form-control" id="primary_phone" name="primary_phone" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Fax</label>
                                    <input type="text" value="{{$insuranceDetails['secondary_fax'] ? $insuranceDetails['secondary_fax']:''}}" class="form-control" id="primary_fax" name="primary_fax" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Effective Date</label>
                                    <input type="date" value="{{$insuranceDetails['secondary_effective_date'] ? date('d-m-Y', strtotime($insuranceDetails['secondary_effective_date'])):''}}" class="form-control" id="primary_effective_date" name="primary_effective_date" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Termination Date</label>
                                    <input type="date" value="{{$insuranceDetails['secondary_termination_date'] ? date('d-m-Y', strtotime($insuranceDetails['secondary_termination_date'])):''}}" class="form-control" id="primary_termination_date" name="primary_termination_date" required>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit " class="btn text-white" style="background-color:#67C090;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update secondary infomodal ends-->
<!-- update tritary info modal starts-->
<div class="modal fade" id="update_tritary_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color:#67C090;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Tritary Insurance Info</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('patients.update-tritary-info') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3">
                                <input type="hidden" id="patient_id" name="patient_id" value="{{$id}}">
                                <div class="col-md-2">
                                    <label class="form-label">Subscriber ID</label>
                                    <input value="{{$insuranceDetails['tritary_subscriber_id'] ? $insuranceDetails['tritary_subscriber_id']:''}}" type="text" class="form-control" id="primary_subscriberid" name="primary_subscriberid" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Group</label>
                                    <input value="{{$insuranceDetails['tritary_group'] ? $insuranceDetails['tritary_group']:''}}" type="text" class="form-control" id="primary_group" name="primary_group" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Payer ID</label>
                                    <input type="text" value="{{$insuranceDetails['tritary_payer_id'] ? $insuranceDetails['tritary_payer_id']:''}}" class="form-control" id="primary_payerid" name="primary_payerid" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Address</label>
                                    <input type="text" value="{{$insuranceDetails['tritary_address'] ? $insuranceDetails['tritary_address']:''}}" class="form-control" id="primary_address" name="primary_address" required>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Phone</label>
                                    <input type="text" value="{{$insuranceDetails['tritary_phone'] ? $insuranceDetails['tritary_phone']:''}}" class="form-control" id="primary_phone" name="primary_phone" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Fax</label>
                                    <input type="text" value="{{$insuranceDetails['tritary_fax'] ? $insuranceDetails['tritary_fax']:''}}" class="form-control" id="primary_fax" name="primary_fax" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Effective Date</label>
                                    <input type="date" value="{{$insuranceDetails['tritary_effective_date'] ? date('d-m-Y', strtotime($insuranceDetails['tritary_effective_date'])):''}}" class="form-control" id="primary_effective_date" name="primary_effective_date" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Termination Date</label>
                                    <input type="date" value="{{$insuranceDetails['tritary_termination_date'] ? date('d-m-Y', strtotime($insuranceDetails['tritary_termination_date'])):''}}" class="form-control" id="primary_termination_date" name="primary_termination_date" required>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit " class="btn text-white" style="background-color:#67C090;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update tritary infomodal ends-->
<div class="container-fluid viewPatientPage">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="row">
        <div class="col-6">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header text-white" style="background-color:#67C090">
                            <h6>Patient Details <span type="button" class="btn btn-sm text-white" data-bs-toggle="modal" data-bs-target="#upload_image_modal" title="Upload Patient Image"><i class="fa fa-edit"></i></span></h6>
                        </div>
                        <div class="card-body text-center" style="height: 300px;">

                            <!-- Profile Image -->
                            <img src="https://th.bing.com/th/id/OIP.HxV79tFMPfBAIo0BBF-sOgHaEy?o=7rm=3&rs=1&pid=ImgDetMain&o=7&rm=3"
                                alt="Profile Image"
                                class=" img-fluid mb-3 border"
                                style="width: 200px; height: 200px; object-fit: cover;">


                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header text-white" style="background-color:#67C090">
                            <h6>Personal Info <span type="button" class="btn btn-sm text-white" data-bs-toggle="modal" data-bs-target="#update_personal_modal" title="Update Personal Info"><i class="fa fa-edit"></i></span></h6>
                        </div>
                        <div class="card-body" style="height: 300px;">
                            <h6>{{$patientDetails['first_name'] ? $patientDetails['first_name']:''}} {{$patientDetails['last_name'] ? $patientDetails['last_name']:''}} {{$patientDetails['mi'] ? $patientDetails['mi']:''}}, {{$patientDetails['sex'] ? $patientDetails['sex']:''}}</h6>
                            <h6>Mobile: {{$patientDetails['mobilephone'] ? $patientDetails['mobilephone']:''}}</h6>
                            <h6>Home: {{$patientDetails['homephone'] ? $patientDetails['homephone']:''}}</h6>
                            <h6>Email: {{$patientDetails['email'] ? $patientDetails['email']:''}}</h6>
                            <h6>{{$patientDetails['address1'] ? $patientDetails['address1']:''}},</h6>
                            <h6>{{$patientDetails['address2'] ? $patientDetails['address2']:''}},</h6>
                            <h6>{{$patientDetails['city'] ? $patientDetails['city']:''}}, {{$patientDetails['state'] ? $patientDetails['state']:''}}, {{$patientDetails['postcode'] ? $patientDetails['postcode']:''}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header text-white" style="background-color:#67C090">
                            <h6>Guarantor Info <span type="button" class="btn btn-sm text-white" data-bs-toggle="modal" data-bs-target="#update_guarantor_modal" title="Update Guarantor Info"><i class="fa fa-edit"></i></span></h6>
                        </div>
                        <div class="card-body" style="height: 300px;">
                            <h6>{{$guarantorDetails['first_name'] ? $guarantorDetails['first_name']:''}} {{$guarantorDetails['last_name'] ? $guarantorDetails['last_name']:''}} {{$guarantorDetails['mi'] ? $guarantorDetails['mi']:''}}</h6>
                            <h6>Mobile: {{$guarantorDetails['mobilephone'] ? $guarantorDetails['mobilephone']:''}}</h6>
                            <h6>Home: {{$guarantorDetails['homephone'] ? $guarantorDetails['homephone']:''}}</h6>
                            <h6>Email: {{$guarantorDetails['email'] ? $guarantorDetails['email']:''}}</h6>
                            <h6>{{$guarantorDetails['address1'] ? $guarantorDetails['address1']:''}},</h6>
                            <h6>{{$guarantorDetails['address2'] ? $guarantorDetails['address2']:''}},</h6>
                            <h6>{{$guarantorDetails['city'] ? $guarantorDetails['city']:''}}, {{$guarantorDetails['state'] ? $guarantorDetails['state']:''}}, {{$guarantorDetails['postcode'] ? $guarantorDetails['postcode']:''}}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header text-white" style="background-color:#67C090">
                            <h6>Employer Info <span type="button" class="btn btn-sm text-white" data-bs-toggle="modal" data-bs-target="#update_employer_modal" title="Update Employer Info"><i class="fa fa-edit"></i></span></h6>
                        </div>
                        <div class="card-body" style="height: 300px;">
                            <h6>{{$employerDetails['employer_name'] ? $employerDetails['employer_name']:''}}, {{$employerDetails['department'] ? $employerDetails['department']:''}}.</h6>
                            <h6>Phone: {{$employerDetails['employer_phone'] ? $employerDetails['employer_phone']:''}}</h6>
                            <h6>Email: {{$employerDetails['email'] ? $employerDetails['email']:''}}</h6>
                            <h6>{{$employerDetails['address1'] ? $employerDetails['address1']:''}},</h6>
                            <h6>{{$employerDetails['address2'] ? $employerDetails['address2']:''}},</h6>
                            <h6>{{$employerDetails['city'] ? $employerDetails['city']:''}}, {{$employerDetails['state'] ? $employerDetails['state']:''}}, {{$employerDetails['postcode'] ? $employerDetails['postcode']:''}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header text-white" style="background-color:#67C090">
                            <h6>Emergency Contact Info <span type="button" class="btn btn-sm text-white" data-bs-toggle="modal" data-bs-target="#update_emergency_modal" title="Update Emergency Info"><i class="fa fa-edit"></i></span></h6>
                        </div>
                        <div class="card-body" style="height: 300px;">
                            <h6>Phone: {{$employerDetails['emergency_contact'] ? $employerDetails['emergency_contact']:''}}</h6>
                            <h6>Email: {{$employerDetails['relationship'] ? $employerDetails['relationship']:''}}</h6>
                            <h6>{{$employerDetails['kin_phone'] ? $employerDetails['kin_phone']:''}},</h6>
                            <h6>{{$employerDetails['kin_address'] ? $employerDetails['kin_address']:''}},</h6>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header text-white" style="background-color:#67C090">
                            <h6>Consent on File Info <span type="button" class="btn btn-sm text-white" data-bs-toggle="modal" data-bs-target="#update_file_modal" title="Update File Info"><i class="fa fa-edit"></i></span></h6>
                        </div>
                        <div class="card-body" style="height: 300px;">
                            <h6>PCP Name: {{$fileDetails['pcp_name'] ? $fileDetails['pcp_name']:''}}</h6>
                            <h6>NPI: {{$fileDetails['npi'] ? $fileDetails['npi']:''}} ABN: {{$fileDetails['abn'] ? $fileDetails['abn']:''}}</h6>
                            <h6>Privacy Notice: {{$fileDetails['privacy_notice'] ? $fileDetails['privacy_notice']:''}} ROI: {{$fileDetails['roi'] ? $fileDetails['roi']:''}}</h6>
                            <h6>Language: {{$fileDetails['language'] ? $fileDetails['language']:''}} Race: {{$fileDetails['race'] ? $fileDetails['race']:''}} Ethnicity: {{$fileDetails['ethnicity'] ? $fileDetails['ethnicity']:''}}</h6>
                            <h6>Marital Status: {{$fileDetails['marital_status'] ? $fileDetails['marital_status']:''}} Gender: {{$fileDetails['gender'] ? $fileDetails['gender']:''}}</h6>
                            <h6>Method of contact: {{$fileDetails['method_of_contact'] ? $fileDetails['method_of_contact']:''}} </h6>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-6">
            <div class="row">

                <div class="col-4">
                    <div class="card">
                        <div class="card-header text-white" style="background-color:#67C090">
                            <h6>Primary Insurance <span type="button" class="btn btn-sm text-white" data-bs-toggle="modal" data-bs-target="#update_present_modal" title="Update Primary Insurance Info"><i class="fa fa-edit"></i></span></h6>
                        </div>
                        <div class="card-body" style="height: 300px;">
                            <h6>Subscriber ID: {{$insuranceDetails['present_subscriber_id'] ? $insuranceDetails['present_subscriber_id']:''}}</h6>
                            <h6>Group: {{$insuranceDetails['present_group'] ? $insuranceDetails['present_group']:''}}</h6>
                            <h6>Payer ID: {{$insuranceDetails['present_payer_id'] ? $insuranceDetails['present_payer_id']:''}}</h6>
                            <h6>Addresss: {{$insuranceDetails['present_address'] ? $insuranceDetails['present_address']:''}}</h6>
                            <h6>Phone: {{$insuranceDetails['present_phone'] ? $insuranceDetails['present_phone']:''}}</h6>
                            <h6>FAX: {{$insuranceDetails['present_fax'] ? $insuranceDetails['present_fax']:''}}</h6>
                            <h6>Effective Date: {{$insuranceDetails['present_effective_date'] ? date('d-m-Y', strtotime($insuranceDetails['present_effective_date'])):''}}</h6>
                            <h6>Termination Date: {{$insuranceDetails['present_termination_date'] ? date('d-m-Y', strtotime($insuranceDetails['present_termination_date'])):''}}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-header text-white" style="background-color:#67C090">
                            <h6>Secondary Insurance <span type="button" class="btn btn-sm text-white" data-bs-toggle="modal" data-bs-target="#update_secondary_modal" title="Update Secondary Info"><i class="fa fa-edit"></i></span></h6>
                        </div>
                        <div class="card-body" style="height: 300px;">
                            <h6>Subscriber ID: {{$insuranceDetails['secondary_subscriber_id'] ? $insuranceDetails['secondary_subscriber_id']:''}}</h6>
                            <h6>Group: {{$insuranceDetails['secondary_group'] ? $insuranceDetails['secondary_group']:''}}</h6>
                            <h6>Payer ID: {{$insuranceDetails['secondary_payer_id'] ? $insuranceDetails['secondary_payer_id']:''}}</h6>
                            <h6>Addresss: {{$insuranceDetails['secondary_address'] ? $insuranceDetails['secondary_address']:''}}</h6>
                            <h6>Phone: {{$insuranceDetails['secondary_phone'] ? $insuranceDetails['secondary_phone']:''}}</h6>
                            <h6>FAX: {{$insuranceDetails['secondary_fax'] ? $insuranceDetails['secondary_fax']:''}}</h6>
                            <h6>Effective Date: {{$insuranceDetails['secondary_effective_date'] ? date('d-m-Y', strtotime($insuranceDetails['secondary_effective_date'])):''}}</h6>
                            <h6>Termination Date: {{$insuranceDetails['secondary_termination_date'] ? date('d-m-Y', strtotime($insuranceDetails['secondary_termination_date'])):''}}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-header text-white" style="background-color:#67C090">
                            <h6>Tritary Insurance <span type="button" class="btn btn-sm text-white" data-bs-toggle="modal" data-bs-target="#update_tritary_modal" title="Update Tritary Insurance Info"><i class="fa fa-edit"></i></span></h6>
                        </div>
                        <div class="card-body" style="height: 300px;">
                            <h6>Subscriber ID: {{$insuranceDetails['tritary_subscriber_id'] ? $insuranceDetails['tritary_subscriber_id']:''}}</h6>
                            <h6>Group: {{$insuranceDetails['tritary_group'] ? $insuranceDetails['tritary_group']:''}}</h6>
                            <h6>Payer ID: {{$insuranceDetails['tritary_payer_id'] ? $insuranceDetails['tritary_payer_id']:''}}</h6>
                            <h6>Addresss: {{$insuranceDetails['tritary_address'] ? $insuranceDetails['tritary_address']:''}}</h6>
                            <h6>Phone: {{$insuranceDetails['tritary_phone'] ? $insuranceDetails['tritary_phone']:''}}</h6>
                            <h6>FAX: {{$insuranceDetails['tritary_fax'] ? $insuranceDetails['tritary_fax']:''}}</h6>
                            <h6>Effective Date: {{$insuranceDetails['tritary_effective_date'] ? date('d-m-Y', strtotime($insuranceDetails['tritary_effective_date'])):''}}</h6>
                            <h6>Termination Date: {{$insuranceDetails['tritary_termination_date'] ? date('d-m-Y', strtotime($insuranceDetails['tritary_termination_date'])):''}}</h6>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script>

</script>
@endsection