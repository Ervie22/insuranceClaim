@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Include Bootstrap & DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<style>
    .viewPatientPage {
        font-family: "Segoe UI", Tahoma, Verdana, Arial, sans-serif;
        font-weight: 700;
        /* bold */
        font-size: 11px;

    }

    .profile-header {
        /* background: #59AC77; */
        /* height: 150px; */
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .profile-pic {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid white;
        /* position: absolute;
        top: 20px;
        left: 20px; */
    }

    .profile-card {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    }
</style>
<!-- upload image modal starts-->
<div class="modal fade" id="upload_image_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('patients.upload_image') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header " style="background-color:#59AC77;">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Patient Image</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="patient_id" name="patient_id" value={{$id}}>
                    <div class="mb-3">
                        <label for="patient_image" class="form-label">Select Image</label>
                        <input type="file" name="patient_image" id="patient_image" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn " style="background-color:#59AC77;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- upload image modal ends-->
<!-- update personal info modal starts-->
<div class="modal fade" id="update_personal_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header " style="background-color:#59AC77;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Personal Info</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('patients.update-personal-info') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body p-1">
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
                    <button type="submit " class="btn " style="background-color:#59AC77;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update personal infomodal ends-->
<!-- update guarantor info modal starts-->
<div class="modal fade" id="update_guarantor_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header " style="background-color:#59AC77;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Guarantor Image</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('patients.update-guarantor-info') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body p-1">
                            <input type="hidden" id="patient_id" name="patient_id" value="{{$id}}">
                            <div class="row g-3">
                                <div class="col-md-2">
                                    <label class="form-label">First Name</label>
                                    <input type="text" value="{{$guarantorDetails['first_name'] ? $guarantorDetails['first_name']:''}}" class="form-control" id="guarantors_firstname" name="guarantors_firstname" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" value="{{$guarantorDetails['last_name'] ? $guarantorDetails['last_name']:''}}" class="form-control" id="guarantors_lastname" name="guarantors_lastname" required>
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
                                    <input type="text" value="{{$guarantorDetails['postcode'] ? $guarantorDetails['postcode']:''}}" class="form-control" id="guarantors_postcode" name="guarantors_postcode" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit " class="btn " style="background-color:#59AC77;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update guarantor infomodal ends-->
<!-- update Employer info modal starts-->
<div class="modal fade" id="update_employer_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header " style="background-color:#59AC77;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Employer Image</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('patients.update-employer-info') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body p-1">
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
                    <button type="submit " class="btn " style="background-color:#59AC77;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update employer infomodal ends-->
<!-- update Emergency info modal starts-->
<div class="modal fade" id="update_emergency_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header " style="background-color:#59AC77;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Emergency Info</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('patients.update-emergency-info') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body p-1">
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
                                    <input type="text" value="{{$employerDetails['kin_phone'] ? $employerDetails['kin_phone']:''}}" class="form-control" id="kin_phone" name="kin_phone" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Address</label>
                                    <input value="{{$employerDetails['kin_address'] ? $employerDetails['kin_address']:''}}" type="text" class="form-control" id="kin_address" name="kin_address" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit " class="btn " style="background-color:#59AC77;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update emergency infomodal ends-->
<!-- update file info modal starts-->
<div class="modal fade" id="update_file_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header " style="background-color:#59AC77;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update File Info</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('patients.update-file-info') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body p-1">
                            <div class="row g-3">
                                <input type="hidden" id="patient_id" name="patient_id" value="{{$id}}">
                                <div class="col-md-2">
                                    <label class="form-label">PCP Name</label>
                                    <input value="{{$fileDetails['pcp_name'] ? $fileDetails['pcp_name']:''}}" type="text" class="form-control" id="pcp_name" name="pcp_name" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">PCP Phone</label>
                                    <input value="{{$fileDetails['pcp_phone'] ? $fileDetails['pcp_phone']:''}}" type="text" class="form-control" id="pcp_phone" name="pcp_phone" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">NPI</label>
                                    <input value="{{$fileDetails['npi'] ? $fileDetails['npi']:''}}" type="text" class="form-control" id="npi" name="npi" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">ABN Signature on file</label>
                                    <select class="form-control" name="abn" id="abn" required>
                                        <option value="">Select Method</option>
                                        <option {{ (isset($fileDetails['abn']) && $fileDetails['abn'] == 'Yes') ? 'selected' : '' }} value="Yes">Yes</option>
                                        <option {{ (isset($fileDetails['abn']) && $fileDetails['abn'] == 'No') ? 'selected' : '' }} value="No">No</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Privay Notice</label>
                                    <select class="form-control" name="privacy_notice" id="privacy_notice" required>
                                        <option value="">Select Method</option>
                                        <option {{ (isset($fileDetails['privacy_notice']) && $fileDetails['privacy_notice'] == 'Yes') ? 'selected' : '' }} value="Yes">Yes</option>
                                        <option {{ (isset($fileDetails['privacy_notice']) && $fileDetails['privacy_notice'] == 'No') ? 'selected' : '' }} value="No">No</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">ROI Signature on file</label>
                                    <select class="form-control" name="roi" id="roi" required>
                                        <option value="">Select Method</option>
                                        <option {{ (isset($fileDetails['roi']) && $fileDetails['roi'] == 'Yes') ? 'selected' : '' }} value="Yes">Yes</option>
                                        <option {{ (isset($fileDetails['roi']) && $fileDetails['roi'] == 'No') ? 'selected' : '' }} value="No">No</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Language</label>
                                    <select id="language" name="language" class="form-control" required>
                                        <option {{ (isset($fileDetails['language']) && $fileDetails['language'] == 'English') ? 'selected' : '' }} value="English">English</option>
                                        <option {{ (isset($fileDetails['language']) && $fileDetails['language'] == 'Spanish') ? 'selected' : '' }} value="Spanish">Spanish</option>
                                        <option {{ (isset($fileDetails['language']) && $fileDetails['language'] == 'Chinese') ? 'selected' : '' }} value="Chinese">Chinese</option>
                                        <option {{ (isset($fileDetails['language']) && $fileDetails['language'] == 'Tagalog') ? 'selected' : '' }} value="Tagalog">Tagalog</option>
                                        <option {{ (isset($fileDetails['language']) && $fileDetails['language'] == 'Vietnamese') ? 'selected' : '' }} value="Vietnamese">Vietnamese</option>
                                        <option {{ (isset($fileDetails['language']) && $fileDetails['language'] == 'Arabic') ? 'selected' : '' }} value="Arabic">Arabic</option>
                                        <option {{ (isset($fileDetails['language']) && $fileDetails['language'] == 'French') ? 'selected' : '' }} value="French">French</option>
                                        <option {{ (isset($fileDetails['language']) && $fileDetails['language'] == 'Korean') ? 'selected' : '' }} value="Korean">Korean</option>
                                        <option {{ (isset($fileDetails['language']) && $fileDetails['language'] == 'Russian') ? 'selected' : '' }} value="Russian">Russian</option>
                                        <option {{ (isset($fileDetails['language']) && $fileDetails['language'] == 'Portuguese') ? 'selected' : '' }} value="Portuguese">Portuguese</option>
                                        <option {{ (isset($fileDetails['language']) && $fileDetails['language'] == 'Haitian Creole') ? 'selected' : '' }} value="Haitian Creole">Haitian Creole</option>
                                        <option {{ (isset($fileDetails['language']) && $fileDetails['language'] == '') ? '' : '' }} value="">Other (specify)</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Race</label>
                                    <select id="race" name="race" class="form-control" required>
                                        <option value="">-- Select Race --</option>
                                        <option {{ (isset($fileDetails['race']) && $fileDetails['race'] == 'White') ? 'selected' : '' }} value="White">White</option>
                                        <option {{ (isset($fileDetails['race']) && $fileDetails['race'] == 'Black or African American') ? 'selected' : '' }} value="Black or African American">Black or African American</option>
                                        <option {{ (isset($fileDetails['race']) && $fileDetails['race'] == 'American Indian or Alaska Native') ? 'selected' : '' }} value="American Indian or Alaska Native">American Indian or Alaska Native</option>
                                        <optgroup label="Asian">
                                            <option {{ (isset($fileDetails['race']) && $fileDetails['race'] == 'Asian Indian') ? 'selected' : '' }} value="Asian Indian">Asian Indian</option>
                                            <option {{ (isset($fileDetails['race']) && $fileDetails['race'] == 'Chinese') ? 'selected' : '' }} value="Chinese">Chinese</option>
                                            <option {{ (isset($fileDetails['race']) && $fileDetails['race'] == 'Filipino') ? 'selected' : '' }} value="Filipino">Filipino</option>
                                            <option {{ (isset($fileDetails['race']) && $fileDetails['race'] == 'Japanese') ? 'selected' : '' }} value="Japanese">Japanese</option>
                                            <option {{ (isset($fileDetails['race']) && $fileDetails['race'] == 'Korean') ? 'selected' : '' }} value="Korean">Korean</option>
                                            <option {{ (isset($fileDetails['race']) && $fileDetails['race'] == 'Vietnamese') ? 'selected' : '' }} value="Vietnamese">Vietnamese</option>
                                            <option {{ (isset($fileDetails['race']) && $fileDetails['race'] == 'Other Asian') ? 'selected' : '' }} value="Other Asian">Other Asian</option>
                                        </optgroup>
                                        <optgroup label="Native Hawaiian or Other Pacific Islander">
                                            <option {{ (isset($fileDetails['race']) && $fileDetails['race'] == 'Native Hawaiian') ? 'selected' : '' }} value="Native Hawaiian">Native Hawaiian</option>
                                            <option {{ (isset($fileDetails['race']) && $fileDetails['race'] == 'Guamanian or Chamorro') ? 'selected' : '' }} value="Guamanian or Chamorro">Guamanian or Chamorro</option>
                                            <option {{ (isset($fileDetails['race']) && $fileDetails['race'] == 'Samoan') ? 'selected' : '' }} value="Samoan">Samoan</option>
                                            <option {{ (isset($fileDetails['race']) && $fileDetails['race'] == 'Other Pacific Islander') ? 'selected' : '' }} value="Other Pacific Islander">Other Pacific Islander</option>
                                        </optgroup>
                                        <option {{ (isset($fileDetails['race']) && $fileDetails['race'] == 'Some other race') ? 'selected' : '' }} value="Some other race">Some other race</option>
                                        <option {{ (isset($fileDetails['race']) && $fileDetails['race'] == 'Two or more races') ? 'selected' : '' }} value="Two or more races">Two or more races</option>
                                    </select>
                                    <!-- <input type="text" value="{{$fileDetails['race'] ? $fileDetails['race']:''}}" class="form-control" id="race" name="race" required> -->
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
                                        <option {{ (isset($fileDetails['method_of_contact']) && $fileDetails['method_of_contact'] == 'Call') ? 'selected' : '' }} value="Call">Call</option>
                                        <option {{ (isset($fileDetails['method_of_contact']) && $fileDetails['method_of_contact'] == 'Text') ? 'selected' : '' }} value="Text">Text</option>
                                        <option {{ (isset($fileDetails['method_of_contact']) && $fileDetails['method_of_contact'] == 'Email') ? 'selected' : '' }} value="Email">Email</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit " class="btn " style="background-color:#59AC77;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update file infomodal ends-->
<!-- update present info modal starts-->
<div class="modal fade" id="update_present_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header " style="background-color:#59AC77;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Present Insurance Info</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('patients.update-present-info') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body p-1">
                            <div class="row g-3">
                                <input type="hidden" id="patient_id" name="patient_id" value="{{$id}}">
                                <div class="col-md-2">
                                    <label class="form-label">Subscriber ID</label>
                                    <input value="{{$insuranceDetails['present_subscriber_id'] ? $insuranceDetails['present_subscriber_id']:''}}" type="text" class="form-control" id="present_subscriber_id" name="present_subscriber_id" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Group</label>
                                    <input value="{{$insuranceDetails['present_group'] ? $insuranceDetails['present_group']:''}}" type="text" class="form-control" id="present_group" name="present_group" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Payer ID</label>
                                    <input type="text" value="{{$insuranceDetails['present_payer_id'] ? $insuranceDetails['present_payer_id']:''}}" class="form-control" id="present_payer_id" name="present_payer_id" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Address</label>
                                    <input type="text" value="{{$insuranceDetails['present_address'] ? $insuranceDetails['present_address']:''}}" class="form-control" id="present_address" name="present_address" required>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Phone</label>
                                    <input type="text" value="{{$insuranceDetails['present_phone'] ? $insuranceDetails['present_phone']:''}}" class="form-control" id="present_phone" name="present_phone" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Fax</label>
                                    <input type="text" value="{{$insuranceDetails['present_fax'] ? $insuranceDetails['present_fax']:''}}" class="form-control" id="present_fax" name="present_fax" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Effective Date</label>
                                    <input type="date" value="{{$insuranceDetails['present_effective_date'] ? $insuranceDetails['present_effective_date']:''}}" class="form-control" id="present_effective_date" name="present_effective_date" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Termination Date</label>
                                    <input type="date" value="{{$insuranceDetails['present_termination_date'] ? $insuranceDetails['present_termination_date']:''}}" class="form-control" id="present_termination_date" name="present_termination_date" required>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit " class="btn " style="background-color:#59AC77;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update present infomodal ends-->
<!-- update secondary info modal starts-->
<div class="modal fade" id="update_secondary_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header " style="background-color:#59AC77;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Secondary Insurance Info</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('patients.update-secondary-info') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body p-1">
                            <div class="row g-3">
                                <input type="hidden" id="patient_id" name="patient_id" value="{{$id}}">
                                <div class="col-md-2">
                                    <label class="form-label">Subscriber ID</label>
                                    <input value="{{$insuranceDetails['secondary_subscriber_id'] ? $insuranceDetails['secondary_subscriber_id']:''}}" type="text" class="form-control" id="secondary_subscriber_id" name="secondary_subscriber_id" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Group</label>
                                    <input value="{{$insuranceDetails['secondary_group'] ? $insuranceDetails['secondary_group']:''}}" type="text" class="form-control" id="secondary_group" name="secondary_group" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Payer ID</label>
                                    <input type="text" value="{{$insuranceDetails['secondary_payer_id'] ? $insuranceDetails['secondary_payer_id']:''}}" class="form-control" id="secondary_payer_id" name="secondary_payer_id" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Address</label>
                                    <input type="text" value="{{$insuranceDetails['secondary_address'] ? $insuranceDetails['secondary_address']:''}}" class="form-control" id="secondary_address" name="secondary_address" required>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Phone</label>
                                    <input type="text" value="{{$insuranceDetails['secondary_phone'] ? $insuranceDetails['secondary_phone']:''}}" class="form-control" id="secondary_phone" name="secondary_phone" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Fax</label>
                                    <input type="text" value="{{$insuranceDetails['secondary_fax'] ? $insuranceDetails['secondary_fax']:''}}" class="form-control" id="secondary_fax" name="secondary_fax" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Effective Date</label>
                                    <input type="date" value="{{$insuranceDetails['secondary_effective_date'] ? $insuranceDetails['secondary_effective_date']:''}}" class="form-control" id="secondary_effective_date" name="secondary_effective_date" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Termination Date</label>
                                    <input type="date" value="{{$insuranceDetails['secondary_termination_date'] ? $insuranceDetails['secondary_termination_date']:''}}" class="form-control" id="secondary_termination_date" name="secondary_termination_date" required>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit " class="btn " style="background-color:#59AC77;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update secondary infomodal ends-->
<!-- update tritary info modal starts-->
<div class="modal fade" id="update_tritary_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header " style="background-color:#59AC77;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Tritary Insurance Info</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('patients.update-tritary-info') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body p-1">
                            <div class="row g-3">
                                <input type="hidden" id="patient_id" name="patient_id" value="{{$id}}">
                                <div class="col-md-2">
                                    <label class="form-label">Subscriber ID</label>
                                    <input value="{{$insuranceDetails['tritary_subscriber_id'] ? $insuranceDetails['tritary_subscriber_id']:''}}" type="text" class="form-control" id="tritary_subscriber_id" name="tritary_subscriber_id" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Group</label>
                                    <input value="{{$insuranceDetails['tritary_group'] ? $insuranceDetails['tritary_group']:''}}" type="text" class="form-control" id="tritary_group" name="tritary_group" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Payer ID</label>
                                    <input type="text" value="{{$insuranceDetails['tritary_payer_id'] ? $insuranceDetails['tritary_payer_id']:''}}" class="form-control" id="tritary_payer_id" name="tritary_payer_id" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Address</label>
                                    <input type="text" value="{{$insuranceDetails['tritary_address'] ? $insuranceDetails['tritary_address']:''}}" class="form-control" id="tritary_address" name="tritary_address" required>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Phone</label>
                                    <input type="text" value="{{$insuranceDetails['tritary_phone'] ? $insuranceDetails['tritary_phone']:''}}" class="form-control" id="tritary_phone" name="tritary_phone" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Fax</label>
                                    <input type="text" value="{{$insuranceDetails['tritary_fax'] ? $insuranceDetails['tritary_fax']:''}}" class="form-control" id="tritary_fax" name="tritary_fax" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Effective Date</label>
                                    <input type="date" value="{{$insuranceDetails['tritary_effective_date'] ? $insuranceDetails['tritary_effective_date']:''}}" class="form-control" id="tritary_effective_date" name="tritary_effective_date" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Termination Date</label>
                                    <input type="date" value="{{$insuranceDetails['tritary_termination_date'] ? $insuranceDetails['tritary_termination_date']:''}}" class="form-control" id="tritary_termination_date" name="tritary_termination_date" required>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit " class="btn " style="background-color:#59AC77;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update tritary infomodal ends-->
<!-- update tritary note modal starts-->
<div class="modal fade" id="update_note_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header " style="background-color:#59AC77;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Notes</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('patients.update-patient-note') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body p-1">
                            <div class="row g-3">
                                <input type="hidden" id="patient_id" name="patient_id" value="{{$id}}">
                                <div class="col-md-12">
                                    <label class="form-label">Notes</label>
                                    <textarea class="form-control" name="patient_notes" id="patient_notes">
                                    {{$patientNote['notes'] ? $patientNote['notes']:''}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit " class="btn " style="background-color:#59AC77;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update notes modal ends-->
<div class="container-fluid viewPatientPage">
    @if(session('success'))
    <div class="alert alert-success" id="success-alert">
        {{ session('success') }}
    </div>
    @endif

    <div class="card profile-card">
        <!-- Header Background -->
        <!-- <div class="profile-header">


            <div class="row" style=" margin-left:120px;" style="width:100%;">


            </div>
        </div> -->

        <!-- Profile Image -->
        <!-- <img src="https://via.placeholder.com/120" alt="Profile" class="profile-pic"> -->

        <!-- Profile Details -->
        <div class="card-body">
            <div class="row">
                <div class="col-1">
                    @if(isset($patientDetails['profile_image_path']))
                    <img src="{{ asset('storage/patient/patient_images/'.$patientDetails['profile_image_path']) }}" alt="Patient Image" class="profile-pic"
                        style="width: 100px; height: 100px; object-fit: cover;">
                    <span type="button" class="btn btn-sm" style="margin-left:110;" data-bs-toggle="modal" data-bs-target="#upload_image_modal" title="Upload Patient Image">
                        <i class="fa fa-camera"></i>
                    </span>
                    @else
                    <!-- Profile Image -->
                    <img src="https://th.bing.com/th/id/OIP.HxV79tFMPfBAIo0BBF-sOgHaEy?o=7rm=3&rs=1&pid=ImgDetMain&o=7&rm=3"
                        alt="Profile Image"
                        class="profile-pic"
                        style="width: 100px; height: 100px; object-fit: cover;">
                    <span type="button" class="btn btn-sm" style="margin-left:110;" data-bs-toggle=" modal" data-bs-target="#upload_image_modal" title="Upload Patient Image">
                        <i class="fa fa-camera"></i>
                    </span>
                    @endif

                </div>
                <div class="col-4">
                    <h5 class="card-title mb-0" style="color:#59AC77;">
                        {{$patientDetails['first_name'] ? $patientDetails['first_name']:''}}
                        {{$patientDetails['last_name'] ? $patientDetails['last_name']:''}}
                        {{$patientDetails['mi'] ? $patientDetails['mi']:''}}
                        <span type="button" class="btn btn-sm " data-bs-toggle="modal" data-bs-target="#update_personal_modal" title="Update Personal Info">
                            <i class="fa fa-edit"></i>
                        </span>
                    </h5>
                    <p class="text-muted">{{$patientDetails['sex'] ? $patientDetails['sex']:''}}
                        <span class="badge {{ $patientDetails['active'] == 1 ? 'bg-success' : 'bg-danger' }}">
                            {{ $patientDetails['active'] == 1 ? 'Active' : 'Inactive' }}
                        </span>
                    </p>
                    <p class="text-secondary mb-1">Mobile: <span style="color:#57564F;">{{$patientDetails['mobilephone'] ? $patientDetails['mobilephone']:''}}</span> Home: <span style="color:#57564F;">{{$patientDetails['homephone'] ? $patientDetails['homephone']:''}}</span></p>
                    <p class="text-secondary mb-1">Email: <span style="color:#57564F;">{{$patientDetails['email'] ? $patientDetails['email']:''}}</span></p>
                    <p class="text-secondary mb-1">
                        Address:
                        <span style="color:#57564F;">
                            {{$patientDetails['address1'] ? $patientDetails['address1']:''}},
                            {{$patientDetails['address2'] ? $patientDetails['address2']:''}},
                        </span>
                        <span style="color:#57564F;">
                            {{$patientDetails['city'] ? $patientDetails['city']:''}},
                            {{$patientDetails['state'] ? $patientDetails['state']:''}},
                            {{$patientDetails['postcode'] ? $patientDetails['postcode']:''}}
                        </span>
                    </p>
                </div>
                <div class="col-4">
                    <h5 class="card-title mb-0" style="color:#59AC77;">
                        Emergency Info
                        <span type="button" class="btn btn-sm " data-bs-toggle="modal" data-bs-target="#update_emergency_modal" title="Update Emergency Insurance Info">
                            <i class="fa fa-edit"></i>
                        </span>
                    </h5>
                    <p class="text-secondary mb-1">
                        Name:
                        <span style="color:#57564F;">
                            {{$employerDetails['emergency_contact'] ? $employerDetails['emergency_contact']:''}}
                        </span>
                        Relationship:
                        <span style="color:#57564F;">
                            {{$employerDetails['relationship'] ? $employerDetails['relationship']:''}}
                        </span>

                    </p>

                    <p class="text-secondary mb-1">
                        Phone:
                        <span style="color:#57564F;">
                            {{$employerDetails['kin_phone'] ? $employerDetails['kin_phone']:''}}
                        </span>
                    </p>
                    <p class="text-secondary mb-1">
                        Addresss:
                        <span style="color:#57564F;">
                            {{$employerDetails['kin_address'] ? $employerDetails['kin_address']:''}}
                        </span>
                    </p>
                    <p class="text-secondary mb-1">
                        Note:
                        <span style="color:#57564F;">
                            {{$patientDetails['notes'] ? $patientDetails['notes']:''}}
                        </span>
                    </p>
                </div>
                <div class="col-3">
                    <h5 class="card-title mb-0" style="color:#59AC77;">
                        Employer Info
                        <span type="button" class="btn btn-sm " data-bs-toggle="modal" data-bs-target="#update_employer_modal" title="Update Employer Info">
                            <i class="fa fa-edit"></i>
                        </span>
                    </h5>
                    <p class="text-secondary mb-1">Name: <span style="color:#57564F;">{{$employerDetails['employer_name'] ? $employerDetails['employer_name']:''}}</span> Department: <span style="color:#57564F;">{{$employerDetails['department'] ? $employerDetails['department']:''}}</span></p>
                    <p class="text-secondary mb-1">Phone: <span style="color:#57564F;">{{$employerDetails['employer_phone'] ? $employerDetails['employer_phone']:''}}</span> Email: <span style="color:#57564F;">{{$employerDetails['email'] ? $employerDetails['email']:''}}</span></p>
                    <p class="text-secondary mb-1">
                        Address:
                        <span style="color:#57564F;">
                            {{$employerDetails['address1'] ? $employerDetails['address1']:''}},
                            {{$employerDetails['address2'] ? $employerDetails['address2']:''}},
                        </span>
                        <span style="color:#57564F;">
                            {{$employerDetails['city'] ? $employerDetails['city']:''}},
                            {{$employerDetails['state'] ? $employerDetails['state']:''}},
                            {{$employerDetails['postcode'] ? $employerDetails['postcode']:''}}
                        </span>
                    </p>
                </div>
            </div>
            <div class="row">

                <div class="col-3">
                    <h5 class="card-title mb-0" style="color:#59AC77;">
                        Primary Insurance Info
                        <span type="button" class="btn btn-sm " data-bs-toggle="modal" data-bs-target="#update_present_modal" title="Update Primary Insurance Info">
                            <i class="fa fa-edit"></i>
                        </span>
                    </h5>
                    <p class="text-secondary mb-1">
                        Subscriber ID:
                        <span style="color:#57564F;">
                            {{$insuranceDetails['present_subscriber_id'] ? $insuranceDetails['present_subscriber_id']:''}}
                        </span>
                        Group:
                        <span style="color:#57564F;">
                            {{$insuranceDetails['present_group'] ? $insuranceDetails['present_group']:''}}
                        </span>
                        Payer ID:
                        <span style="color:#57564F;">
                            {{$insuranceDetails['present_payer_id'] ? $insuranceDetails['present_payer_id']:''}}
                        </span>
                    </p>
                    <p class="text-secondary mb-1">
                        Addresss:
                        <span style="color:#57564F;">
                            {{$insuranceDetails['present_address'] ? $insuranceDetails['present_address']:''}}
                        </span>
                    </p>
                    <p class="text-secondary mb-1">
                        Phone:
                        <span style="color:#57564F;">
                            {{$insuranceDetails['present_phone'] ? $insuranceDetails['present_phone']:''}}
                        </span>
                        FAX:
                        <span style="color:#57564F;">
                            {{$insuranceDetails['present_fax'] ? $insuranceDetails['present_fax']:''}}
                        </span>
                    </p>
                    <p class="text-secondary mb-1">
                        Effective Date:
                        <span style="color:#57564F;">
                            {{$insuranceDetails['present_effective_date'] ? date('d-m-Y', strtotime($insuranceDetails['present_effective_date'])):''}}
                        </span>
                        Termination Date:
                        <span style="color:#57564F;">
                            {{$insuranceDetails['present_termination_date'] ? date('d-m-Y', strtotime($insuranceDetails['present_termination_date'])):''}}
                        </span>
                    </p>

                </div>
                <div class="col-3">
                    <h5 class="card-title mb-0" style="color:#59AC77;">
                        Secondary Insurance Info
                        <span type="button" class="btn btn-sm " data-bs-toggle="modal" data-bs-target="#update_secondary_modal" title="Update Secondary Insurance Info">
                            <i class="fa fa-edit"></i>
                        </span>
                    </h5>
                    <p class="text-secondary mb-1">
                        Subscriber ID:
                        <span style="color:#57564F;">
                            {{$insuranceDetails['secondary_subscriber_id'] ? $insuranceDetails['secondary_subscriber_id']:''}}
                        </span>
                        Group:
                        <span style="color:#57564F;">
                            {{$insuranceDetails['secondary_group'] ? $insuranceDetails['secondary_group']:''}}
                        </span>
                        Payer ID:
                        <span style="color:#57564F;">
                            {{$insuranceDetails['secondary_payer_id'] ? $insuranceDetails['secondary_payer_id']:''}}
                        </span>
                    </p>
                    <p class="text-secondary mb-1">
                        Addresss:
                        <span style="color:#57564F;">
                            {{$insuranceDetails['secondary_address'] ? $insuranceDetails['secondary_address']:''}}
                        </span>
                    </p>
                    <p class="text-secondary mb-1">
                        Phone:
                        <span style="color:#57564F;">
                            {{$insuranceDetails['secondary_phone'] ? $insuranceDetails['secondary_phone']:''}}
                        </span>
                        FAX:
                        <span style="color:#57564F;">
                            {{$insuranceDetails['secondary_fax'] ? $insuranceDetails['secondary_fax']:''}}
                        </span>
                    </p>
                    <p class="text-secondary mb-1">
                        Effective Date:
                        <span style="color:#57564F;">
                            {{$insuranceDetails['secondary_effective_date'] ? date('d-m-Y', strtotime($insuranceDetails['secondary_effective_date'])):''}}
                        </span>
                        Termination Date:
                        <span style="color:#57564F;">
                            {{$insuranceDetails['secondary_termination_date'] ? date('d-m-Y', strtotime($insuranceDetails['secondary_termination_date'])):''}}
                        </span>
                    </p>

                </div>
                <div class="col-3">
                    <h5 class="card-title mb-0" style="color:#59AC77;">
                        Tritary Insurance Info
                        <span type="button" class="btn btn-sm " data-bs-toggle="modal" data-bs-target="#update_tritary_modal" title="Update Tritary Insurance Info">
                            <i class="fa fa-edit"></i>
                        </span>
                    </h5>
                    <p class="text-secondary mb-1">
                        Subscriber ID:
                        <span style="color:#57564F;">
                            {{$insuranceDetails['tritary_subscriber_id'] ? $insuranceDetails['tritary_subscriber_id']:''}}
                        </span>
                        Group:
                        <span style="color:#57564F;">
                            {{$insuranceDetails['tritary_group'] ? $insuranceDetails['tritary_group']:''}}
                        </span>
                        Payer ID:
                        <span style="color:#57564F;">
                            {{$insuranceDetails['tritary_payer_id'] ? $insuranceDetails['tritary_payer_id']:''}}
                        </span>
                    </p>
                    <p class="text-secondary mb-1">
                        Addresss:
                        <span style="color:#57564F;">
                            {{$insuranceDetails['tritary_address'] ? $insuranceDetails['tritary_address']:''}}
                        </span>
                    </p>
                    <p class="text-secondary mb-1">
                        Phone:
                        <span style="color:#57564F;">
                            {{$insuranceDetails['tritary_phone'] ? $insuranceDetails['tritary_phone']:''}}
                        </span>
                        FAX:
                        <span style="color:#57564F;">
                            {{$insuranceDetails['tritary_fax'] ? $insuranceDetails['tritary_fax']:''}}
                        </span>
                    </p>
                    <p class="text-secondary mb-1">
                        Effective Date:
                        <span style="color:#57564F;">
                            {{$insuranceDetails['tritary_effective_date'] ? date('d-m-Y', strtotime($insuranceDetails['tritary_effective_date'])):''}}
                        </span>
                        Termination Date:
                        <span style="color:#57564F;">
                            {{$insuranceDetails['tritary_termination_date'] ? date('d-m-Y', strtotime($insuranceDetails['tritary_termination_date'])):''}}
                        </span>
                    </p>

                </div>
                <div class="col-3">

                    <h5 class="card-title mb-0" style="color:#59AC77;">
                        Guarantors Info
                        <span type="button" class="btn btn-sm " data-bs-toggle="modal" data-bs-target="#update_guarantor_modal" title="Update Guarantors  Info">
                            <i class="fa fa-edit"></i>
                        </span>
                    </h5>
                    <p class="text-secondary mb-1">
                        Name:
                        <span style="color:#57564F;">
                            {{$guarantorDetails['first_name'] ? $guarantorDetails['first_name']:''}} {{$guarantorDetails['last_name'] ? $guarantorDetails['last_name']:''}} {{$guarantorDetails['mi'] ? $guarantorDetails['mi']:''}}
                        </span>

                    </p>
                    <p class="text-secondary mb-1">Mobile: <span style="color:#57564F;">{{$guarantorDetails['mobilephone'] ? $guarantorDetails['mobilephone']:''}}</span> Home: <span style="color:#57564F;">{{$guarantorDetails['homephone'] ? $guarantorDetails['homephone']:''}}</span></p>
                    <p class="text-secondary mb-1">Email: <span style="color:#57564F;">{{$guarantorDetails['email'] ? $guarantorDetails['email']:''}}</span></p>
                    <p class="text-secondary mb-1">
                        Address:
                        <span style="color:#57564F;">
                            {{$guarantorDetails['address1'] ? $guarantorDetails['address1']:''}},
                            {{$guarantorDetails['address2'] ? $guarantorDetails['address2']:''}},
                        </span>
                        <span style="color:#57564F;">
                            {{$guarantorDetails['city'] ? $guarantorDetails['city']:''}},
                            {{$guarantorDetails['state'] ? $guarantorDetails['state']:''}},
                            {{$guarantorDetails['postcode'] ? $guarantorDetails['postcode']:''}}
                        </span>
                    </p>

                </div>

            </div>
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title mb-0" style="color:#59AC77;">
                                Consent File Info
                                <span type="button" class="btn btn-sm " data-bs-toggle="modal" data-bs-target="#update_file_modal" title="Update File  Info">
                                    <i class="fa fa-edit"></i>
                                </span>
                            </h5>
                            <p class="text-secondary mb-1">
                                PCP Name:
                                <span style="color:#57564F;">
                                    {{$fileDetails['pcp_name'] ? $fileDetails['pcp_name']:''}}
                                </span>
                                PCP Phone:
                                <span style="color:#57564F;">
                                    {{$fileDetails['pcp_phone'] ? $fileDetails['pcp_phone']:''}}
                                </span>
                            </p>
                            <p class="text-secondary mb-1">

                                NPI:
                                <span style="color:#57564F;">
                                    {{$fileDetails['npi'] ? $fileDetails['npi']:''}}
                                </span>
                                ABN:
                                <span style="color:#57564F;">
                                    {{$fileDetails['abn'] ? $fileDetails['abn']:''}}
                                </span>

                            </p>
                            <p class="text-secondary mb-1">
                                Privacy Notice:
                                <span style="color:#57564F;">
                                    {{$fileDetails['privacy_notice'] ? $fileDetails['privacy_notice']:''}}
                                </span>
                                ROI:
                                <span style="color:#57564F;">
                                    {{$fileDetails['roi'] ? $fileDetails['roi']:''}}
                                </span>
                                Language:
                                <span style="color:#57564F;">
                                    {{$fileDetails['Language'] ? $fileDetails['Language']:''}}
                                </span>
                            </p>
                            <p class="text-secondary mb-1">
                                Race:
                                <span style="color:#57564F;">
                                    {{$fileDetails['race'] ? $fileDetails['race']:''}}
                                </span>
                                Ethnicity:
                                <span style="color:#57564F;">
                                    {{$fileDetails['ethnicity'] ? $fileDetails['ethnicity']:''}}
                                </span>
                            </p>
                            <p class="text-secondary mb-1">
                                Gender:
                                <span style="color:#57564F;">
                                    {{$fileDetails['gender'] ? $fileDetails['gender']:''}}
                                </span>
                                Method Of Call:
                                <span style="color:#57564F;">
                                    {{$fileDetails['method_of_contact'] ? $fileDetails['method_of_contact']:''}}
                                </span>
                            </p>
                        </div>
                        <div class="col-6">


                        </div>

                    </div>
                </div>
                <div class="col-6">
                    <div class="card p-1" style="width:100%;">
                        <div class="card-haeder text-white" style="background-color:#59AC77; width:100%;">
                            <h6>Notes <span type="button" class="btn btn-sm " data-bs-toggle="modal" data-bs-target="#update_note_modal" title="Update Notes">
                                    <i class="fa fa-edit"></i>
                                </span></h6>
                        </div>
                        <div class="card-body" style="height:300px; overflow-y:auto;">
                            <table id="notesTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:20%">User</th>
                                        <th style="width:60%">Notes</th>
                                        <th style="width:20%">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($patientNoteList as $keyn=>$valn)
                                    <tr>
                                        <td>{{$valn['first_name']}} {{$valn['last_name']}}</td>
                                        <td>
                                            {{$valn['notes']}}
                                        </td>
                                        <td>{{date('d-m-Y H:i', strtotime($valn['updated_at']))}}</td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
            <div class="row" style="width:100%;">
                <div class="card p-1" style="width:100%;">
                    <div class="card-haeder text-white" style="background-color:#59AC77; width:100%;">
                        <h6>Patient History</h6>
                    </div>
                    <div class="card-body" style="height:300px; overflow-y:auto;">
                        <table id="logsTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:20%">User</th>
                                    <th style="width:60%">Action</th>
                                    <th style="width:20%">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($patientHistory as $key=>$val)
                                <tr>
                                    <td>{{$val['user_name']}}</td>
                                    <td>
                                        {{$val['action']}}
                                    </td>
                                    <td>{{date('d-m-Y H:i', strtotime($val['created_at']))}}</td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery & DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    // hide alert after 3 seconds
    setTimeout(function() {
        $('#success-alert').fadeOut('slow');
    }, 3000);
</script>
<script>
    $(document).ready(function() {
        $('#logsTable').DataTable({
            pageLength: 5, // number of rows per page
            lengthMenu: [5, 10, 25, 50], // dropdown for rows
            order: [
                [2, 'desc']
            ], // default sort by timestamp DESC
        });
        $('#notesTable').DataTable({
            pageLength: 5, // number of rows per page
            lengthMenu: [3, 10, 25, 50], // dropdown for rows
            order: [
                [2, 'desc']
            ], // default sort by timestamp DESC
        });
    });
</script>
@endsection