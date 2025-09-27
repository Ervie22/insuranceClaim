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

    <form method="POST" action="{{ route('practice.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-container">
            <!-- Patient Information Section -->
            <div class="form-section full-width">
                <div class="section-header">
                    <i class="fas fa-user"></i>
                    <h2>Facility Details</h2>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="group_name" class="required">Group (Billing) Name</label>
                        <div class="input-with-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" id="group_name" name="group_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_npi" class="required">Group NPI</label>
                        <div class="input-with-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" id="group_npi" name="group_npi" required>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="group_taxid">Group Tax ID</label>
                        <input type="text" id="group_taxid" name="group_taxid" required>
                    </div>
                    <div class="form-group">
                        <label for="group_ptan" class="required">Group PTAN</label>
                        <div class="input-with-icon">
                            <input type="text" id="group_ptan" name="group_ptan" required>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="group_phone">Group Phone</label>
                        <div class="input-with-icon">
                            <i class="fas fa-phone"></i>
                            <input type="tel" id="group_phone" name="group_phone" placeholder="(123) 456-7890" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_fax" class="required">Group Fax</label>
                        <div class="input-with-icon">
                            <i class="fas fa-mobile-alt"></i>
                            <input type="tel" id="group_fax" name="group_fax" placeholder="(123) 456-7890" required>
                        </div>
                    </div>
                </div>
                <div class="form-row">

                    <div class="form-group full-width">
                        <label for="address1" class="required">Address 1</label>
                        <div class="input-with-icon">
                            <i class="fas fa-home"></i>
                            <input type="text" id="address1" name="address1" onkeyup="getAddress(this.value)" required>
                        </div>
                    </div>
                    <div class="form-group full-width">
                        <label for="address2">Address 2</label>
                        <input type="text" id="address2" name="address2" required>
                    </div>
                </div>
                <div class="form-row">

                    <div class="form-group">
                        <label for="city" class="required">City</label>
                        <input type="text" id="city" name="city" required>
                    </div>
                    <div class="form-group">
                        <label for="state" class="required">State</label>
                        <input type="text" id="state" name="state" required>
                    </div>
                </div>
                <div class="form-row">

                    <div class="form-group">
                        <label for="postcode" class="required">Post Code</label>
                        <input type="text" id="postcode" name="postcode" required>
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
        $("#group_npi").on("keyup", function() {
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
        $("#group_phone").on("keyup", function() {
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
        $("#group_fax").on("keyup", function() {
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

    // const stateSelects = document.querySelectorAll('select[id$="state"]');
    // stateSelects.forEach(select => {
    //     states.forEach(state => {
    //         const option = document.createElement('option');
    //         option.value = state.toLowerCase().replace(' ', '_');
    //         option.textContent = state;
    //         select.appendChild(option);
    //     });
    // });
</script>
@endsection