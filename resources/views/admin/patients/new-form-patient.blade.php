@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Include Bootstrap & DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
    :root {
        --primary: #2c7fb8;
        --primary-dark: #1d5a8a;
        --secondary: #7fcdbb;
        --light: #f5f9fc;
        --dark: #2c3e50;
        --gray: #95a5a6;
        --success: #2ecc71;
        --warning: #f39c12;
        --error: #e74c3c;
        --border-radius: 8px;
        --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s ease;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background-color: #f0f5fa;
        color: var(--dark);
        line-height: 1.6;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    header {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        padding: 20px 0;
        border-radius: var(--border-radius);
        margin-bottom: 30px;
        box-shadow: var(--box-shadow);
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .logo i {
        font-size: 2.5rem;
    }

    .logo h1 {
        font-size: 1.8rem;
        font-weight: 600;
    }

    .progress-container {
        background-color: white;
        border-radius: var(--border-radius);
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: var(--box-shadow);
    }

    .progress-steps {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin-bottom: 20px;
    }

    .progress-steps::before {
        content: '';
        position: absolute;
        top: 15px;
        left: 0;
        width: 100%;
        height: 4px;
        background-color: #e0e0e0;
        z-index: 1;
    }

    .progress-bar {
        position: absolute;
        top: 15px;
        left: 0;
        height: 4px;
        background-color: var(--primary);
        z-index: 2;
        transition: var(--transition);
    }

    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        z-index: 3;
    }

    .step-circle {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background-color: #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gray);
        font-weight: bold;
        margin-bottom: 8px;
        transition: var(--transition);
    }

    .step.active .step-circle {
        background-color: var(--primary);
        color: white;
    }

    .step.completed .step-circle {
        background-color: var(--success);
        color: white;
    }

    .step-label {
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--gray);
    }

    .step.active .step-label {
        color: var(--primary);
    }

    .form-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }

    .form-section {
        background-color: white;
        border-radius: var(--border-radius);
        padding: 25px;
        box-shadow: var(--box-shadow);
    }

    .form-section.full-width {
        grid-column: 1 / -1;
    }

    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eaeaea;
    }

    .section-header i {
        font-size: 1.5rem;
        color: var(--primary);
        margin-right: 10px;
    }

    .section-header h2 {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--dark);
    }

    .form-row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 20px;
    }

    /* 
    .form-group {
        flex: 1;
        min-width: 200px;
    }

    .form-group.full-width {
        flex: 1 0 100%;
    } */

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--dark);
    }

    .required::after {
        content: ' *';
        color: var(--error);
    }

    .input-with-icon {
        position: relative;
    }

    .input-with-icon i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray);
    }

    input,
    select {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: var(--border-radius);
        font-size: 1rem;
        transition: var(--transition);
    }

    .input-with-icon input {
        padding-left: 40px;
    }

    input:focus,
    select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(44, 127, 184, 0.2);
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        margin-top: 15px;
    }

    .checkbox-group input {
        width: auto;
        margin-right: 10px;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #eaeaea;
    }

    .btn {
        padding: 12px 25px;
        border: none;
        border-radius: var(--border-radius);
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
    }

    .btn-primary {
        background-color: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
    }

    .btn-secondary {
        background-color: #e0e0e0;
        color: var(--dark);
    }

    .btn-secondary:hover {
        background-color: #d0d0d0;
    }

    .btn-outline {
        background-color: transparent;
        border: 1px solid var(--primary);
        color: var(--primary);
    }

    .btn-outline:hover {
        background-color: rgba(44, 127, 184, 0.1);
    }

    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: var(--border-radius);
        background-color: var(--success);
        color: white;
        box-shadow: var(--box-shadow);
        transform: translateX(150%);
        transition: transform 0.4s ease;
        z-index: 1000;
    }

    .notification.show {
        transform: translateX(0);
    }

    @media (max-width: 768px) {
        .form-container {
            grid-template-columns: 1fr;
        }

        .form-section.full-width {
            grid-column: 1;
        }

        .header-content {
            flex-direction: column;
            text-align: center;
            gap: 15px;
        }

        .progress-steps {
            flex-wrap: wrap;
            gap: 15px;
        }

        .progress-steps::before {
            display: none;
        }

        .progress-bar {
            display: none;
        }
    }
