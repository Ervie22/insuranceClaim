@extends('layouts.app')

@section('content')
<style>
    .up-gradient-bg {
        background: linear-gradient(90deg, #5a5df0, #6e7bfb);
        color: white;
        border-radius: 12px;
    }

    .up-icon-bg {
        background: rgba(255, 255, 255, 0.1);
        /* translucent white */
        border-radius: 10px;
        padding: 10px;
    }

    .in-gradient-bg {
        background: linear-gradient(90deg, #00b4d8, #00d4c9);
        color: white;
        border-radius: 12px;
    }

    .accordion-toggle:hover {
        background-color: #f9f9f9;
    }

    .in-icon-bg {
        background: rgba(255, 255, 255, 0.1);
        /* translucent white */
        border-radius: 10px;
        padding: 10px;
    }

    .com-gradient-bg {
        background: linear-gradient(135deg, #28c76f, #22c55e);
        color: white;
        border-radius: 12px;
    }

    .com-icon-bg {
        background: rgba(255, 255, 255, 0.1);
        /* translucent white */
        border-radius: 10px;
        padding: 10px;
    }
</style>
<div class="container-fluid">
    <div class="row p-2">
        <h6>Dashboard</h6>
        <div class="col-12">
            <div class="card ">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-1">
                            <div class="card up-gradient-bg text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-3">
                                            <div class="text-white-75 fw-bold fs-4">Total Studies</div>
                                            <div class="fw-bold fs-4">{{ $uploadedCount }}</div>
                                        </div>
                                        <div class="up-icon-bg">
                                            <i class="fa-solid fa-flask fa-4x text-white"></i>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-1">
                            <div class="card in-gradient-bg text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-3">
                                            <div class="text-white-75 fw-bold fs-4">In Progress</div>
                                            <div class="fs-4 fw-bold">{{ $inProgressCount }}</div>
                                        </div>
                                        <div class="in-icon-bg">
                                            <i class="fa-solid fa-spinner fa-4x text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-1">
                            <div class="card com-gradient-bg text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-3">
                                            <div class="text-white-75 fw-bold fs-4">Completed</div>
                                            <div class="fs-4 fw-bold">{{ $CompletedCount }}</div>
                                        </div>
                                        <div class="com-icon-bg">
                                            <i class="fa-solid fa-circle-check fa-4x text-white"></i>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card mt-1">
                                <div class="card-header">
                                    Analysis Overview
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Study Name</th>
                                                <th>Date</th>
                                                <th>ETC</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach(array_slice($jobsArr, 0, 10) as $key => $job)
                                            <tr class="accordion-toggle" data-toggle="collapse" data-target="#details{{$key}}" style="cursor: pointer;">
                                                <td>{{ $i }}</td>
                                                <td>{{ $job['study_name'] }}</td>
                                                <td>{{ date('d-m-Y H:i:s', strtotime($job['upload_date'])) }}</td>
                                                <td>{{ $job['end_time'] }} </td>
                                                <td>
                                                    @if($job['status'] == "1")
                                                    <span class="badge bg-primary">Pending</span>
                                                    @elseif($job['status'] == "2")
                                                    <span class="badge bg-warning">In Progress</span>
                                                    @elseif($job['status'] == "3")
                                                    <span class="badge bg-warning">Processed</span>
                                                    @elseif($job['status'] == "4")
                                                    <span class="badge bg-warning">Tiling</span>
                                                    @elseif($job['status'] == "5")
                                                    <span class="badge bg-success">Completed</span>
                                                    @elseif($job['status'] == "6")
                                                    <span class="badge bg-danger">Error</span>
                                                    @else
                                                    <span class="badge bg-secondary">Unknown</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($job['status'] == 5)
                                                    <a href="/view/jobs/{{$job['study_id']}}/1" class="btn btn-sm text-white" style="background-color: #4f46e5;">View</a>
                                                    @else

                                                    @endif
                                                </td>
                                            </tr>

                                            <!-- Accordion Row -->
                                            <tr class="collapse" id="details{{$key}}">
                                                <td colspan="6">
                                                    @if(!empty($job['studyDet']))
                                                    <table class="table table-sm table-striped mb-0" style="background-color: #A2AADB">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Study Name</th>
                                                                <th>File Name</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($job['studyDet'] as $index => $file)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $file['study_name'] }}</td>
                                                                <td>{{ $file['file_name'] }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    @else
                                                    <p>No files found for this study.</p>
                                                    @endif
                                                </td>
                                            </tr>

                                            <?php $i += 1; ?>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fas fa-tasks me-1"></i>
                                    Pending Tasks
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Complete project report
                                            <span class="badge bg-primary rounded-pill">3 days left</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Submit documentation
                                            <span class="badge bg-warning rounded-pill">1 day left</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Update profile information
                                            <span class="badge bg-danger rounded-pill">Overdue</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fas fa-bell me-1"></i>
                                    Recent Notifications
                                </div>
                                <div class="card-body">
                                    <div class="list-group">
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1">New announcement</h6>
                                                <small>3 days ago</small>
                                            </div>
                                            <p class="mb-1">There will be a system maintenance on Friday night.</p>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1">Task assigned</h6>
                                                <small>1 week ago</small>
                                            </div>
                                            <p class="mb-1">You have been assigned a new task by admin.</p>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1">Profile update</h6>
                                                <small>2 weeks ago</small>
                                            </div>
                                            <p class="mb-1">Please update your profile information.</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('.accordion-toggle').on('click', function() {
            var targetId = $(this).data('target');
            $(targetId).toggleClass('show');
        });
    });
</script>

@endsection