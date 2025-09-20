@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <form id="createPatientForm" method="POST" action="{{ route('patients.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header text-white" style="background-color:#67C090;">
                <h6>Patients Info</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">MI</label>
                        <input type="text" class="form-control" id="mi" name="mi" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">DOB</label>
                        <input type="date" class="form-control" name="dob" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Sex at Birth</label>
                        <select class="form-control" name="sex" id="sex" required>
                            <option value="">Select Sex</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">SSN</label>
                        <input type="text" class="form-control" id="ssn" name="ssn" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Home Phone</label>
                        <input type="text" class="form-control" id="homephone" name="homephone" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Mobile Phone</label>
                        <input type="text" class="form-control" id="mobilephone" name="mobilephone" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Address 1</label>
                        <input type="text" class="form-control" id="address1" name="address1" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Address 2</label>
                        <input type="text" class="form-control" id="address2" name="address2" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">State</label>
                        <input type="text" class="form-control" id="state" name="state" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Post Code</label>
                        <input type="text" class="form-control" id="postcode" name="postcode" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-white" style="background-color:#67C090;">
                <h6>Guarantors Info</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" id="guarantors_firstname" name="guarantors_firstname" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="guarantors_lastname" name="guarantors_lastname" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">MI</label>
                        <input type="text" class="form-control" id="guarantors_mi" name="guarantors_mi" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">DOB</label>
                        <input type="date" class="form-control" id="guarantors_dob" name="guarantors_dob" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Status</label>
                        <select class="form-control" name="guarantors_status" id="guarantors_status" required>
                            <option value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Realtionship With Patient</label>
                        <input type="text" class="form-control" id="guarantors_relationship" name="guarantors_relationship" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Home Phone</label>
                        <input type="text" class="form-control" id="guarantors_homephone" name="guarantors_homephone" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Mobile Phone</label>
                        <input type="text" class="form-control" id="guarantors_mobilephone" name="guarantors_mobilephone" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" id="guarantors_email" name="guarantors_email" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Address 1</label>
                        <input type="text" class="form-control" id="guarantors_address1" name="guarantors_address1" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Address 2</label>
                        <input type="text" class="form-control" id="guarantors_address2" name="guarantors_address2" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">City</label>
                        <input type="text" class="form-control" id="guarantors_city" name="guarantors_city" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">State</label>
                        <input type="text" class="form-control" id="guarantors_state" name="guarantors_state" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Post Code</label>
                        <input type="text" class="form-control" id="guarantors_postcode" name="guarantors_postcode" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-white" style="background-color:#67C090;">
                <h6>Employer & Emergency Contact Info</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">Employer Name</label>
                        <input type="text" class="form-control" id="employer_name" name="employer_name" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Department</label>
                        <input type="text" class="form-control" id="department" name="department" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" id="employer_phone" name="employer_phone" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Work Email</label>
                        <input type="email" class="form-control" id="employer_email" name="employer_email" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Address 1</label>
                        <input type="text" class="form-control" id="employer_address1" name="employer_address1" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Address 2</label>
                        <input type="text" class="form-control" id="employer_address2" name="employer_address2" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">City</label>
                        <input type="text" class="form-control" id="employer_city" name="employer_city" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">State</label>
                        <input type="text" class="form-control" id="employer_state" name="employer_state" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Post Code</label>
                        <input type="text" class="form-control" id="employer_postcode" name="employer_postcode" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Emergency Contact</label>
                        <input type="text" class="form-control" id="emergency_contact" name="emergency_contact" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Relationship</label>
                        <input type="text" class="form-control" id="emergency_relationship" name="emergency_relationship" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" id="emergency_phone" name="emergency_phone" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" id="emergency_address" name="emergency_address" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-white" style="background-color:#67C090;">
                <h6>Consent On File</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">PCP Name</label>
                        <input type="text" class="form-control" id="pcp_name" name="pcp_name" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">NPI</label>
                        <input type="text" class="form-control" id="npi" name="npi" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">ABN Signature on file</label>
                        <input type="text" class="form-control" id="abn" name="abn" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Privay Notice</label>
                        <input type="text" class="form-control" id="privacy_notice" name="privacy_notice" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">ROI Signature on file</label>
                        <input type="text" class="form-control" id="roi" name="roi" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Language</label>
                        <input type="text" class="form-control" id="language" name="language" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Race</label>
                        <input type="text" class="form-control" id="race" name="race" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Ethnicity</label>
                        <input type="text" class="form-control" id="ethnicity" name="ethnicity" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Marital Status</label>
                        <select class="form-control" name="marital_status" id="marital_status" required>
                            <option value="">Select </option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Gender identity / Pronouns</label>
                        <input type="text" class="form-control" id="gender" name="gender" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Preferred Method of Contact</label>
                        <select class="form-control" name="method_of_contact" id="method_of_contact" required>
                            <option value="">Select Method</option>
                            <option value="Call">Call</option>
                            <option value="Text">Text</option>
                            <option value="Email">Email</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Patient Notes</label>
                        <textarea class="form-control" name="patient_notes" id="patient_notes"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-white" style="background-color:#67C090;">
                <h6>Present Insurance</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">Subscriber ID</label>
                        <input type="text" class="form-control" id="primary_subscriberid" name="primary_subscriberid" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Group</label>
                        <input type="text" class="form-control" id="primary_group" name="primary_group" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Payer ID</label>
                        <input type="text" class="form-control" id="primary_payerid" name="primary_payerid" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" id="primary_address" name="primary_address" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" id="primary_phone" name="primary_phone" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Fax</label>
                        <input type="text" class="form-control" id="primary_fax" name="primary_fax" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Effective Date</label>
                        <input type="date" class="form-control" id="primary_effective_date" name="primary_effective_date" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Termination Date</label>
                        <input type="date" class="form-control" id="primary_termination_date" name="primary_termination_date" required>
                    </div>

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-white" style="background-color:#67C090;">
                <h6>Secondary Insurance</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">Subscriber ID</label>
                        <input type="text" class="form-control" id="secondary_subscriberid" name="secondary_subscriberid" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Group</label>
                        <input type="text" class="form-control" id="secondary_group" name="secondary_group" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Payer ID</label>
                        <input type="text" class="form-control" id="secondary_payerid" name="secondary_payerid" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" id="secondary_address" name="secondary_address" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" id="secondary_phone" name="secondary_phone" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Fax</label>
                        <input type="text" class="form-control" id="secondary_fax" name="secondary_fax" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Effective Date</label>
                        <input type="date" class="form-control" id="secondary_effective_date" name="secondary_effective_date" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Termination Date</label>
                        <input type="date" class="form-control" id="secondary_termination_date" name="secondary_termination_date" required>
                    </div>

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-white" style="background-color:#67C090;">
                <h6>Tritary Insurance</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">Subscriber ID</label>
                        <input type="text" class="form-control" id="tritary_subscriberid" name="tritary_subscriberid" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Group</label>
                        <input type="text" class="form-control" id="tritary_group" name="tritary_group" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Payer ID</label>
                        <input type="text" class="form-control" id="tritary_payerid" name="tritary_payerid" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" id="tritary_address" name="tritary_address" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" id="tritary_phone" name="tritary_phone" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Fax</label>
                        <input type="text" class="form-control" id="tritary_fax" name="tritary_fax" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Effective Date</label>
                        <input type="date" class="form-control" id="tritary_effective_date" name="tritary_effective_date" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Termination Date</label>
                        <input type="date" class="form-control" id="tritary_termination_date" name="tritary_termination_date" required>
                    </div>

                </div>
            </div>

        </div>
        <div class="col text-center">
            <button type="submit" class="btn btn-success text-white">Submit</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>
    // $('#createPatientForm').submit(function(e) {
    //     e.preventDefault();
    //     alert('entered');
    //     let formData = new FormData(this);
    //     $.ajax({
    //         url: "{{ route('patients.store') }}",
    //         method: "POST",
    //         data: formData,
    //         contentType: false,
    //         processData: false,
    //         dataType: 'json',
    //         success: function(response) {
    //             alert('Patient created successfully!');
    //             window.location = '/patients';
    //         },
    //         error: function(xhr) {
    //             alert('Error: ' + xhr.responseText);
    //         }
    //     });
    // });
</script>
@endpush