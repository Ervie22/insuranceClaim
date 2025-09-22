@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Include Bootstrap & DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">



<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Patient List</h4>
        <a class="btn " style="background-color:#00A6D9; color:#d3fbff;" href="/create-patient">
            <i class="fa fa-plus"></i> Create Patient
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