</style>
<style>
    .form-group {
        display: flex;
        align-items: center;
        /* vertically center label and input */
        gap: 10px;
        /* spacing between label and input */
    }

    .form-group label {
        min-width: 120px;
        /* keeps label aligned */
        margin: 0;
        /* remove default margin */
    }

    .input-with-icon {
        display: flex;
        align-items: center;
        border: 1px solid #ccc;
        padding: 0px;
        border-radius: 5px;
        /* height: 28px; */
    }

    .input-with-icon i {
        margin-right: 8px;
        color: #666;
    }

    .input-with-icon input {
        border: none;
        outline: none;
        flex: 1;
        height: 40px;
    }

    input {
        height: 40px;
    }
</style>


<div class="container-fluid">

    <form method="POST" action="{{ route('patients.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-container">
            <!-- Patient Information Section -->
            <div class="form-section">
                <div class="section-header">
                    <i class="fas fa-user"></i>
                    <h2>Patient Information</h2>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="firstname" class="required">First Name</label>
                        <div class="input-with-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" id="firstname" name="firstname" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="required">Last Name</label>
                        <div class="input-with-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" id="lastname" name="lastname" required>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="mi">Middle Initial</label>
                        <input type="text" id="mi" name="mi" maxlength="1" required>
                    </div>
                    <div class="form-group">
                        <label for="dob" class="required">Date of Birth</label>
                        <div class="input-with-icon">
                            <i class="fas fa-calendar"></i>
                            <input type="date" id="dob" name="dob" required>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="sex" class="required">Sex at Birth</label>
                        <select id="sex" name="sex" required>
                            <option value="">Select Sex</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ssn" class="required">SSN</label>
                        <div class="input-with-icon">
                            <i class="fas fa-id-card"></i>
                            <input type="text" id="ssn" name="ssn" placeholder="XXX-XX-XXXX" maxlength="11" pattern="^(?!000|666|9\d{2})\d{3}-(?!00)\d{2}-(?!0000)\d{4}$" required>
                        </div>
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="homephone">Home Phone</label>
                        <div class="input-with-icon">
                            <i class="fas fa-phone"></i>
                            <input type="tel" id="homephone" name="homephone" placeholder="(123) 456-7890" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobilephone" class="required">Mobile Phone</label>
                        <div class="input-with-icon">
                            <i class="fas fa-mobile-alt"></i>
                            <input type="tel" id="mobilephone" name="mobilephone" placeholder="(123) 456-7890" required>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="email">Email</label>
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="form-group full-width">
                        <label for="address1" class="required">Address 1</label>
                        <div class="input-with-icon">
                            <i class="fas fa-home"></i>
                            <input type="text" id="address1" name="address1" onkeyup="getAddress(this.value)" required>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="address2">Address 2</label>
                        <input type="text" id="address2" name="address2" required>
                    </div>
                    <div class="form-group">
                        <label for="city" class="required">City</label>
                        <input type="text" id="city" name="city" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="state" class="required">State</label>
                        <select id="state" name="state" required>
                            <option value="">Select State</option>
                            <!-- States would be populated here -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="postcode" class="required">Post Code</label>
                        <input type="text" id="postcode" name="postcode" required>
                    </div>
                </div>
            </div>

            <!-- Guarantor Information Section -->
            <div class="form-section">
                <div class="section-header">
                    <i class="fas fa-user-shield"></i>
                    <h2>Guarantor Information</h2>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" id="sameAsPatient">
                    <label for="sameAsPatient">Same as patient information</label>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="guarantors_firstname" class="required">First Name</label>
                        <input type="text" id="guarantors_firstname" name="guarantors_firstname" required>
                    </div>
                    <div class="form-group">
                        <label for="guarantors_lastname" class="required">Last Name</label>
                        <input type="text" id="guarantors_lastname" name="guarantors_lastname" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="guarantors_mi">Middle Initial</label>
                        <input type="text" id="guarantors_mi" name="guarantors_mi" maxlength="1">
                    </div>
                    <div class="form-group">
                        <label for="guarantors_dob" class="required">Date of Birth</label>
                        <input type="date" id="guarantors_dob" name="guarantors_dob" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="guarantors_relationship" class="required">Relationship With Patient</label>
                        <select id="guarantors_relationship" name="guarantors_relationship" required>
                            <option value="">Select Relationship</option>
                            <option value="self">Self</option>
                            <option value="spouse">Spouse</option>
                            <option value="parent">Parent</option>
                            <option value="child">Child</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="guarantors_status" class="required">Status</label>
                        <select id="guarantors_status" name="guarantors_status" required>
                            <option value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="guarantors_homephone">Home Phone</label>
                        <div class="input-with-icon">
                            <i class="fas fa-phone"></i>
                            <input type="tel" id="guarantors_homephone" name="guarantors_homephone" placeholder="(123) 456-7890" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="guarantors_mobilephone" class="required">Mobile Phone</label>
                        <div class="input-with-icon">
                            <i class="fas fa-mobile-alt"></i>
                            <input type="tel" id="guarantors_mobilephone" name="guarantors_mobilephone" placeholder="(123) 456-7890" required>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="guarantors_email">Email</label>
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="guarantors_email" name="guarantors_email" required>
                        </div>
                    </div>
                    <div class="form-group full-width">
                        <label for="guarantors_address1" class="required">Address 1</label>
                        <div class="input-with-icon">
                            <i class="fas fa-home"></i>
                            <input type="text" id="guarantors_address1" name="guarantors_address1" onkeyup="getAddress(this.value)" required>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="guarantors_address2">Address 2</label>
                        <input type="text" id="guarantors_address2" name="guarantors_address2" required>
                    </div>
                    <div class="form-group">
                        <label for="guarantors_city" class="required">City</label>
                        <input type="text" id="guarantors_city" name="guarantors_city" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="guarantors_state" class="required">State</label>
                        <select id="guarantors_state" name="guarantors_state" required>
                            <option value="">Select State</option>
                            <!-- States would be populated here -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="guarantors_postcode" class="required">Post Code</label>
                        <input type="text" id="guarantors_postcode" name="guarantors_postcode" required>
                    </div>
                </div>
            </div>
            <!-- Employer & Emergency Contacts Section -->
            <div class="form-section ">
                <div class="section-header">
                    <i class="fas fa-briefcase"></i>
                    <h2>Employer & Emergency Contacts</h2>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="employer_name">Employer Name</label>
                        <input type="text" id="employer_name" name="employer_name" required>
                    </div>
                    <div class="form-group">
                        <label for="department">Department</label>
                        <input type="text" id="department" name="department" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="employer_phone">Work Phone</label>
                        <input type="tel" id="employer_phone" name="employer_phone" required>
                    </div>
                    <div class="form-group">
                        <label for="employer_email">Work Email</label>
                        <input type="email" id="employer_email" name="employer_email" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="employer_address1">Employer Address 1</label>
                        <input type="text" id="employer_address1" name="employer_address1" required>
                    </div>
                    <div class="form-group full-width">
                        <label for="employer_address2">Employer Address 2</label>
                        <input type="text" id="employer_address2" name="employer_address2" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="employer_city">City</label>
                        <input type="text" id="employer_city" name="employer_city" required>
                    </div>
                    <div class="form-group">
                        <label for="employer_state">State</label>
                        <select id="employer_state" name="employer_state" required>
                            <option value="">Select State</option>
                            <!-- States would be populated here -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="employer_postcode">Post Code</label>
                        <input type="text" id="employer_postcode" name="employer_postcode" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="emergency_contact" class="required">Emergency Contact</label>
                        <input type="text" id="emergency_contact" name="emergency_contact" required>
                    </div>
                    <div class="form-group">
                        <label for="emergency_relationship" class="required">Relationship</label>
                        <select id="emergency_relationship" name="emergency_relationship" required>
                            <option value="">Select Relationship</option>
                            <option value="spouse">Spouse</option>
                            <option value="parent">Parent</option>
                            <option value="child">Child</option>
                            <option value="friend">Friend</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kin_phone" class="required">Emergency Phone</label>
                        <input type="tel" id="kin_phone" name="kin_phone" required>
                    </div>
                    <div class="form-group">
                        <label for="kin_address" class="required">Emergency Address</label>
                        <input type="text" id="kin_address" name="kin_address" required>
                    </div>
                </div>
                <div class="form-row" style="width:100%">
                    <div class="form-group" style="width:100%">
                        <label for="patient_notes" class="required">Patient Notes</label>
                        <textarea id="patient_notes" name="patient_notes" required style="width:100%"></textarea>
                    </div>
                </div>
            </div>
            <!-- Consent On File Section -->
            <div class="form-section ">
                <div class="section-header">
                    <i class="fas fa-file"></i>
                    <h2>Consent On File</h2>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="pcp_name">PCP Name</label>
                        <input type="text" id="pcp_name" name="pcp_name" required>
                    </div>
                    <div class="form-group">
                        <label for="pcp_phone">PCP Phone</label>
                        <input type="text" id="pcp_phone" name="pcp_phone" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="npi">NPI</label>
                        <input type="tel" id="npi" name="npi" required>
                    </div>
                    <div class="form-group">
                        <label for="abn">ABN Signature on file</label>
                        <div class="d-flex gap-3"> <!-- flex container for same line -->
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="abn" id="abn_yes" value="yes" required>
                                <label class="form-check-label" for="abn_yes">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="abn" id="abn_no" value="no">
                                <label class="form-check-label" for="abn_no">No</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="abn">Privacy Notice</label>
                        <div class="d-flex gap-3"> <!-- flex container for same line -->
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="privacy_notice" id="privacy_notice_yes" value="yes" required>
                                <label class="form-check-label" for="privacy_notice_yes">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="privacy_notice" id="privacy_notice_no" value="no">
                                <label class="form-check-label" for="privacy_notice_no">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="abn">ROI Signature on file</label>
                        <div class="d-flex gap-3"> <!-- flex container for same line -->
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="roi" id="roi_yes" value="yes" required>
                                <label class="form-check-label" for="roi_yes">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="roi" id="roi_no" value="no">
                                <label class="form-check-label" for="roi_no">No</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="language" class="required">Language</label>
                        <select id="language" name="language" required>
                            <option value="">-- Select Language --</option>
                            <option value="Prefer not to say">Prefer not to say</option>
                            <option value="English">English</option>
                            <option value="Spanish">Spanish</option>
                            <option value="Chinese (Mandarin, Cantonese)">Chinese (Mandarin, Cantonese)</option>
                            <option value="Tagalog">Tagalog</option>
                            <option value="Vietnamese">Vietnamese</option>
                            <option value="Arabic">Arabic</option>
                            <option value="French">French</option>
                            <option value="Korean">Korean</option>
                            <option value="Russian">Russian</option>
                            <option value="Portuguese">Portuguese</option>
                            <option value="Haitian Creole">Haitian Creole</option>
                            <option value="Other (specify)">Other (specify)</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="race" class="required">race</label>
                        <select id="race" name="race" required>
                            <option value="">Select Race</option>
                            <option value="Prefer not to say">Prefer not to say</option>
                            <option value="White">White</option>
                            <option value="Black or African American">Black or African American</option>
                            <option value="American Indian or Alaska Native">American Indian or Alaska Native</option>
                            <optgroup label="Asian">
                                <option value="Asian Indian">Asian Indian</option>
                                <option value="Chinese">Chinese</option>
                                <option value="Filipino">Filipino</option>
                                <option value="Japanese">Japanese</option>
                                <option value="Korean">Korean</option>
                                <option value="Vietnamese">Vietnamese</option>
                                <option value="Other Asian">Other Asian</option>
                            </optgroup>
                            <optgroup label="Native Hawaiian or Other Pacific Islander">
                                <option value="Native Hawaiian">Native Hawaiian</option>
                                <option value="Guamanian or Chamorro">Guamanian or Chamorro</option>
                                <option value="Samoan">Samoan</option>
                                <option value="Other Pacific Islander">Other Pacific Islander</option>
                            </optgroup>
                            <option value="Some other race">Some other race</option>
                            <option value="Two or more races">Two or more races</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ethnicity" class="required">Ethnicity</label>
                        <select id="ethnicity" name="ethnicity" required>
                            <option value="">-- Select Ethnicity --</option>
                            <option value="Prefer not to say">Prefer not to say</option>
                            <optgroup label="White">
                                <option value="English / Welsh / Scottish / Northern Irish / British">English / Welsh / Scottish / Northern Irish / British</option>
                                <option value="Irish">Irish</option>
                                <option value="Gypsy or Irish Traveller">Gypsy or Irish Traveller</option>
                                <option value="Any other White background">Any other White background</option>
                            </optgroup>
                            <optgroup label="Mixed / Multiple ethnic groups">
                                <option value="White and Black Caribbean">White and Black Caribbean</option>
                                <option value="White and Black African">White and Black African</option>
                                <option value="White and Asian">White and Asian</option>
                                <option value="Any other Mixed / Multiple ethnic background">Any other Mixed / Multiple ethnic background</option>
                            </optgroup>
                            <optgroup label="Asian / Asian British">
                                <option value="Indian">Indian</option>
                                <option value="Pakistani">Pakistani</option>
                                <option value="Bangladeshi">Bangladeshi</option>
                                <option value="Chinese">Chinese</option>
                                <option value="Any other Asian background">Any other Asian background</option>
                            </optgroup>
                            <optgroup label="Black / African / Caribbean / Black British">
                                <option value="African">African</option>
                                <option value="Caribbean">Caribbean</option>
                                <option value="Any other Black / African / Caribbean background">Any other Black / African / Caribbean background</option>
                            </optgroup>
                            <optgroup label="Other ethnic group">
                                <option value="Arab">Arab</option>
                                <option value="Any other ethnic group">Any other ethnic group</option>
                            </optgroup>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Marital_status" class="required">Marital Status</label>
                        <select id="marital_status" name="marital_status" required>
                            <option value="">-- Select Marital Status --</option>
                            <option value="Prefer not to say">Prefer not to say</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed">Widowed</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="gender" class="required">Gender Identity & Pronouns</label>
                        <select id="gender" name="gender" required>
                            <option value="">-- Select Gender Identity & Pronouns --</option>
                            <option value="Prefer not to say">Prefer not to say</option>
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
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="method_of_contact" class="required">Preferred Method of Contact</label>
                        <select id="method_of_contact" name="method_of_contact" required>
                            <option value="">Select Method</option>
                            <option value="Call">Call</option>
                            <option value="Text">Text</option>
                            <option value="Email">Email</option>
                        </select>
                    </div>

                </div>

            </div>
            <!--  Information Section -->
            <div class="form-section full-width">
                <div class="row">
                    <div class="col-4">
                        <div class="section-header">
                            <i class="fas fa-shield"></i>
                            <h2>Primary Insurance</h2>
                        </div>
                        <div class="form-group">
                            <label for="present_subscriber_id" class="required">Subscriber_id</label>
                            <div class="input-with-icon">
                                <input type="text" id="present_subscriber_id" name="present_subscriber_id" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="present_group" class="required">Group</label>
                            <div class="input-with-icon">
                                <input type="text" id="present_group" name="present_group" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="present_payer_id" class="required">Payer ID</label>
                            <div class="input-with-icon">
                                <input type="text" id="present_payer_id" name="present_payer_id" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="present_address" class="required">Address</label>
                            <div class="input-with-icon">
                                <input type="text" id="present_address" name="present_address" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="present_phone" class="required">Phone</label>
                            <div class="input-with-icon">
                                <input type="text" id="present_phone" name="present_phone" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="present_fax" class="required">Fax</label>
                            <div class="input-with-icon">
                                <input type="text" id="present_fax" name="present_fax" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="present_effective_date" class="required">Effective Date</label>
                            <div class="input-with-icon">
                                <input type="date" id="present_effective_date" name="present_effective_date" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="present_termination_date" class="required">Termination Date</label>
                            <div class="input-with-icon">
                                <input type="date" id="present_termination_date" name="present_termination_date" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="section-header">
                            <i class="fas fa-shield-halved"></i>
                            <h2>Secondary Insurance</h2>
                        </div>
                        <div class="form-group">
                            <label for="secondary_subscriber_id">Subscriber_id</label>
                            <div class="input-with-icon">
                                <input type="text" id="secondary_subscriber_id" name="secondary_subscriber_id">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="secondary_group">Group</label>
                            <div class="input-with-icon">
                                <input type="text" id="secondary_group" name="secondary_group">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="secondary_payer_id">Payer ID</label>
                            <div class="input-with-icon">
                                <input type="text" id="secondary_payer_id" name="secondary_payer_id">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="secondary_address">Address</label>
                            <div class="input-with-icon">
                                <input type="text" id="secondary_address" name="secondary_address">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="secondary_phone">Phone</label>
                            <div class="input-with-icon">
                                <input type="text" id="secondary_phone" name="secondary_phone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="secondary_fax">Fax</label>
                            <div class="input-with-icon">
                                <input type="text" id="secondary_fax" name="secondary_fax">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="secondary_effective_date">Effective Date</label>
                            <div class="input-with-icon">
                                <input type="date" id="secondary_effective_date" name="secondary_effective_date">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="secondary_termination_date">Termination Date</label>
                            <div class="input-with-icon">
                                <input type="date" id="secondary_termination_date" name="secondary_termination_date">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="section-header">
                            <i class="fas fa-shield-virus"></i>
                            <h2>Tritary Insurance</h2>
                        </div>
                        <div class="form-group">
                            <label for="tritary_subscriber_id">Subscriber_id</label>
                            <div class="input-with-icon">
                                <input type="text" id="tritary_subscriber_id" name="tritary_subscriber_id">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tritary_group">Group</label>
                            <div class="input-with-icon">
                                <input type="text" id="tritary_group" name="tritary_group">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tritary_payer_id">Payer ID</label>
                            <div class="input-with-icon">
                                <input type="text" id="tritary_payer_id" name="tritary_payer_id">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tritary_address">Address</label>
                            <div class="input-with-icon">
                                <input type="text" id="tritary_address" name="tritary_address">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tritary_phone">Phone</label>
                            <div class="input-with-icon">
                                <input type="text" id="tritary_phone" name="tritary_phone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tritary_fax">Fax</label>
                            <div class="input-with-icon">
                                <input type="text" id="tritary_fax" name="tritary_fax">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tritary_effective_date">Effective Date</label>
                            <div class="input-with-icon">
                                <input type="date" id="tritary_effective_date" name="tritary_effective_date">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tritary_termination_date">Termination Date</label>
                            <div class="input-with-icon">
                                <input type="date" id="tritary_termination_date" name="tritary_termination_date">
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>

        <div class="form-actions">
            <!-- <button type="button" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </button> -->
            <div>
                <!-- <button type="button" class="btn btn-outline">
                    Save as Draft
                </button> -->
                <button type="submit" class="btn btn-primary">
                    submit <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- npi validation -->
