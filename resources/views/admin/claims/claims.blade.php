@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Include Bootstrap & DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">



<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Claim List</h4>
        <a class="btn " style="background-color:#00A6D9; color:#d3fbff;" href="/create-claim">
            <i class="fa fa-plus"></i> Create Claim
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered" id="patientsTable">
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
                    <tr>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Phone</td>
                        <td>DOB</td>
                        <td>Status</td>
                        <td>Actions</td>
                    </tr>
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
        $('#patientsTable').DataTable({
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            ordering: true,
            searching: true,
        });
    });
</script>
@endsection