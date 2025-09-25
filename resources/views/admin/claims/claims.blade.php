@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Include Bootstrap & DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .page-title {
        font-size: 28px;
        color: var(--text-dark);
        display: flex;
        align-items: center;
    }

    .page-title i {
        margin-right: 15px;
        color: var(--primary);
        background: rgba(2, 136, 209, 0.1);
        padding: 10px;
        border-radius: 10px;
    }

    .page-actions {
        display: flex;
        gap: 15px;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(2, 136, 209, 0.3);
    }

    .btn-outline {
        background: transparent;
        border: 1px solid var(--primary);
        color: var(--primary);
    }

    .btn-outline:hover {
        background: rgba(2, 136, 209, 0.1);
    }
</style>


<div class="container-fluid">

    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-file-medical"></i>
            Claims List
        </h1>
        <div class="page-actions">
            <a class="btn btn-primary" href="/create-hcfa-claim">
                <i class="fas fa-plus"></i> Create HCFA1500 Claim
            </a>
            <a class="btn btn-primary" href="/create-ub92-claim">
                <i class="fas fa-plus"></i> Create UB92 Claim
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Claim Records</h2>
            <div class="card-tools">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search patients...">
                </div>
                <div class="entries-select">
                    <span>Show</span>
                    <select>
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                    <span>entries</span>
                </div>
            </div>
        </div>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>DOB</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

            </table>
        </div>

        <div class="table-footer">
            <div>Showing 1 to 3 of 3 entries</div>
            <div class="pagination">
                <button class="pagination-btn" disabled>Previous</button>
                <button class="pagination-btn active">1</button>
                <button class="pagination-btn" disabled>Next</button>
            </div>
        </div>
    </div>

</div>
<!-- Include jQuery & DataTables JS -->
<!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script> -->

<script>
    $(function() {
        $('#patientsTable').DataTable({
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            ordering: true,
            searching: true,
        });
    });
</script>
<script>
    // Search functionality
    const searchInput = document.querySelector('.search-box input');
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('.data-table tbody tr');

        rows.forEach(row => {
            const name = row.cells[0].textContent.toLowerCase();
            const email = row.cells[1].textContent.toLowerCase();
            const phone = row.cells[2].textContent.toLowerCase();

            if (name.includes(searchTerm) || email.includes(searchTerm) || phone.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Entries select functionality
    const entriesSelect = document.querySelector('.entries-select select');
    entriesSelect.addEventListener('change', function() {
        // In a real application, this would reload the table with the selected number of entries
        alert(`Showing ${this.value} entries per page`);
    });

    // Action buttons functionality
    const actionButtons = document.querySelectorAll('.action-btn');
    actionButtons.forEach(button => {
        button.addEventListener('click', function() {
            const title = this.getAttribute('title');
            const row = this.closest('tr');
            const patientName = row.cells[0].textContent;

            if (title === 'View Details') {
                alert(`Viewing details for ${patientName}`);
            } else if (title === 'Edit') {
                alert(`Editing patient: ${patientName}`);
            } else if (title === 'Payment') {
                alert(`Processing payment for ${patientName}`);
            }
        });
    });

    // Add New Patient button
    document.querySelector('.btn-primary').addEventListener('click', function() {
        alert('Opening new patient form...');
    });

    // Export button
    document.querySelector('.btn-outline').addEventListener('click', function() {
        alert('Exporting patient data...');
    });
</script>
@endsection