<script>
    $(document).ready(function() {
        $("#npi").on("keyup", function() {
            let raw = $(this).val().replace(/\D/g, ""); // digits only

            // Limit to 10 digits
            if (raw.length > 10) {
                raw = raw.substring(0, 10);
            }

            // Optional formatting: 1234 567 890
            let formatted = raw;
            if (raw.length > 4 && raw.length <= 7) {
                formatted = raw.substring(0, 4) + " " + raw.substring(4);
            } else if (raw.length > 7) {
                formatted = raw.substring(0, 4) + " " + raw.substring(4, 7) + " " + raw.substring(7);
            }

            $(this).val(formatted);

            // Live validation
            // if (raw.length === 10) {
            //     $("#npi-error").hide();
            //     $(this).css("border", "2px solid green");
            // } else {
            //     $("#npi-error").show();
            //     $(this).css("border", "2px solid red");
            // }
        });


    });
</script>
<!-- home phone validation starts -->
<script>
    $(document).ready(function() {
        $("#homephone").on("keyup", function() {
            let raw = $(this).val().replace(/\D/g, ""); // get digits only

            // Limit to 10 digits
            if (raw.length > 10) {
                raw = raw.substring(0, 10);
            }

            // Auto-format as (123) 456-7890
            let formatted = raw;
            if (raw.length > 6) {
                formatted = "(" + raw.substring(0, 3) + ") " + raw.substring(3, 6) + "-" + raw.substring(6);
            } else if (raw.length > 3) {
                formatted = "(" + raw.substring(0, 3) + ") " + raw.substring(3);
            }

            $(this).val(formatted);
        });


    });
