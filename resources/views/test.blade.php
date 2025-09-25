<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UB-92 Medical Claim Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
            --border-color: #dee2e6;
        }

        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.6;
        }

        .form-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin: 30px auto;
            max-width: 1200px;
        }

        .form-header {
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .form-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 5px;
        }

        .form-subtitle {
            color: #666;
            font-size: 0.9rem;
        }

        .section-title {
            background-color: var(--light-bg);
            padding: 10px 15px;
            border-left: 4px solid var(--secondary-color);
            margin: 25px 0 15px;
            font-weight: 600;
            color: var(--primary-color);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 5px;
            color: #555;
        }

        .required::after {
            content: " *";
            color: var(--accent-color);
        }

        .form-control,
        .form-select {
            border-radius: 4px;
            border: 1px solid var(--border-color);
            padding: 8px 12px;
            font-size: 0.9rem;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
            border-color: var(--secondary-color);
        }

        .form-section {
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 20px;
            margin-bottom: 25px;
            background-color: white;
        }

        .btn-primary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            padding: 10px 20px;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }

        .form-note {
            font-size: 0.8rem;
            color: #777;
            font-style: italic;
            margin-top: 5px;
        }

        .certification-box {
            background-color: #f8f9fa;
            border: 1px dashed #ccc;
            border-radius: 5px;
            padding: 15px;
            margin: 15px 0;
        }

        .field-number {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            text-align: center;
            line-height: 24px;
            font-size: 0.8rem;
            margin-right: 8px;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 15px;
                margin: 15px;
            }

            .form-section {
                padding: 15px;
            }
        }

        .tab-content {
            padding: 20px 0;
        }

        .nav-tabs .nav-link {
            color: #555;
            font-weight: 600;
        }

        .nav-tabs .nav-link.active {
            color: var(--secondary-color);
            border-bottom: 3px solid var(--secondary-color);
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="form-container">
            <div class="form-header">
                <h1 class="form-title"><i class="fas fa-file-medical-alt me-2"></i>UB-92 Medical Claim Form</h1>
                <p class="form-subtitle">Uniform Billing Form for Institutional Claims</p>
            </div>

            <!-- Navigation Tabs -->
            <ul class="nav nav-tabs" id="formTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="patient-tab" data-bs-toggle="tab" data-bs-target="#patient" type="button" role="tab">Patient Info</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="insurance-tab" data-bs-toggle="tab" data-bs-target="#insurance" type="button" role="tab">Insurance</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="medical-tab" data-bs-toggle="tab" data-bs-target="#medical" type="button" role="tab">Medical Details</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="billing-tab" data-bs-toggle="tab" data-bs-target="#billing" type="button" role="tab">Billing</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="certification-tab" data-bs-toggle="tab" data-bs-target="#certification" type="button" role="tab">Certifications</button>
                </li>
            </ul>

            <div class="tab-content" id="formTabsContent">
                <!-- Patient Information Tab -->
                <div class="tab-pane fade show active" id="patient" role="tabpanel">
                    <h3 class="section-title"><i class="fas fa-user me-2"></i>Patient Information</h3>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label required"><span class="field-number">3</span> Patient Control Number</label>
                                <input type="text" class="form-control" id="patientControlNo" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">4</span> Type of Bill</label>
                                <select class="form-select" id="billType">
                                    <option value="">Select Type</option>
                                    <option value="111">111 - Hospital Inpatient</option>
                                    <option value="121">121 - Hospital Outpatient</option>
                                    <option value="131">131 - SNF Inpatient</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label required"><span class="field-number">12</span> Patient Name</label>
                                <input type="text" class="form-control" id="patientName" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">13</span> Patient Address</label>
                                <input type="text" class="form-control" id="patientAddress">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label required"><span class="field-number">14</span> Birth Date</label>
                                <input type="date" class="form-control" id="birthDate" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label required"><span class="field-number">15</span> Sex</label>
                                <select class="form-select" id="patientSex" required>
                                    <option value="">Select</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                    <option value="U">Unknown</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">16</span> Marital Status</label>
                                <select class="form-select" id="maritalStatus">
                                    <option value="">Select</option>
                                    <option value="S">Single</option>
                                    <option value="M">Married</option>
                                    <option value="D">Divorced</option>
                                    <option value="W">Widowed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">17</span> Admission Date</label>
                                <input type="date" class="form-control" id="admissionDate">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">19</span> Admission Type</label>
                                <select class="form-select" id="admissionType">
                                    <option value="">Select</option>
                                    <option value="1">Emergency</option>
                                    <option value="2">Urgent</option>
                                    <option value="3">Elective</option>
                                    <option value="4">Newborn</option>
                                    <option value="5">Trauma</option>
                                    <option value="9">Information not available</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">20</span> Admission Source</label>
                                <select class="form-select" id="admissionSource">
                                    <option value="">Select</option>
                                    <option value="1">Physician Referral</option>
                                    <option value="2">Clinic Referral</option>
                                    <option value="3">HMO Referral</option>
                                    <option value="4">Transfer from Hospital</option>
                                    <option value="5">Transfer from SNF</option>
                                    <option value="6">Transfer from Another Facility</option>
                                    <option value="7">Emergency Room</option>
                                    <option value="8">Court/Law Enforcement</option>
                                    <option value="9">Information not available</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">23</span> Medical Record Number</label>
                                <input type="text" class="form-control" id="medicalRecordNo">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-outline-secondary" disabled>Previous</button>
                        <button type="button" class="btn btn-primary" onclick="switchTab('insurance-tab')">Next: Insurance Information</button>
                    </div>
                </div>

                <!-- Insurance Information Tab -->
                <div class="tab-pane fade" id="insurance" role="tabpanel">
                    <h3 class="section-title"><i class="fas fa-shield-alt me-2"></i>Insurance Information</h3>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">58</span> Insured's Name</label>
                                <input type="text" class="form-control" id="insuredName">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">59</span> Patient Relationship to Insured</label>
                                <select class="form-select" id="patientRelationship">
                                    <option value="">Select</option>
                                    <option value="1">Self</option>
                                    <option value="2">Spouse</option>
                                    <option value="3">Child</option>
                                    <option value="4">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">60</span> Insurance ID Number</label>
                                <input type="text" class="form-control" id="insuranceId">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">62</span> Insurance Group Number</label>
                                <input type="text" class="form-control" id="insuranceGroupNo">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">61</span> Group Name</label>
                                <input type="text" class="form-control" id="groupName">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">50</span> Payer Name</label>
                                <select class="form-select" id="payerName">
                                    <option value="">Select Payer</option>
                                    <option value="MEDICARE">Medicare</option>
                                    <option value="MEDICAID">Medicaid</option>
                                    <option value="CHAMPUS">CHAMPUS</option>
                                    <option value="COMMERCIAL">Commercial Insurance</option>
                                    <option value="OTHER">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-outline-secondary" onclick="switchTab('patient-tab')">Previous: Patient Information</button>
                        <button type="button" class="btn btn-primary" onclick="switchTab('medical-tab')">Next: Medical Details</button>
                    </div>
                </div>

                <!-- Medical Details Tab -->
                <div class="tab-pane fade" id="medical" role="tabpanel">
                    <h3 class="section-title"><i class="fas fa-stethoscope me-2"></i>Medical Details</h3>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">67</span> Principal Diagnosis Code</label>
                                <input type="text" class="form-control" id="principalDiagnosis">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">76</span> Admitting Diagnosis Code</label>
                                <input type="text" class="form-control" id="admittingDiagnosis">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><span class="field-number">77</span> Other Diagnosis Codes (E-Codes)</label>
                        <textarea class="form-control" id="otherDiagnosis" rows="3" placeholder="Enter codes separated by commas"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">80</span> Principal Procedure Code</label>
                                <input type="text" class="form-control" id="principalProcedure">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">81</span> Principal Procedure Date</label>
                                <input type="date" class="form-control" id="principalProcedureDate">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><span class="field-number">79</span> Other Procedure Codes</label>
                        <textarea class="form-control" id="otherProcedures" rows="3" placeholder="Enter procedure codes and dates"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">82</span> Attending Physician ID</label>
                                <input type="text" class="form-control" id="attendingPhysician">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">83</span> Other Physician ID</label>
                                <input type="text" class="form-control" id="otherPhysician">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-outline-secondary" onclick="switchTab('insurance-tab')">Previous: Insurance Information</button>
                        <button type="button" class="btn btn-primary" onclick="switchTab('billing-tab')">Next: Billing Information</button>
                    </div>
                </div>

                <!-- Billing Information Tab -->
                <div class="tab-pane fade" id="billing" role="tabpanel">
                    <h3 class="section-title"><i class="fas fa-dollar-sign me-2"></i>Billing Information</h3>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">6</span> Statement Covers Period From</label>
                                <input type="date" class="form-control" id="statementFrom">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">6</span> Statement Covers Period Through</label>
                                <input type="date" class="form-control" id="statementThrough">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">5</span> Federal Tax Number</label>
                                <input type="text" class="form-control" id="fedTaxNo">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">44</span> HCPCS/Rates</label>
                                <input type="text" class="form-control" id="hcpcsRates">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">45</span> Service Date</label>
                                <input type="date" class="form-control" id="serviceDate">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">46</span> Service Units</label>
                                <input type="number" class="form-control" id="serviceUnits" min="1">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">47</span> Total Charges</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" id="totalCharges" step="0.01" min="0">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">48</span> Non-Covered Charges</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" id="nonCoveredCharges" step="0.01" min="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">54</span> Prior Payments</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" id="priorPayments" step="0.01" min="0">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">55</span> Estimated Amount Due</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" id="estimatedAmountDue" step="0.01" min="0">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><span class="field-number">56</span> Due From Patient</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" id="dueFromPatient" step="0.01" min="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-outline-secondary" onclick="switchTab('medical-tab')">Previous: Medical Details</button>
                        <button type="button" class="btn btn-primary" onclick="switchTab('certification-tab')">Next: Certifications</button>
                    </div>
                </div>

                <!-- Certifications Tab -->
                <div class="tab-pane fade" id="certification" role="tabpanel">
                    <h3 class="section-title"><i class="fas fa-certificate me-2"></i>Certifications</h3>

                    <div class="certification-box">
                        <h5><i class="fas fa-exclamation-circle me-2"></i>Important Notice</h5>
                        <p class="small">ANYONE WHO MISREPRESENTS OR FALSIFIES ESSENTIAL INFORMATION REQUESTED BY THIS FORM MAY UPON CONVICTION BE SUBJECT TO FINE AND IMPRISONMENT UNDER FEDERAL AND/OR STATE LAW.</p>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="certification1" required>
                            <label class="form-check-label" for="certification1">
                                I certify that appropriate assignments by the insured/beneficiary and signature of patient or parent or legal guardian covering authorization to release information are on file.
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="certification2" required>
                            <label class="form-check-label" for="certification2">
                                I certify that if patient occupied a private room or required private nursing for medical necessity, any required certifications are on file.
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="certification3" required>
                            <label class="form-check-label" for="certification3">
                                I certify that physician's certifications and re-certifications, if required by contract or Federal regulations, are on file.
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="certification4" required>
                            <label class="form-check-label" for="certification4">
                                I certify that signature of patient or his/her representative on certifications, authorization to release information, and payment request, as required by Federal law and regulations, is on file.
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="certification5" required>
                            <label class="form-check-label" for="certification5">
                                I certify that this claim, to the best of my knowledge, is correct and complete and is in conformance with the Civil Rights Act of 1964 as amended.
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label required"><span class="field-number">85</span> Provider Representative</label>
                        <input type="text" class="form-control" id="providerRepresentative" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label required"><span class="field-number">86</span> Date</label>
                        <input type="date" class="form-control" id="certificationDate" required>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-outline-secondary" onclick="switchTab('billing-tab')">Previous: Billing Information</button>
                        <button type="button" class="btn btn-success" onclick="validateAndSubmit()">Submit Form</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Function to switch between tabs
        function switchTab(tabId) {
            const triggerEl = document.getElementById(tabId);
            const tab = new bootstrap.Tab(triggerEl);
            tab.show();
        }

        // Function to validate and submit the form
        function validateAndSubmit() {
            // Check required fields
            const requiredFields = document.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });

            // Check certification checkboxes
            const certifications = document.querySelectorAll('.form-check-input[required]');
            certifications.forEach(cb => {
                if (!cb.checked) {
                    cb.classList.add('is-invalid');
                    isValid = false;
                } else {
                    cb.classList.remove('is-invalid');
                }
            });

            if (isValid) {
                // In a real application, you would submit the form data to a server here
                alert('Form submitted successfully! This is a demo - in a real application, data would be sent to a server.');

                // Reset form for demo purposes
                document.querySelector('form').reset();
                switchTab('patient-tab');
            } else {
                alert('Please fill in all required fields and accept all certifications.');
            }
        }

        // Add real-time validation for required fields
        document.addEventListener('DOMContentLoaded', function() {
            const requiredFields = document.querySelectorAll('[required]');

            requiredFields.forEach(field => {
                field.addEventListener('blur', function() {
                    if (!this.value) {
                        this.classList.add('is-invalid');
                    } else {
                        this.classList.remove('is-invalid');
                    }
                });
            });

            // Add real-time validation for checkboxes
            const certifications = document.querySelectorAll('.form-check-input[required]');
            certifications.forEach(cb => {
                cb.addEventListener('change', function() {
                    if (!this.checked) {
                        this.classList.add('is-invalid');
                    } else {
                        this.classList.remove('is-invalid');
                    }
                });
            });
        });
    </script>
</body>

</html>