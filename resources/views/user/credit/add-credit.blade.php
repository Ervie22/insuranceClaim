@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row p-2">
        <div class="col-12">
            <div class="card ">

                <div class="card-body">
                    <h6>Edit My Preferences</h6>
                    <div class="card-body">
                        <table id="fileTable" class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Value</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>User Credit</td>
                                    <td><input type="text" class="form-control" name="user_credit" id="user_credit" value="{{ isset($getCredit['no_of_credits']) ? $getCredit['no_of_credits']:0 }}" placeholder="User Credit"></td>
                                    <td><a onclick="saveCredit('{{$uid}}')" class="btn btn-sm  text-white" style="background-color: #4f46e5;">Update</a></td>
                                </tr>
                                <tr>
                                    <td>Notification Email</td>
                                    <td> <input type="email" class="form-control" name="notification_email" id="notification_email" value="{{ isset($getEmail['email']) ? $getEmail['email']:'N/A' }}" placeholder="Notification Email"></td>
                                    <td><a onclick="saveEmail('{{$uid}}')" class="btn btn-sm  text-white" style="background-color: #4f46e5;">Update</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function saveCredit(id) {
        var userCredit = $("#user_credit").val();
        $.ajax({
            url: '/update-credit', // Laravel route
            method: 'POST',
            data: {
                uid: id,
                user_credit: userCredit,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: res => {
                alert('Updated successfully!');
                window.location.reload();
            },
            error: err => {
                alert('Update failed!');
                console.error(err);
            }
        });

    }

    function saveEmail(id) {
        var email = $("#notification_email").val();
        $.ajax({
            url: '/update-email', // Laravel route
            method: 'POST',
            data: {
                uid: id,
                email: email,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: res => {
                alert('Updated successfully!');
                window.location.reload();
            },
            error: err => {
                alert('Update failed!');
                console.error(err);
            }
        });

    }
</script>
@endsection