</script>
<!-- home phone validation ends -->
<!-- guarantorshome phone validation starts -->
<script>
    $(document).ready(function() {
        $("#guarantors_homephone").on("keyup", function() {
            let raw = $(this).val().replace(/\D/g, ""); // get digits only

            // Limit to 10 digits
            if (raw.length > 10) {
                raw = raw.substring(0, 10);
            }

            // Auto-format as (123) 456-7890
            let formatted = raw;
            if (raw.length > 6) {
                formatted = "(" + raw.substring(0, 3) + ") " + raw.substring(3, 6) + "-" + raw.substring(6);
            } else if (raw.length > 3) {
                formatted = "(" + raw.substring(0, 3) + ") " + raw.substring(3);
            }

            $(this).val(formatted);
        });


    });
</script>
<!-- guarantors home phone validation ends -->
<!-- mobile phone validation starts -->
<script>
    $(document).ready(function() {
        $("#mobilephone").on("keyup", function() {
            let raw = $(this).val().replace(/\D/g, ""); // get digits only

            // Limit to 10 digits
            if (raw.length > 10) {
                raw = raw.substring(0, 10);
            }

            // Auto-format as (123) 456-7890
            let formatted = raw;
            if (raw.length > 6) {
                formatted = "(" + raw.substring(0, 3) + ") " + raw.substring(3, 6) + "-" + raw.substring(6);
            } else if (raw.length > 3) {
                formatted = "(" + raw.substring(0, 3) + ") " + raw.substring(3);
            }

            $(this).val(formatted);
        });


    });
