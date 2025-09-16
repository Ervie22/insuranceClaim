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
        <!-- <h6>Dashboard</h6> -->
        <div class="col-12">
            <div class="card ">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-4">
                            <div class="card up-gradient-bg text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-3">
                                            <div class="text-white-75">No. of Users</div>
                                            <div class="text-lg fw-bold">{{ count($allUsers)  }}</div>
                                        </div>
                                        <div class="up-icon-bg">
                                            <i class="fa-solid fa-flask fa-2x text-white"></i>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card in-gradient-bg text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-3">
                                            <div class="text-white-75">Completed studies</div>
                                            <div class="text-lg fw-bold">{{ $completed  }}</div>
                                        </div>
                                        <div class="in-icon-bg">
                                            <i class="fa-solid fa-spinner fa-2x text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card in-gradient-bg text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-3">
                                            <div class="text-white-75">Error count</div>
                                            <div class="text-lg fw-bold">{{ $analyzisError  }}</div>
                                        </div>
                                        <div class="in-icon-bg">
                                            <i class="fa-solid fa-spinner fa-2x text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card com-gradient-bg text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-3">
                                            <div class="text-white-75">Settings</div>
                                            <div class="text-lg fw-bold">-</div>
                                        </div>
                                        <div class="com-icon-bg">
                                            <i class="fa-solid fa-circle-check fa-2x text-white"></i>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card mt-4">
                                <div class="card-header">
                                    Studies Overview
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Study Name</th>
                                                <th>Status</th>
                                                <th>Actions</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach(array_slice($recentFiles, 0, 10) as $key => $file)

                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{ $file['study_id'] }}</td>
                                                <td>
                                                    @if($file['status'] == 1)
                                                    <span class="badge bg-primary">Pending</span>
                                                    @elseif($file['status'] == 2)
                                                    <span class="badge bg-warning">In Progress</span>
                                                    @elseif($file['status'] == 3)
                                                    <span class="badge bg-warning">Processed</span>
                                                    @elseif($file['status'] == 4)
                                                    <span class="badge bg-warning">Tiling</span>
                                                    @elseif($file['status'] == 5)
                                                    <span class="badge bg-success">Completed</span>
                                                    @elseif($file['status'] == 6)
                                                    <span class="badge bg-danger">Error</span>
                                                    @else
                                                    <span class="badge bg-secondary">Unknown</span>
                                                    @endif
                                                </td>
                                                <td> <a href="#" style="color: #4f46e5;"><i class="fas fa-file-alt"></i></a> <a href="#" class="ml-5" style="color: #4f46e5;"><i class="fa-solid fa-align-left"></i></a></td>
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
@endsection