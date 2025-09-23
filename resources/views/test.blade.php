<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HCFA-1500 (CMS-1500) — Web Form</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Visual styling to approximate the printed HCFA layout while remaining usable */
        body {
            background: #f8f9fa;
        }

        .hcfa-card {
            background: #fff;
            border: 1px solid #ccc;
            padding: 20px;
            margin: 20px auto;
            max-width: 1200px;
        }

        .section-title {
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 8px;
        }

        .form-label {
            font-size: 0.85rem;
        }

        .small-input {
            font-size: 0.85rem;
        }

        .service-table th,
        .service-table td {
            vertical-align: middle;
        }

        .required::after {
            content: " *";
            color: #d00;
        }

        @media (max-width:767px) {
            .hcfa-card {
                padding: 12px
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="hcfa-card shadow-sm">
            <h3 class="mb-3 text-center">Health Insurance Claim Form — Web Version (HCFA / CMS-1500)</h3>

            <form id="hcfaForm" novalidate>
                <!-- Top section: identification -->
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label required">1. Insured's ID Number</label>
                        <input type="text" class="form-control" name="insured_id" placeholder="Insured ID" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label required">2. Patient's Name</label>
                        <input type="text" class="form-control" name="patient_name" placeholder="Last, First, Middle" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label required">3. Patient's Birth Date</label>
                        <input type="date" class="form-control" name="patient_dob" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label required">4. Insured's Name</label>
                        <input type="text" class="form-control" name="insured_name" placeholder="Last, First" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label required">Sex</label>
                        <select class="form-select" name="sex" required>
                            <option value="">Select</option>
                            <option value="M">M</option>
                            <option value="F">F</option>
                            <option value="U">U</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">5. Patient's Address</label>
                        <input type="text" class="form-control" name="patient_address" placeholder="Street, City, State, ZIP">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">6. Patient Relationship to Insured</label>
                        <select class="form-select" name="relationship">
                            <option value="Self">Self</option>
                            <option value="Spouse">Spouse</option>
                            <option value="Child">Child</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">7. Insured's Address</label>
                        <input type="text" class="form-control" name="insured_address" placeholder="Street, City, State, ZIP">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">8. Patient Status</label>
                        <select class="form-select" name="patient_status">
                            <option value="">--</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Employment / accident / other questions -->
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">9. Other Insured's Name</label>
                        <input type="text" class="form-control" name="other_insured_name">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">10a. Is Patient's Condition Related To: (Employment/Auto/Other)</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="occ" name="related_employment">
                            <label class="form-check-label" for="occ">Employment</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="auto" name="related_auto">
                            <label class="form-check-label" for="auto">Auto Accident</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="otheracc" name="related_other">
                            <label class="form-check-label" for="otheracc">Other Accident</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">11. Insured's Policy/Group Number</label>
                        <input type="text" class="form-control" name="policy_group">
                    </div>
                </div>

                <hr class="my-4">

                <!-- Signature block (simplified) -->
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">12. Signature of Patient or Authorized Person</label>
                        <input type="text" class="form-control" name="patient_signature" placeholder="Type name as signature">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Date</label>
                        <input type="date" class="form-control" name="signature_date">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">13. Insured's or Authorized Person's Signature</label>
                        <input type="text" class="form-control" name="insured_signature" placeholder="Type name as signature">
                    </div>
                </div>

                <hr class="my-4">

                <!-- Service lines (Item 24 equivalent) -->
                <div class="section-title">24. Dates of Service / Procedures / Charges (Service Lines)</div>
                <div class="table-responsive">
                    <table class="table table-bordered service-table" id="serviceTable">
                        <thead class="table-light align-middle">
                            <tr>
                                <th style="min-width:110px">From</th>
                                <th style="min-width:110px">To</th>
                                <th style="min-width:80px">Place of Service</th>
                                <th style="min-width:120px">CPT / HCPCS</th>
                                <th style="min-width:120px">Modifier</th>
                                <th style="min-width:120px">Diagnosis Code</th>
                                <th style="min-width:100px">$ Charges</th>
                                <th style="width:80px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="date" class="form-control" name="from_date[]"></td>
                                <td><input type="date" class="form-control" name="to_date[]"></td>
                                <td>
                                    <select class="form-select small-input" name="place_of_service[]">
                                        <option value="">--</option>
                                        <option value="11">Office</option>
                                        <option value="21">Inpatient Hospital</option>
                                        <option value="22">Outpatient Hospital</option>
                                        <option value="81">Other</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" name="cpt[]" placeholder="e.g. 99213"></td>
                                <td><input type="text" class="form-control" name="modifier[]" placeholder="e.g. -25"></td>
                                <td><input type="text" class="form-control" name="dxcode[]" placeholder="e.g. M54.5"></td>
                                <td><input type="number" step="0.01" class="form-control" name="charges[]"></td>
                                <td class="text-center"><button type="button" class="btn btn-sm btn-danger remove-line">-</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex gap-2 mb-3">
                    <button type="button" id="addService" class="btn btn-sm btn-primary">Add Service Line</button>
                    <button type="button" id="calcTotal" class="btn btn-sm btn-secondary">Calculate Total</button>
                    <div class="ms-auto align-self-center">
                        <label class="form-label mb-0">Total Charges</label>
                        <input type="text" readonly class="form-control" id="totalCharges" style="width:160px; display:inline-block;">
                    </div>
                </div>

                <hr>

                <!-- Billing provider -->
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label required">31. Signature of Physician or Supplier</label>
                        <input type="text" class="form-control" name="provider_signature" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label required">25. Federal Tax ID / SSN</label>
                        <input type="text" class="form-control" name="tax_id" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label required">33. Physician / Supplier Billing Name & Phone</label>
                        <input type="text" class="form-control" name="billing_name_phone" required>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <div>
                        <button type="submit" class="btn btn-success">Validate & Preview</button>
                        <button type="button" id="resetBtn" class="btn btn-outline-secondary">Reset</button>
                    </div>
                    <div>
                        <button type="button" id="printBtn" class="btn btn-outline-primary">Print Form</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add / remove service lines
        document.getElementById('addService').addEventListener('click', function() {
            const tbody = document.querySelector('#serviceTable tbody');
            const row = document.createElement('tr');
            row.innerHTML = `
        <td><input type="date" class="form-control" name="from_date[]"></td>
        <td><input type="date" class="form-control" name="to_date[]"></td>
        <td>
          <select class="form-select small-input" name="place_of_service[]">
            <option value="">--</option>
            <option value="11">Office</option>
            <option value="21">Inpatient Hospital</option>
            <option value="22">Outpatient Hospital</option>
            <option value="81">Other</option>
          </select>
        </td>
        <td><input type="text" class="form-control" name="cpt[]" placeholder="e.g. 99213"></td>
        <td><input type="text" class="form-control" name="modifier[]" placeholder="e.g. -25"></td>
        <td><input type="text" class="form-control" name="dxcode[]" placeholder="e.g. M54.5"></td>
        <td><input type="number" step="0.01" class="form-control" name="charges[]"></td>
        <td class="text-center"><button type="button" class="btn btn-sm btn-danger remove-line">-</button></td>
      `;
            tbody.appendChild(row);
        });

        document.querySelector('#serviceTable').addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-line')) {
                const row = e.target.closest('tr');
                const tbody = row.parentElement;
                // keep at least one line
                if (tbody.rows.length > 1) row.remove();
            }
        });

        // Calculate total charges
        document.getElementById('calcTotal').addEventListener('click', function() {
            const charges = Array.from(document.getElementsByName('charges[]'));
            let total = 0;
            charges.forEach(c => {
                const v = parseFloat(c.value);
                if (!isNaN(v)) total += v;
            });
            document.getElementById('totalCharges').value = total.toFixed(2);
        });

        // Basic validation & preview on submit
        document.getElementById('hcfaForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = e.target;
            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                alert('Please complete required fields (marked *).');
                return;
            }
            // simple preview: open print view of filled form
            alert('Form validated. Use the Print button to produce a printable copy.');
        });

        // Reset
        document.getElementById('resetBtn').addEventListener('click', function() {
            if (confirm('Reset the form?')) document.getElementById('hcfaForm').reset();
        });

        // Print (basic)
        document.getElementById('printBtn').addEventListener('click', function() {
            // Optionally create a simplified print view
            window.print();
        });
    </script>
</body>

</html>