</script>
<!-- mobile phone validation ends -->
<!-- guarantors mobile phone validation starts -->
<script>
    $(document).ready(function() {
        $("#guarantors_mobilephone").on("keyup", function() {
            let raw = $(this).val().replace(/\D/g, ""); // get digits only

            // Limit to 10 digits
            if (raw.length > 10) {
                raw = raw.substring(0, 10);
            }

            // Auto-format as (123) 456-7890
            let formatted = raw;
            if (raw.length > 6) {
                formatted = "(" + raw.substring(0, 3) + ") " + raw.substring(3, 6) + "-" + raw.substring(6);
            } else if (raw.length > 3) {
                formatted = "(" + raw.substring(0, 3) + ") " + raw.substring(3);
            }

            $(this).val(formatted);
        });


    });
</script>
<!-- guarantors mobile phone validation ends -->
<!-- employer mobile phone validation starts -->
<script>
    $(document).ready(function() {
        $("#employer_phone").on("keyup", function() {
            let raw = $(this).val().replace(/\D/g, ""); // get digits only

            // Limit to 10 digits
            if (raw.length > 10) {
                raw = raw.substring(0, 10);
            }

            // Auto-format as (123) 456-7890
            let formatted = raw;
            if (raw.length > 6) {
                formatted = "(" + raw.substring(0, 3) + ") " + raw.substring(3, 6) + "-" + raw.substring(6);
            } else if (raw.length > 3) {
                formatted = "(" + raw.substring(0, 3) + ") " + raw.substring(3);
            }

            $(this).val(formatted);
        });


    });
