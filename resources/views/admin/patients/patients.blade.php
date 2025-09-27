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
            <i class="fas fa-user-injured"></i>
            Patients List
        </h1>
        <div class="page-actions">
            <!-- <button class="btn btn-outline">
                <i class="fas fa-download"></i> Export
            </button> -->
            <a class="btn btn-primary" href="/create-patient">
                <i class="fas fa-plus"></i> Add New Patient
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Patient Records</h2>

        </div>

        <div class="table-container">
            <table class="data-table" id="patientsTable">
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
                    @forelse($patients as $val)
                    <tr>
                        <td>{{ $val['first_name'] ?? '' }} {{ $val['last_name'] ?? '' }}</td>
                        <td>{{ $val['email'] ?? '' }}</td>
                        <td>{{ $val['mobilephone'] ?? '' }}</td>
                        <td>{{ isset($val['dob']) ? date('d-m-Y', strtotime($val['dob'])) : '' }}</td>
                        <td>
                            <span class="badge {{ $val['active'] == 1 ? 'bg-success' : 'bg-danger' }}">
                                {{ $val['active'] == 1 ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="/view-patient/{{$val['id']}}" class="text-primary me-2"><i class="fa fa-eye"></i></a>
                            <!-- <a href="#" class="text-danger"><i class="fa fa-trash"></i></a> -->
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


    <!-- Include jQuery & DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

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

        // Export button
        document.querySelector('.btn-outline').addEventListener('click', function() {
            alert('Exporting patient data...');
        });
    </script>
    @endsection