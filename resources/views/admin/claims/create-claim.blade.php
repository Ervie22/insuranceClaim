@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <form id="createClaimForm" method="POST" action="{{ route('claims.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header text-white p-1" style="background-color:#00A6D9;">
                <h6>Patients Info</h6>
            </div>
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
                    <div class="col-md-2">
                        <label class="form-label">Form Type</label>
                        <select class="form-control" onchange="formChange()" name="form_type" id="form_type" required>
                            <option value="">Select Form</option>
                            <option value="1">HCFA1500</option>
                            <option value="2">UB92</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-1" id="hcfaForm" style="display:none;">
            <div class="card-header text-white p-1" style="background-color:#00A6D9;">
                <h6>HBCA1500 Form</h6>
            </div>
            <div class="card-body p-1">

            </div>
        </div>
        <div class="card" id="ubForm" style="display:none;">
            <div class="card-header text-white p-1" style="background-color:#00A6D9;">
                <h6>UB92 Form</h6>
            </div>
            <div class="card-body p-1">

            </div>
        </div>

        <div class="col mt-1 text-center">
            <button type="submit" class="btn  text-white" style="background-color:#00A6D9;">Submit</button>
        </div>
    </form>
</div>
<script>
    function formChange() {
        var formType = $('#form_type').val();
        var patientId = $('#patient_id').val();
        if (patientId === "" || patientId === null) {
            alert('Select Patient First');
            $('#form_type').val(""); // reset the form_type dropdown
        }
        if (patientId != "" || patientId != null) {
            if (formType == 1) {
                $('#hcfaForm').show();
                $('#ubForm').hide();
            }
            if (formType == 2) {
                $('#ubForm').show();
                $('#hcfaForm').hide();
            }
        }

    }

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