</script>
<!-- employer mobile phone validation ends -->
<!-- emergency mobile phone validation starts -->
<script>
    $(document).ready(function() {
        $("#kin_phone").on("keyup", function() {
            let raw = $(this).val().replace(/\D/g, ""); // get digits only

            // Limit to 10 digits
            if (raw.length > 10) {
                raw = raw.substring(0, 10);
            }

            // Auto-format as (123) 456-7890
            let formatted = raw;
            if (raw.length > 6) {
                formatted = "(" + raw.substring(0, 3) + ") " + raw.substring(3, 6) + "-" + raw.substring(6);
            } else if (raw.length > 3) {
                formatted = "(" + raw.substring(0, 3) + ") " + raw.substring(3);
            }

            $(this).val(formatted);
        });


    });
</script>
<!-- emergency mobile phone validation ends -->
<!-- pcp mobile phone validation starts -->
<script>
    $(document).ready(function() {
        $("#pcp_phone").on("keyup", function() {
            let raw = $(this).val().replace(/\D/g, ""); // get digits only

            // Limit to 10 digits
            if (raw.length > 10) {
                raw = raw.substring(0, 10);
            }

            // Auto-format as (123) 456-7890
            let formatted = raw;
            if (raw.length > 6) {
                formatted = "(" + raw.substring(0, 3) + ") " + raw.substring(3, 6) + "-" + raw.substring(6);
            } else if (raw.length > 3) {
                formatted = "(" + raw.substring(0, 3) + ") " + raw.substring(3);
            }

            $(this).val(formatted);
        });


    });
