<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration - Insurance Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        .form-group {
            flex: 1;
            min-width: 200px;
        }

        .form-group.full-width {
            flex: 1 0 100%;
        }

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
</head>

<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <i class="fas fa-heartbeat"></i>
                    <h1>HealthSure Insurance</h1>
                </div>
                <div class="user-info">
                    <i class="fas fa-user-circle"></i> Welcome, Agent
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="progress-container">
            <div class="progress-steps">
                <div class="progress-bar" style="width: 25%;"></div>
                <div class="step completed">
                    <div class="step-circle"><i class="fas fa-check"></i></div>
                    <div class="step-label">Patient Info</div>
                </div>
                <div class="step active">
                    <div class="step-circle">2</div>
                    <div class="step-label">Guarantor Info</div>
                </div>
                <div class="step">
                    <div class="step-circle">3</div>
                    <div class="step-label">Employment</div>
                </div>
                <div class="step">
                    <div class="step-circle">4</div>
                    <div class="step-label">Review</div>
                </div>
            </div>
            <p>Complete the form to register a new patient. Fields marked with <span class="required"></span> are required.</p>
        </div>

        <form id="patientForm">
            <div class="form-container">
                <!-- Patient Information Section -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-user"></i>
                        <h2>Patient Information</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="firstName" class="required">First Name</label>
                            <div class="input-with-icon">
                                <i class="fas fa-user"></i>
                                <input type="text" id="firstName" name="firstName" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastName" class="required">Last Name</label>
                            <div class="input-with-icon">
                                <i class="fas fa-user"></i>
                                <input type="text" id="lastName" name="lastName" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="middleInitial">Middle Initial</label>
                            <input type="text" id="middleInitial" name="middleInitial" maxlength="1">
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
                                <input type="text" id="ssn" name="ssn" placeholder="XXX-XX-XXXX" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-address-book"></i>
                        <h2>Contact Information</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="homePhone">Home Phone</label>
                            <div class="input-with-icon">
                                <i class="fas fa-phone"></i>
                                <input type="tel" id="homePhone" name="homePhone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mobilePhone" class="required">Mobile Phone</label>
                            <div class="input-with-icon">
                                <i class="fas fa-mobile-alt"></i>
                                <input type="tel" id="mobilePhone" name="mobilePhone" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group full-width">
                            <label for="email">Email</label>
                            <div class="input-with-icon">
                                <i class="fas fa-envelope"></i>
                                <input type="email" id="email" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group full-width">
                            <label for="address1" class="required">Address 1</label>
                            <div class="input-with-icon">
                                <i class="fas fa-home"></i>
                                <input type="text" id="address1" name="address1" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group full-width">
                            <label for="address2">Address 2</label>
                            <input type="text" id="address2" name="address2">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="city" class="required">City</label>
                            <input type="text" id="city" name="city" required>
                        </div>
                        <div class="form-group">
                            <label for="state" class="required">State</label>
                            <select id="state" name="state" required>
                                <option value="">Select State</option>
                                <!-- States would be populated here -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="postCode" class="required">Post Code</label>
                            <input type="text" id="postCode" name="postCode" required>
                        </div>
                    </div>
                </div>

                <!-- Guarantor Information Section -->
                <div class="form-section full-width">
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
                            <label for="guarantorFirstName" class="required">First Name</label>
                            <input type="text" id="guarantorFirstName" name="guarantorFirstName" required>
                        </div>
                        <div class="form-group">
                            <label for="guarantorLastName" class="required">Last Name</label>
                            <input type="text" id="guarantorLastName" name="guarantorLastName" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="guarantorMiddleInitial">Middle Initial</label>
                            <input type="text" id="guarantorMiddleInitial" name="guarantorMiddleInitial" maxlength="1">
                        </div>
                        <div class="form-group">
                            <label for="guarantorDob" class="required">Date of Birth</label>
                            <input type="date" id="guarantorDob" name="guarantorDob" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="relationship" class="required">Relationship With Patient</label>
                            <select id="relationship" name="relationship" required>
                                <option value="">Select Relationship</option>
                                <option value="self">Self</option>
                                <option value="spouse">Spouse</option>
                                <option value="parent">Parent</option>
                                <option value="child">Child</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="guarantorStatus" class="required">Status</label>
                            <select id="guarantorStatus" name="guarantorStatus" required>
                                <option value="">Select Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Employer & Emergency Contacts Section -->
                <div class="form-section full-width">
                    <div class="section-header">
                        <i class="fas fa-briefcase"></i>
                        <h2>Employer & Emergency Contacts</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="employerName">Employer Name</label>
                            <input type="text" id="employerName" name="employerName">
                        </div>
                        <div class="form-group">
                            <label for="department">Department</label>
                            <input type="text" id="department" name="department">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="workPhone">Work Phone</label>
                            <input type="tel" id="workPhone" name="workPhone">
                        </div>
                        <div class="form-group">
                            <label for="workEmail">Work Email</label>
                            <input type="email" id="workEmail" name="workEmail">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group full-width">
                            <label for="employerAddress1">Employer Address 1</label>
                            <input type="text" id="employerAddress1" name="employerAddress1">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group full-width">
                            <label for="employerAddress2">Employer Address 2</label>
                            <input type="text" id="employerAddress2" name="employerAddress2">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="employerCity">City</label>
                            <input type="text" id="employerCity" name="employerCity">
                        </div>
                        <div class="form-group">
                            <label for="employerState">State</label>
                            <select id="employerState" name="employerState">
                                <option value="">Select State</option>
                                <!-- States would be populated here -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="employerPostCode">Post Code</label>
                            <input type="text" id="employerPostCode" name="employerPostCode">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="emergencyContact" class="required">Emergency Contact</label>
                            <input type="text" id="emergencyContact" name="emergencyContact" required>
                        </div>
                        <div class="form-group">
                            <label for="emergencyRelationship" class="required">Relationship</label>
                            <select id="emergencyRelationship" name="emergencyRelationship" required>
                                <option value="">Select Relationship</option>
                                <option value="spouse">Spouse</option>
                                <option value="parent">Parent</option>
                                <option value="child">Child</option>
                                <option value="friend">Friend</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="emergencyPhone" class="required">Emergency Phone</label>
                            <input type="tel" id="emergencyPhone" name="emergencyPhone" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </button>
                <div>
                    <button type="button" class="btn btn-outline">
                        Save as Draft
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Continue <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="notification" id="notification">
        <i class="fas fa-check-circle"></i> Form submitted successfully!
    </div>

    <script>
        // Form submission handler
        document.getElementById('patientForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Show success notification
            const notification = document.getElementById('notification');
            notification.classList.add('show');

            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);

            // In a real application, you would submit the form data here
            console.log('Form submitted successfully');
        });

        // "Same as patient" checkbox functionality
        document.getElementById('sameAsPatient').addEventListener('change', function() {
            const isChecked = this.checked;
            const patientFields = ['firstName', 'lastName', 'middleInitial', 'dob', 'homePhone',
                'mobilePhone', 'email', 'address1', 'address2', 'city', 'state', 'postCode'
            ];

            if (isChecked) {
                patientFields.forEach(field => {
                    const patientValue = document.getElementById(field).value;
                    const guarantorField = 'guarantor' + field.charAt(0).toUpperCase() + field.slice(1);
                    const guarantorElement = document.getElementById(guarantorField);

                    if (guarantorElement) {
                        guarantorElement.value = patientValue;
                    }
                });

                // Set relationship to "Self"
                document.getElementById('relationship').value = 'self';
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
</body>

</html>