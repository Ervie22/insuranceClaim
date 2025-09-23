@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <form id="createClaimForm" method="POST" action="{{ route('claims.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card mb-1">
            <div class="card-body p-1">
                <div class="row g-3">
                    <div class="form-check col-1">
                        <label class="form-check-label" for="medicare">
                            MEDICARE
                        </label> <br>
                        <input class="form-check-input" style="margin-left:30px;" type="radio" value="MEDICARE" name="insurance_program" id="medicare">
                    </div>
                    <div class="form-check col-1">
                        <label class="form-check-label" for="medicaid">
                            MEDICAID
                        </label> <br>
                        <input class="form-check-input" style="margin-left:30px;" type="radio" value="MEDICAID" name="insurance_program" id="medicaid">
                    </div>
                    <div class="form-check col-1">
                        <label class="form-check-label" for="champus">
                            CHAMPUS
                        </label> <br>
                        <input class="form-check-input" style="margin-left:30px;" type="radio" value="CHAMPUS" name="insurance_program" id="champus">
                    </div>
                    <div class="form-check col-1">
                        <label class="form-check-label" for="champva">
                            CHAMPVA
                        </label> <br>
                        <input class="form-check-input" style="margin-left:30px;" type="radio" value="CHAMPVA" name="insurance_program" id="champva">
                    </div>
                    <div class="form-check col-2">
                        <label class="form-check-label" for="group">
                            GROUP HEALTH PLAN
                        </label> <br>
                        <input class="form-check-input" style="margin-left:50px;" type="radio" value="GROUP HEALTH PLAN" name="insurance_program" id="group">
                    </div>
                    <div class="form-check col-2">
                        <label class="form-check-label" for="feca">
                            FECA BLACK LUNG
                        </label> <br>
                        <input class="form-check-input" style="margin-left:50px;" type="radio" value="FECA BLACK LUNG" name="insurance_program" id="feca">
                    </div>
                    <div class="form-check col-1">
                        <label class="form-check-label" for="other">
                            OTHER
                        </label> <br>
                        <input class="form-check-input" style="margin-left:20px;" type="radio" value="OTHER" name="insurance_program" id="other">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Insured's ID Number</label>
                        <input type="number" class="form-control" id="insureds_id" name="insureds_id" required>
                    </div>

                </div>
            </div>
        </div>
        <div class="card mb-1">
            <div class="card-body p-1">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">Patient</label>
                        <select class="form-control" onchange="getPatientDetails()" name="patient_id" id="patient_id" required>
                            <option value="">Select Patient</option>
                            @foreach($patients as $key=>$val)
                            <option value="{{$val['id']}}">{{$val['first_name']}} {{$val['last_name']}} {{$val['mi']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Patient First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Patient Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Patient MI</label>
                        <input type="text" class="form-control" id="mi" name="mi" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Patient DOB</label>
                        <input type="date" class="form-control" name="dob" id="dob" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Patient Sex at Birth</label>
                        <select class="form-control" name="sex" id="sex" required>
                            <option value="">Select Sex</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Patient SSN</label>
                        <input type="text" class="form-control" id="ssn" name="ssn" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Patient Home Phone</label>
                        <input type="text" class="form-control" id="homephone" name="homephone" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Patient Mobile Phone</label>
                        <input type="text" class="form-control" id="mobilephone" name="mobilephone" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Patient Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Patient Address 1</label>
                        <input type="text" class="form-control" id="address1" name="address1" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Patient Address 2</label>
                        <input type="text" class="form-control" id="address2" name="address2" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Patient City</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Patient State</label>
                        <input type="text" class="form-control" id="state" name="state" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Patient Post Code</label>
                        <input type="text" class="form-control" id="postcode" name="postcode" required>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            Patient Relationship to Insured
                            <div class="form-check col-2">
                                <label class="form-check-label" for="self">
                                    Self
                                </label> <br>
                                <input class="form-check-input" style="margin-left:30px;" value="Self" type="radio" name="relationship_to_insured" id="self">
                            </div>
                            <div class="form-check col-2">

                                <label class="form-check-label" for="spouse">
                                    Spouse
                                </label> <br>
                                <input class="form-check-input" style="margin-left:30px;" value="Spouse" type="radio" name="relationship_to_insured" id="spouse">
                            </div>
                            <div class="form-check col-2">
                                <label class="form-check-label" for="child">
                                    Child
                                </label> <br>
                                <input class="form-check-input" style="margin-left:30px;" value="Child" type="radio" name="relationship_to_insured" id="child">
                            </div>
                            <div class="form-check col-1">
                                <label class="form-check-label" for="others">
                                    Others
                                </label> <br>
                                <input class="form-check-input" style="margin-left:30px;" value="Others" type="radio" name="relationship_to_insured" id="others">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-1">
            <div class="card-body p-1">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">Insured's Name (First,Last,MI)</label>
                        <input type="text" class="form-control" id="insureds_name" name="insureds_name" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Insured's Address </label>
                        <input type="text" class="form-control" id="insureds_address" name="insureds_address" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Insured's Phone </label>
                        <input type="text" class="form-control" id="insureds_phone" name="insureds_phone" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Insured's Group or FECA Number </label>
                        <input type="text" class="form-control" id="insureds_group_feca" name="insureds_group_feca" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Insured's DOB</label>
                        <input type="date" class="form-control" name="insureds_dob" id="insureds_dob" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Insured's Sex</label>
                        <select class="form-control" name="insureds_sex" id="insureds_sex" required>
                            <option value="">Select Sex</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Insured's Employer or School Name</label>
                        <input type="text" class="form-control" id="insureds_employer_name" name="insureds_employer_name" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Insurance Plan or Program Name</label>
                        <input type="text" class="form-control" id="insureds_plan_name" name="insureds_plan_name" required>
                    </div>
                    <div class="col-6">
                        <div class="row p-2">
                            Is there another health benefiet paln?
                            <div class="form-check col-2">
                                <label class="form-check-label" for="yes">
                                    Yes
                                </label> <br>
                                <input class="form-check-input" style="margin-left:10px;" value="yes" type="radio" name="another_plan" id="yes">
                            </div>
                            <div class="form-check col-2">

                                <label class="form-check-label" for="no">
                                    No
                                </label> <br>
                                <input class="form-check-input" style="margin-left:10px;" value="no" type="radio" name="another_plan" id="no">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-1" id="anotherInsuredsDetail" style="display:none;">
            <div class="card-body p-1">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">Other Insured's Name (First,Last,MI)</label>
                        <input type="text" class="form-control" id="other_insureds_name" name="other_insureds_name" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Other Insured's Policy or Group Number </label>
                        <input type="text" class="form-control" id="other_insureds_group_feca" name="other_insureds_group_feca" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Other Insured's DOB</label>
                        <input type="date" class="form-control" name="other_insureds_dob" id="other_insureds_dob" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Other_Insured's Sex</label>
                        <select class="form-control" name="other_insureds_sex" id="other_insureds_sex" required>
                            <option value="">Select Sex</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Other Insured's Employer or School Name</label>
                        <input type="text" class="form-control" id="other_insureds_employer_name" name="other_insureds_employer_name" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Otehr_Insurance Plan or Program Name</label>
                        <input type="text" class="form-control" id="Other_insureds_plan_name" name="Other_" required>
                    </div>

                </div>
            </div>
        </div>


        <div class="col mt-1 text-center">
            <button type="submit" class="btn  text-white" style="background-color:#00A6D9;">Submit</button>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('input[name="another_plan"]').change(function() {
            if ($(this).val() === 'yes') {
                $('#anotherInsuredsDetail').slideDown();
            } else {
                $('#anotherInsuredsDetail').slideUp();
            }
        });
    });

    function getPatientDetails() {
        var patientId = $('#patient_id').val();
        $.ajax({
            url: '/get-patient/' + patientId, // Laravel route
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Example: fill patient fields automatically
                    $('#firstname').val(response.data.first_name);
                    $('#lastname').val(response.data.last_name);
                    $('#mi').val(response.data.mi);
                    $('#dob').val(response.data.dob);
                    $('#sex').val(response.data.sex);
                    $('#ssn').val(response.data.ssn);
                    $('#homephone').val(response.data.homephone);
                    $('#mobilephone').val(response.data.mobilephone);
                    $('#email').val(response.data.email);
                    $('#address1').val(response.data.address1);
                    $('#address2').val(response.data.address2);
                    $('#city').val(response.data.city);
                    $('#state').val(response.data.state);
                    $('#postcode').val(response.data.postcode);
                } else {
                    alert("Patient not found");
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert("Error fetching patient details");
            }
        });
    }
</script>
@endsection