</script>
<!-- pcp mobile phone validation ends -->
<!-- present mobile phone validation starts -->
<script>
    $(document).ready(function() {
        $("#present_phone").on("keyup", function() {
            let raw = $(this).val().replace(/\D/g, ""); // get digits only

            // Limit to 10 digits
            if (raw.length > 10) {
                raw = raw.substring(0, 10);
            }

            // Auto-format as (123) 456-7890
            let formatted = raw;
            if (raw.length > 6) {
                formatted = "(" + raw.substring(0, 3) + ") " + raw.substring(3, 6) + "-" + raw.substring(6);
            } else if (raw.length > 3) {
                formatted = "(" + raw.substring(0, 3) + ") " + raw.substring(3);
            }

            $(this).val(formatted);
        });


    });
</script>
<!-- present mobile phone validation ends -->
<!-- secondary mobile phone validation starts -->
<script>
    $(document).ready(function() {
        $("#secondary_phone").on("keyup", function() {
            let raw = $(this).val().replace(/\D/g, ""); // get digits only

            // Limit to 10 digits
            if (raw.length > 10) {
                raw = raw.substring(0, 10);
            }

            // Auto-format as (123) 456-7890
            let formatted = raw;
            if (raw.length > 6) {
                formatted = "(" + raw.substring(0, 3) + ") " + raw.substring(3, 6) + "-" + raw.substring(6);
            } else if (raw.length > 3) {
                formatted = "(" + raw.substring(0, 3) + ") " + raw.substring(3);
            }

            $(this).val(formatted);
        });


    });
