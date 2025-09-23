@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <form id="createPatientForm" method="POST" action="{{ route('patients.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header text-white p-1" style="background-color:#00A6D9;">
                <h6>Patients Info</h6>
            </div>
            <div class="card-body p-1">
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
            <div class="card-header text-white p-1" style="background-color:#00A6D9;">
                <h6>Guarantors Info</h6>
            </div>
            <div class="card-body p-1">
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
            <div class="card-header text-white p-1" style="background-color:#00A6D9;">
                <h6>Employer & Emergency Contact Info</h6>
            </div>
            <div class="card-body p-1">
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
                        <input type="text" class="form-control" id="kin_phone" name="kin_phone" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" id="kin_address" name="kin_address" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-white p-1" style="background-color:#00A6D9;">
                <h6>Consent On File</h6>
            </div>
            <div class="card-body p-1">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">PCP Name</label>
                        <input type="text" class="form-control" id="pcp_name" name="pcp_name" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">PCP Phone</label>
                        <input type="text" class="form-control" id="pcp_phone" name="pcp_hone" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">NPI</label>
                        <input type="text" class="form-control" id="npi" name="npi" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">ABN Signature on file</label>
                        <select class="form-control" name="abn" id="abn" required>
                            <option value="">Select Method</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Privay Notice</label>
                        <select class="form-control" name="privacy_notice" id="privacy_notice" required>
                            <option value="">Select Method</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">ROI Signature on file</label>
                        <select class="form-control" name="roi" id="roi" required>
                            <option value="">Select Method</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Language</label>
                        <select id="language" name="language" class="form-control" required>
                            <option value="">-- Select Language --</option>
                            <option>English</option>
                            <option>Spanish</option>
                            <option>Chinese (Mandarin, Cantonese)</option>
                            <option>Tagalog</option>
                            <option>Vietnamese</option>
                            <option>Arabic</option>
                            <option>French</option>
                            <option>Korean</option>
                            <option>Russian</option>
                            <option>Portuguese</option>
                            <option>Haitian Creole</option>
                            <option>Other (specify)</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Race</label>
                        <select id="race" name="race" class="form-control" required>
                            <option value="">-- Select Race --</option>
                            <option>White</option>
                            <option>Black or African American</option>
                            <option>American Indian or Alaska Native</option>
                            <optgroup label="Asian">
                                <option>Asian Indian</option>
                                <option>Chinese</option>
                                <option>Filipino</option>
                                <option>Japanese</option>
                                <option>Korean</option>
                                <option>Vietnamese</option>
                                <option>Other Asian</option>
                            </optgroup>
                            <optgroup label="Native Hawaiian or Other Pacific Islander">
                                <option>Native Hawaiian</option>
                                <option>Guamanian or Chamorro</option>
                                <option>Samoan</option>
                                <option>Other Pacific Islander</option>
                            </optgroup>
                            <option>Some other race</option>
                            <option>Two or more races</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Ethnicity</label>
                        <select id="ethnicity" name="ethnicity" class="form-control" required>
                            <option value="">-- Select Ethnicity --</option>
                            <optgroup label="White">
                                <option>English / Welsh / Scottish / Northern Irish / British</option>
                                <option>Irish</option>
                                <option>Gypsy or Irish Traveller</option>
                                <option>Any other White background</option>
                            </optgroup>
                            <optgroup label="Mixed / Multiple ethnic groups">
                                <option>White and Black Caribbean</option>
                                <option>White and Black African</option>
                                <option>White and Asian</option>
                                <option>Any other Mixed / Multiple ethnic background</option>
                            </optgroup>
                            <optgroup label="Asian / Asian British">
                                <option>Indian</option>
                                <option>Pakistani</option>
                                <option>Bangladeshi</option>
                                <option>Chinese</option>
                                <option>Any other Asian background</option>
                            </optgroup>
                            <optgroup label="Black / African / Caribbean / Black British">
                                <option>African</option>
                                <option>Caribbean</option>
                                <option>Any other Black / African / Caribbean background</option>
                            </optgroup>
                            <optgroup label="Other ethnic group">
                                <option>Arab</option>
                                <option>Any other ethnic group</option>
                            </optgroup>
                            <option>Prefer not to say</option>
                        </select>
                        <!-- <input type="text" class="form-control" id="ethnicity" name="ethnicity" required> -->
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Marital Status</label>
                        <select class="form-control" name="marital_status" id="marital_status" required>
                            <option value="">Select </option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Employed">Employed</option>
                            <option value="Full-Time Student">Full-Time Student</option>
                            <option value="Part-Time Student">Part-Time Student</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="gender_identity">Gender Identity & Pronouns</label>
                        <select id="gender" name="gender" class="form-control">
                            <option value="">-- Select Gender / Identity / Pronouns --</option>
                            <!-- Binary -->
                            <option value="male_he_him">Male (He/Him)</option>
                            <option value="female_she_her">Female (She/Her)</option>

                            <!-- Non-binary / Gender diverse -->
                            <option value="non_binary_they_them">Non-binary (They/Them)</option>
                            <option value="agender_they_them">Agender (They/Them)</option>
                            <option value="genderqueer_they_them">Genderqueer (They/Them)</option>
                            <option value="genderfluid_they_them">Genderfluid (They/Them)</option>
                            <option value="two_spirit_they_them">Two-Spirit (They/Them)</option>

                            <!-- Transgender -->
                            <option value="trans_male_he_him">Transgender Male (He/Him)</option>
                            <option value="trans_female_she_her">Transgender Female (She/Her)</option>

                            <!-- Other / Custom -->
                            <option value="other">Other (please specify)</option>

                            <!-- Prefer not to say -->
                            <option value="prefer_not_say">Prefer not to say</option>
                        </select>
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
            <div class="card-header text-white p-1" style="background-color:#00A6D9;">
                <h6>Present Insurance</h6>
            </div>
            <div class="card-body p-1">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">Subscriber ID</label>
                        <input type="text" class="form-control" id="present_subscriber_id" name="present_subscriber_id" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Group</label>
                        <input type="text" class="form-control" id="present_group" name="present_group" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Payer ID</label>
                        <input type="text" class="form-control" id="present_payer_id" name="present_payer_id" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" id="present_address" name="present_address" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" id="present_phone" name="present_phone" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Fax</label>
                        <input type="text" class="form-control" id="present_fax" name="present_fax" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Effective Date</label>
                        <input type="date" class="form-control" id="present_effective_date" name="present_effective_date" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Termination Date</label>
                        <input type="date" class="form-control" id="present_termination_date" name="present_termination_date" required>
                    </div>

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-white p-1" style="background-color:#00A6D9;">
                <h6>Secondary Insurance</h6>
            </div>
            <div class="card-body p-1">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">Subscriber ID</label>
                        <input type="text" class="form-control" id="secondary_subscriber_id" name="secondary_subscriber_id" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Group</label>
                        <input type="text" class="form-control" id="secondary_group" name="secondary_group" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Payer ID</label>
                        <input type="text" class="form-control" id="secondary_payer_id" name="secondary_payer_id" required>
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
            <div class="card-header text-white p-1" style="background-color:#00A6D9;">
                <h6>Tritary Insurance</h6>
            </div>
            <div class="card-body p-1">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">Subscriber ID</label>
                        <input type="text" class="form-control" id="tritary_subscriber_id" name="tritary_subscriber_id" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Group</label>
                        <input type="text" class="form-control" id="tritary_group" name="tritary_group" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Payer ID</label>
                        <input type="text" class="form-control" id="tritary_payer_id" name="tritary_payer_id" required>
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
            <button type="submit" class="btn  text-white" style="background-color:#00A6D9;">Submit</button>
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