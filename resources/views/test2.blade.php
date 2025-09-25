<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HCFA-1500 Health Insurance Claim Form</title>
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
            --success-color: #2ecc71;
        }

        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.6;
            padding: 20px 0;
        }

        .form-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin: 0 auto;
            max-width: 1000px;
        }

        .form-header {
            border-bottom: 3px solid var(--primary-color);
            padding-bottom: 15px;
            margin-bottom: 25px;
            position: relative;
        }

        .form-title {
            color: var(--primary-color);
            font-weight: 800;
            margin-bottom: 5px;
            text-align: center;
            font-size: 1.8rem;
        }

        .form-subtitle {
            color: #666;
            font-size: 0.9rem;
            text-align: center;
            margin-bottom: 10px;
        }

        .warning-area {
            background-color: #fff3cd;
            border: 1px dashed #ffc107;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
            font-weight: 600;
            color: #856404;
        }

        .section-title {
            background: linear-gradient(to right, var(--secondary-color), #5dade2);
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            margin: 20px 0 15px;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
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
            position: relative;
        }

        .section-number {
            position: absolute;
            top: -12px;
            left: 15px;
            background-color: var(--primary-color);
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            text-align: center;
            line-height: 24px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .btn-primary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            padding: 10px 25px;
            font-weight: 600;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }

        .btn-success {
            background-color: var(--success-color);
            border-color: var(--success-color);
            padding: 10px 25px;
            font-weight: 600;
            border-radius: 5px;
        }

        .form-note {
            font-size: 0.75rem;
            color: #777;
            font-style: italic;
            margin-top: 5px;
        }

        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 10px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
        }

        .checkbox-item input {
            margin-right: 5px;
        }

        .service-row {
            border-bottom: 1px dashed #ddd;
            padding: 10px 0;
            margin-bottom: 10px;
        }

        .service-row:last-child {
            border-bottom: none;
        }

        .add-service-btn {
            background-color: #f8f9fa;
            border: 1px dashed #ccc;
            color: #666;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            margin-top: 10px;
        }

        .add-service-btn:hover {
            background-color: #e9ecef;
        }

        .remove-service-btn {
            color: var(--accent-color);
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0;
            margin-top: 10px;
        }

        .signature-box {
            border: 2px solid #ddd;
            border-radius: 5px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
            background-color: #f9f9f9;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .signature-box:hover {
            border-color: var(--secondary-color);
            background-color: #f0f8ff;
        }

        .signature-preview {
            font-style: italic;
            color: #666;
            margin-top: 10px;
            min-height: 20px;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 15px;
            }

            .form-section {
                padding: 15px;
            }

            .checkbox-group {
                flex-direction: column;
                gap: 10px;
            }
        }

        .tab-content {
            padding: 20px 0;
        }

        .progress {
            height: 8px;
            margin-bottom: 30px;
        }

        .progress-bar {
            background-color: var(--secondary-color);
        }

        .form-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            position: relative;
        }

        .form-step {
            text-align: center;
            flex: 1;
            position: relative;
            z-index: 2;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-weight: bold;
            color: #6c757d;
            border: 3px solid #e9ecef;
        }

        .step-circle.active {
            background-color: var(--secondary-color);
            color: white;
            border-color: var(--secondary-color);
        }

        .step-circle.completed {
            background-color: var(--success-color);
            color: white;
            border-color: var(--success-color);
        }

        .step-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #6c757d;
        }

        .step-circle.active+.step-label,
        .step-circle.completed+.step-label {
            color: var(--primary-color);
        }

        .form-steps::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 3px;
            background-color: #e9ecef;
            z-index: 1;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <div class="warning-area">
                    <i class="fas fa-exclamation-triangle me-2"></i>PLEASE DO NOT STAPLE IN THIS AREA
                </div>
                <h1 class="form-title">HEALTH INSURANCE CLAIM FORM</h1>
                <p class="form-subtitle">Complete and submit this form to file your health insurance claim</p>
            </div>

            <!-- Progress Steps -->
            <div class="form-steps">
                <div class="form-step">
                    <div class="step-circle active">1</div>
                    <div class="step-label">Patient Info</div>
                </div>
                <div class="form-step">
                    <div class="step-circle">2</div>
                    <div class="step-label">Insurance</div>
                </div>
                <div class="form-step">
                    <div class="step-circle">3</div>
                    <div class="step-label">Medical Details</div>
                </div>
                <div class="form-step">
                    <div class="step-circle">4</div>
                    <div class="step-label">Services</div>
                </div>
                <div class="form-step">
                    <div class="step-circle">5</div>
                    <div class="step-label">Review & Submit</div>
                </div>
            </div>

            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 20%;"></div>
            </div>

            <!-- Patient Information Section -->
            <div class="form-section">
                <div class="section-number">1</div>
                <h3 class="section-title"><i class="fas fa-user me-2"></i>Patient Information</h3>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label required">2. Patient's Name (Last Name, First Name, Middle Initial)</label>
                            <input type="text" class="form-control" id="patientName" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label required">3. Patient's Birth Date</label>
                            <input type="date" class="form-control" id="patientBirthDate" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label required">3. Sex</label>
                            <select class="form-select" id="patientSex" required>
                                <option value="">Select</option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="form-label required">5. Patient's Address (No., Street)</label>
                            <input type="text" class="form-control" id="patientAddress" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">8. Patient Status</label>
                            <select class="form-select" id="patientStatus">
                                <option value="">Select Status</option>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                                <option value="other">Other</option>
                                <option value="employed">Employed</option>
                                <option value="full-time">Full-Time Student</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">5. City</label>
                            <input type="text" class="form-control" id="patientCity">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">5. State</label>
                            <input type="text" class="form-control" id="patientState">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">5. ZIP Code</label>
                            <input type="text" class="form-control" id="patientZip">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">5. Telephone (Include Area Code)</label>
                            <input type="tel" class="form-control" id="patientPhone">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">14. Date of Current Illness, Injury, or Pregnancy (LMP)</label>
                            <input type="date" class="form-control" id="currentIllnessDate">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">15. If patient has had same or similar illness, give first date</label>
                            <input type="date" class="form-control" id="similarIllnessDate">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">17. Name of Referring Physician or Other Source</label>
                            <input type="text" class="form-control" id="referringPhysician">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Insurance Information Section -->
            <div class="form-section">
                <div class="section-number">2</div>
                <h3 class="section-title"><i class="fas fa-shield-alt me-2"></i>Insurance Information</h3>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label required">1. Insurance Type</label>
                            <div class="checkbox-group">
                                <div class="checkbox-item">
                                    <input type="radio" id="medicare" name="insuranceType" value="medicare" required>
                                    <label for="medicare">Medicare</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="radio" id="medicaid" name="insuranceType" value="medicaid">
                                    <label for="medicaid">Medicaid</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="radio" id="champus" name="insuranceType" value="champus">
                                    <label for="champus">CHAMPUS</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="radio" id="champva" name="insuranceType" value="champva">
                                    <label for="champva">CHAMPVA</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="radio" id="group" name="insuranceType" value="group">
                                    <label for="group">Group</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="radio" id="feca" name="insuranceType" value="feca">
                                    <label for="feca">FECA</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="radio" id="other" name="insuranceType" value="other">
                                    <label for="other">Other</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label required">1a. Insured's ID Number</label>
                            <input type="text" class="form-control" id="insuredId" required>
                            <div class="form-note">(For program in Item 1)</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label required">4. Insured's Name (Last Name, First Name, Middle Initial)</label>
                            <input type="text" class="form-control" id="insuredName" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label required">6. Patient Relationship to Insured</label>
                            <select class="form-select" id="patientRelationship" required>
                                <option value="">Select</option>
                                <option value="self">Self</option>
                                <option value="spouse">Spouse</option>
                                <option value="child">Child</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">7. Insured's Address (No., Street)</label>
                            <input type="text" class="form-control" id="insuredAddress">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">11. Insured's Policy Group or FECA Number</label>
                            <input type="text" class="form-control" id="policyGroupNumber">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">10. Is Patient's Condition Related To:</label>
                            <div class="checkbox-group">
                                <div class="checkbox-item">
                                    <input type="checkbox" id="conditionEmployment" name="conditionRelated">
                                    <label for="conditionEmployment">a. Employment? (Current or Previous)</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="conditionAuto" name="conditionRelated">
                                    <label for="conditionAuto">b. Auto Accident?</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="conditionOther" name="conditionRelated">
                                    <label for="conditionOther">c. Other Accident?</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Medical Details Section -->
            <div class="form-section">
                <div class="section-number">3</div>
                <h3 class="section-title"><i class="fas fa-stethoscope me-2"></i>Medical Details</h3>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label required">21. Diagnosis or Nature of Illness or Injury</label>
                            <textarea class="form-control" id="diagnosis" rows="3" required placeholder="Describe the diagnosis or nature of illness/injury"></textarea>
                            <div class="form-note">(Relate items 1, 2, 3 or 4 to Item 24E by line)</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">20. Outside Lab?</label>
                            <div class="checkbox-group">
                                <div class="checkbox-item">
                                    <input type="radio" id="labYes" name="outsideLab" value="yes">
                                    <label for="labYes">Yes</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="radio" id="labNo" name="outsideLab" value="no">
                                    <label for="labNo">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">20. Outside Lab Charges</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="labCharges" step="0.01" min="0">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">23. Prior Authorization Number</label>
                            <input type="text" class="form-control" id="priorAuthNumber">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">22. Medicaid Resubmission Code</label>
                            <input type="text" class="form-control" id="medicaidResubmission">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Services Rendered Section -->
            <div class="form-section">
                <div class="section-number">4</div>
                <h3 class="section-title"><i class="fas fa-list-alt me-2"></i>Services Rendered</h3>

                <div id="services-container">
                    <div class="service-row">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">24A. Date(s) of Service</label>
                                    <input type="date" class="form-control service-date">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">24B. Place of Service</label>
                                    <input type="text" class="form-control service-place">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">24C. Procedures, Services, or Supplies</label>
                                    <input type="text" class="form-control service-procedure">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">24D. CPT/HCPCS Modifier</label>
                                    <input type="text" class="form-control service-modifier">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">24E. Diagnosis Code</label>
                                    <input type="text" class="form-control service-diagnosis">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" class="add-service-btn" id="add-service">
                    <i class="fas fa-plus me-2"></i>Add Another Service
                </button>
            </div>

            <!-- Provider Information Section -->
            <div class="form-section">
                <div class="section-number">5</div>
                <h3 class="section-title"><i class="fas fa-user-md me-2"></i>Provider Information & Signature</h3>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label required">25. Federal Tax I.D. Number</label>
                            <input type="text" class="form-control" id="taxId" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">26. Patient's Account No.</label>
                            <input type="text" class="form-control" id="patientAccountNo">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">27. Accept Assignment?</label>
                            <div class="checkbox-group">
                                <div class="checkbox-item">
                                    <input type="radio" id="acceptYes" name="acceptAssignment" value="yes">
                                    <label for="acceptYes">Yes</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="radio" id="acceptNo" name="acceptAssignment" value="no">
                                    <label for="acceptNo">No</label>
                                </div>
                            </div>
                            <div class="form-note">(For govt. claims, see back)</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">12. Patient's or Authorized Person's Signature</label>
                            <div class="signature-box" id="signature-box">
                                <span class="text-muted">Click to add signature</span>
                            </div>
                            <div class="signature-preview" id="signature-preview"></div>
                            <input type="hidden" id="signature-data">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">12. Signature Date</label>
                            <input type="date" class="form-control" id="signatureDate">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label required">31. Physician's or Supplier's Signature Date</label>
                            <input type="date" class="form-control" id="physicianSignatureDate" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label required">33. Physician's, Supplier's Billing Name, Address, ZIP Code & Phone #</label>
                            <textarea class="form-control" id="billingInfo" rows="3" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="certification" required>
                        <label class="form-check-label" for="certification">
                            I certify that the statements on the reverse apply to this bill and are made a part thereof.
                        </label>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-outline-secondary" id="prev-btn" disabled>Previous</button>
                <button type="button" class="btn btn-success" id="submit-btn">Submit Claim</button>
                <button type="button" class="btn btn-primary" id="next-btn">Next</button>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Current step tracking
        let currentStep = 1;
        const totalSteps = 5;

        // Update progress bar and steps
        function updateProgress() {
            // Update progress bar
            const progressPercentage = (currentStep / totalSteps) * 100;
            document.querySelector('.progress-bar').style.width = `${progressPercentage}%`;

            // Update step circles
            document.querySelectorAll('.step-circle').forEach((circle, index) => {
                circle.classList.remove('active', 'completed');
                if (index + 1 === currentStep) {
                    circle.classList.add('active');
                } else if (index + 1 < currentStep) {
                    circle.classList.add('completed');
                }
            });

            // Update button states
            document.getElementById('prev-btn').disabled = currentStep === 1;
            document.getElementById('next-btn').textContent = currentStep === totalSteps ? 'Review' : 'Next';

            if (currentStep === totalSteps) {
                document.getElementById('next-btn').style.display = 'none';
                document.getElementById('submit-btn').style.display = 'block';
            } else {
                document.getElementById('next-btn').style.display = 'block';
                document.getElementById('submit-btn').style.display = 'none';
            }
        }

        // Navigation functions
        document.getElementById('next-btn').addEventListener('click', function() {
            if (currentStep < totalSteps) {
                currentStep++;
                updateProgress();
            }
        });

        document.getElementById('prev-btn').addEventListener('click', function() {
            if (currentStep > 1) {
                currentStep--;
                updateProgress();
            }
        });

        // Add service row
        document.getElementById('add-service').addEventListener('click', function() {
            const servicesContainer = document.getElementById('services-container');
            const newServiceRow = document.createElement('div');
            newServiceRow.className = 'service-row';
            newServiceRow.innerHTML = `
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">24A. Date(s) of Service</label>
                            <input type="date" class="form-control service-date">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">24B. Place of Service</label>
                            <input type="text" class="form-control service-place">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">24C. Procedures, Services, or Supplies</label>
                            <input type="text" class="form-control service-procedure">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">24D. CPT/HCPCS Modifier</label>
                            <input type="text" class="form-control service-modifier">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">24E. Diagnosis Code</label>
                            <input type="text" class="form-control service-diagnosis">
                        </div>
                    </div>
                </div>
                <button type="button" class="remove-service-btn">
                    <i class="fas fa-times"></i>
                </button>
            `;
            servicesContainer.appendChild(newServiceRow);

            // Add event listener to remove button
            newServiceRow.querySelector('.remove-service-btn').addEventListener('click', function() {
                servicesContainer.removeChild(newServiceRow);
            });
        });

        // Signature functionality (simplified for demo)
        document.getElementById('signature-box').addEventListener('click', function() {
            const signature = prompt("Please enter your full name for signature:");
            if (signature) {
                document.getElementById('signature-preview').textContent = `Signed: ${signature}`;
                document.getElementById('signature-data').value = signature;
                this.innerHTML = `<i class="fas fa-check text-success me-2"></i>Signature Added`;
            }
        });

        // Form submission
        document.getElementById('submit-btn').addEventListener('click', function() {
            // Validate required fields
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

            // Check certification
            const certification = document.getElementById('certification');
            if (!certification.checked) {
                certification.classList.add('is-invalid');
                isValid = false;
            } else {
                certification.classList.remove('is-invalid');
            }

            if (isValid) {
                alert('Form submitted successfully! This is a demo - in a real application, data would be sent to a server.');
                // Reset form for demo purposes
                document.querySelector('form').reset();
                document.getElementById('signature-preview').textContent = '';
                document.getElementById('signature-box').innerHTML = '<span class="text-muted">Click to add signature</span>';
                currentStep = 1;
                updateProgress();
            } else {
                alert('Please fill in all required fields and accept the certification.');
            }
        });

        // Real-time validation
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

            // Initialize progress
            updateProgress();
        });
    </script>
</body>

</html>