</script>
<!-- secondary mobile phone validation ends -->
<!-- tritary mobile phone validation starts -->
<script>
    $(document).ready(function() {
        $("#tritary_phone").on("keyup", function() {
            let raw = $(this).val().replace(/\D/g, ""); // get digits only

            // Limit to 10 digits
            if (raw.length > 10) {
                raw = raw.substring(0, 10);
            }

            // Auto-format as (123) 456-7890
            let formatted = raw;
            if (raw.length > 6) {
                formatted = "(" + raw.substring(0, 3) + ") " + raw.substring(3, 6) + "-" + raw.substring(6);
            } else if (raw.length > 3) {
                formatted = "(" + raw.substring(0, 3) + ") " + raw.substring(3);
            }

            $(this).val(formatted);
        });


    });
</script>
<!-- tritary mobile phone validation ends -->
<!-- address auotcomplete starts -->
<script>
    function getAddress(value) {
        // if (value.length > 3) {
        //     $.ajax({
        //         url: "{{ route('address.autocomplete') }}", // Laravel route
        //         type: "POST",
        //         data: {
        //             _token: "{{ csrf_token() }}", // CSRF token
        //             query: value
        //         },
        //         success: function(response) {
        //             console.log("Response:", response);
        //         },
        //         error: function(xhr) {
        //             console.error("Error:", xhr.responseText);
        //         }
        //     });
        // }
    }
</script>
<!-- address auotcomplete ends -->
<!-- ssn validation starts -->
<script>
    $(document).ready(function() {
        $("#ssn").on("keyup", function() {
            let val = $(this).val().replace(/\D/g, ""); // remove non-digits
            let newVal = "";

            if (val.length > 3 && val.length <= 5) {
                newVal = val.slice(0, 3) + "-" + val.slice(3);
            } else if (val.length > 5) {
                newVal = val.slice(0, 3) + "-" + val.slice(3, 5) + "-" + val.slice(5, 9);
            } else {
                newVal = val;
            }

            $(this).val(newVal);

            // stop at 9 digits (11 chars with dashes)
            if (val.length >= 9) {
                $(this).val(newVal.substring(0, 11));
            }
        });
    });
</script>
<!-- ssn validation ends -->
<script>
    // Form submission handler
    // document.getElementById('patientForm').addEventListener('submit', function(e) {
    //     e.preventDefault();

    //     // Show success notification
    //     const notification = document.getElementById('notification');
    //     notification.classList.add('show');

    //     setTimeout(() => {
    //         notification.classList.remove('show');
    //     }, 3000);

    //     // In a real application, you would submit the form data here
    //     console.log('Form submitted successfully');
    // });

    // "Same as patient" checkbox functionality
    document.getElementById('sameAsPatient').addEventListener('change', function() {
        const isChecked = this.checked;
        const patientFields = ['firstname', 'lastname', 'mi', 'dob', 'homephone',
            'mobilephone', 'email', 'address1', 'address2', 'city', 'state', 'postcode'
        ];

        if (isChecked) {
            patientFields.forEach(field => {
                const patientValue = document.getElementById(field).value;
                const guarantorField = 'guarantors_' + field;
                // alert(guarantorField);
                const guarantorElement = document.getElementById(guarantorField);

                if (guarantorElement) {
                    guarantorElement.value = patientValue;
                }
            });

            // Set relationship to "Self"
            document.getElementById('guarantors_relationship').value = 'self';
        }
    });

    // Populate state dropdowns (simplified example)
    const states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado',
        'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho',
        'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
        'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
        'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada',
        'New Hampshire', 'New Jersey', 'New Mexico', 'New York',
        'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon',
        'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota',
        'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington',
        'West Virginia', 'Wisconsin', 'Wyoming'
    ];

    const stateSelects = document.querySelectorAll('select[id$="state"]');
    stateSelects.forEach(select => {
        states.forEach(state => {
            const option = document.createElement('option');
            option.value = state.toLowerCase().replace(' ', '_');
            option.textContent = state;
            select.appendChild(option);
        });
    });
</script>
@endsection