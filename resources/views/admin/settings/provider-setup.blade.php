@extends('layouts.app')

@section('content')
<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- DataTables Bootstrap 5 -->
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
<style>
    /* Table borders */
    table.dataTable {
        border: 1px solid #dee2e6;
        border-radius: 0.5rem;
        overflow: hidden;
    }

    /* Header styling */
    table.dataTable thead th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: 600;
        text-transform: uppercase;
        padding: 12px;
    }

    /* Row hover */
    table.dataTable tbody tr:hover {
        background-color: #f1f3f5;
    }

    /* Pagination */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.3rem 0.75rem;
        margin: 0 2px;
        border-radius: 0.375rem;
        border: 1px solid #dee2e6;
        background: #fff;
        color: #0d6efd !important;
        cursor: pointer;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #0d6efd;
        color: #fff !important;
    }

    /* Length dropdown */
    .dataTables_wrapper .dataTables_length select {
        border-radius: 0.375rem;
        padding: 0.2rem 0.5rem;
    }

    /* Search box */
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 0.375rem;
        border: 1px solid #ced4da;
        padding: 0.3rem 0.75rem;
        margin-left: 0.5rem;
    }
</style>


<div class="container-fluid">

    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-user-gear"></i>
            Provider Setup
        </h1>
        <div class="page-actions">
            <!-- <a class="btn btn-primary" href="/create-hcfa-claim">
                <i class="fas fa-plus"></i> Create HCFA1500 Claim
            </a> -->
            <a class="btn btn-primary" href="/create-provider">
                <i class="fas fa-plus"></i> Create Provider
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Provider Records</h2>

        </div>

        <div class="table-container">
            <table class="data-table" id="providersTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Speciality</th>
                        <th>CAQH ID</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($providers as $val)
                    <tr>
                        <td>{{ $val['provider_first_name'] ?? '' }} {{ $val['provider_last_name'] ?? '' }}</td>
                        <td>{{ $val['role'] ?? '' }}</td>
                        <td>{{ $val['speciality'] ?? '' }}</td>
                        <td>{{ $val['caqh_id'] ?? '' }}</td>
                        <td>
                            <span class="badge {{ $val['active'] == 1 ? 'bg-success' : 'bg-danger' }}">
                                {{ $val['status'] == 1 ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="#" class="text-success me-2"><i class="fa fa-pen"></i></a>
                            <a href="#" class="text-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No patients found</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>


    </div>

</div>
<!-- Include jQuery & DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(function() {
        $('#providersTable').DataTable({
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


    // Export button
    // document.querySelector('.btn-outline').addEventListener('click', function() {
    //     alert('Exporting patient data...');
    // });
</script>
@endsection