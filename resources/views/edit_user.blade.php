<?php use Illuminate\Support\Facades\Session; ?>

@extends('master')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit User</h1>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>
        <div class="card-body">
            <form action="/update_user/{{ $user_info->id }}" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user" name="name"
                            value="{{ $user_info->name }}" placeholder="User Name">
                    </div>
                    <div class="col-sm-6">
                        <input type="email" class="form-control form-control-user" name="email"
                            value="{{ $user_info->email }}" placeholder="Email Address">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input type="number" class="form-control form-control-user" name="allow_sub_accounts"
                            value="{{ $user_info->allow_sub_accounts }}" placeholder="Allow Number of Sub-Accounts">
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <select class="form-control" name="status">
                            <option value="">Select Status</option>
                            <option value="1" <?php echo ($user_info->status == 1 ? "selected='selected'" : '');?>>Active</option>
                            <option value="0" <?php echo ($user_info->status == 0 ? "selected='selected'" : '');?>>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <button class="btn btn-success">Update</button>
                    </div>
                    <div class="col-sm-6">
                        
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection