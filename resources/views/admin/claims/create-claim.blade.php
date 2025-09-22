<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Claim Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-section {
            display: none;
            margin-top: 20px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4>Insurance Claim Form</h4>
            </div>
            <div class="card-body">
                <!-- Select Form Type -->
                <div class="mb-3">
                    <label for="formType" class="form-label">Select Form Type</label>
                    <select id="formType" class="form-select">
                        <option value="">-- Select --</option>
                        <option value="hcfa">HCFA-1500 (Professional)</option>
                        <option value="ub92">UB-92 (Institutional)</option>
                    </select>
                </div>

                <!-- Patient Dropdown -->
                <div class="mb-3">
                    <label for="patientSelect" class="form-label">Select Patient</label>
                    <select id="patientSelect" class="form-select">
                        <option value="">-- Select Patient --</option>
                        @foreach($patients as $patient)
                        <option value="{{ $patient->id }}"
                            data-name="{{ $patient->name }}"
                            data-dob="{{ $patient->dob }}"
                            data-gender="{{ $patient->gender }}"
                            data-address="{{ $patient->address }}">
                            {{ $patient->name }} ({{ $patient->dob }})
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Patient Details Auto Fill -->
                <div id="patientDetails" class="border rounded p-3 bg-light mb-4" style="display:none;">
                    <h6>Patient Details</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" id="patientName" name="patientName" class="form-control" readonly>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">DOB</label>
                            <input type="text" id="patientDOB" name="patientDOB" class="form-control" readonly>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Gender</label>
                            <input type="text" id="patientGender" name="patientGender" class="form-control" readonly>
                        </div>
                        <div class="col-12 mt-2">
                            <label class="form-label">Address</label>
                            <input type="text" id="patientAddress" name="patientAddress" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <!-- HCFA-1500 Section -->
                <div id="hcfaSection" class="form-section">
                    <h5>HCFA-1500 (Professional Claim)</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Insurance ID</label>
                            <input type="text" name="insurance_id" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Provider Name</label>
                            <input type="text" name="provider_name" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Diagnosis Codes</label>
                            <input type="text" name="diagnosis_codes" class="form-control" placeholder="ICD-10 Codes">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Procedure Codes</label>
                            <input type="text" name="procedure_codes" class="form-control" placeholder="CPT/HCPCS">
                        </div>
                    </div>
                </div>

                <!-- UB-92 Section -->
                <div id="ub92Section" class="form-section">
                    <h5>UB-92 (Institutional Claim)</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Provider Name</label>
                            <input type="text" name="provider_name" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Type of Bill</label>
                            <input type="text" name="type_of_bill" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Admission Date</label>
                            <input type="date" name="admission_date" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Discharge Date</label>
                            <input type="date" name="discharge_date" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Diagnosis Codes</label>
                            <input type="text" name="diagnosis_codes" class="form-control" placeholder="ICD-10 Codes">
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-success">Submit Claim</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Form type toggle
        document.getElementById('formType').addEventListener('change', function() {
            document.querySelectorAll('.form-section').forEach(s => s.style.display = 'none');
            if (this.value === 'hcfa') {
                document.getElementById('hcfaSection').style.display = 'block';
            } else if (this.value === 'ub92') {
                document.getElementById('ub92Section').style.display = 'block';
            }
        });

        // Auto fill patient details
        document.getElementById('patientSelect').addEventListener('change', function() {
            let option = this.options[this.selectedIndex];
            if (option.value) {
                document.getElementById('patientDetails').style.display = 'block';
                document.getElementById('patientName').value = option.getAttribute('data-name');
                document.getElementById('patientDOB').value = option.getAttribute('data-dob');
                document.getElementById('patientGender').value = option.getAttribute('data-gender');
                document.getElementById('patientAddress').value = option.getAttribute('data-address');
            } else {
                document.getElementById('patientDetails').style.display = 'none';
            }
        });
    </script>
</body>

</html>