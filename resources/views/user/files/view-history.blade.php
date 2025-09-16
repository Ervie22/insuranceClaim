@extends('layouts.app')

@section('content')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<div class="container-fluid">
    <div class="row p-2">
        <div class="col-12">
            <div class="card ">

                <div class="card-body">
                    <div class="row">
                        <div class="col-10">
                            <h6>View History</h6>
                        </div>
                        <div class="col-2 text-success">
                            <p>Next refresh in <span id="countdown">20</span> seconds...</p>
                        </div>


                        <div class="card-body">
                            <table id="fileTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Study Name</th>
                                        <!-- <th>Study ID</th> -->
                                        <th>Uploaded Date</th>
                                        <th>Status</th>
                                        <th>End Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($history as $key => $val)
                                    <tr>
                                        <td>{{$val['study_name']}}</td>
                                        <!-- <td>{{$val['study_id']}}</td> -->
                                        <td>{{ date('d-m-Y h:i:s', strtotime($val['upload_date'])) }}</td>
                                        <td>
                                            @if($val['status'] == 1)
                                            <span class="badge bg-primary">Pending</span>
                                            @elseif($val['status'] == 2)
                                            <span class="badge bg-warning">In Progress</span>
                                            @elseif($val['status'] == 3)
                                            <span class="badge bg-warning">Processed</span>
                                            @elseif($val['status'] == 4)
                                            <span class="badge bg-warning">Tiling</span>
                                            @elseif($val['status'] == 5)
                                            <span class="badge bg-success">Completed</span>
                                            @elseif($val['status'] == 6)
                                            <span class="badge bg-danger">Error</span>
                                            @else
                                            <span class="badge bg-secondary">Unknown</span>
                                            @endif
                                        </td>
                                        <td>{{isset($val['end_time']) ? $val['end_time']:"N/A"}}</td>

                                        <td>
                                            @if($val['status'] == 5)
                                            <a href="/view/jobs/{{$val['study_id']}}/1" class="btn btn-sm  text-white" style="background-color: #4f46e5;">View</a>
                                            @else
                                            <!-- Analysis Not Completed -->
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery (required by DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        let countdown = 20;

        function updateTimer() {
            document.getElementById("countdown").innerText = countdown;
            countdown--;

            if (countdown < 0) {
                location.reload(); // refresh the page
            }
        }

        // Run every second
        setInterval(updateTimer, 1000);
        $(document).ready(function() {
            $('#fileTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true, // Optional: enable column sorting
                "info": true
            });
        });
    </script>


    @endsection