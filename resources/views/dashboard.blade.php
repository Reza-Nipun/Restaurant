@extends('master')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
        </div>

        <!-- Content Row -->
        <div class="row">
        @if(Session::get('user')->access_level == 1)
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                    <h3 class="h3 mb-2 text-gray-800 text-center">2021</h3>
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Sales</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">40,000</div>
                            </div>
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Expense</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">30,000</div>
                            </div>
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Profit-Loss</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">10,000</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                    <h3 class="h3 mb-2 text-gray-800 text-center">March</h3>
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Sales</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">2,000</div>
                            </div>
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Expense</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">1,000</div>
                            </div>
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Profit-Loss</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">1,000</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Today Sales</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">500</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
            <!-- Pending Requests Card Example -->
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pending Sales</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pending_sales }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h5 class="h5 mb-0 text-gray-800">Popular Items</h5>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Category</th>
                                <th class="text-center">Product</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

@if(Session::get('user')->access_level == 1) 
@php

$tdate = Session::get('user')->account_valid_till;
$fdate = date('Y-m-d');
$datetime1 = strtotime($fdate); // convert to timestamps
$datetime2 = strtotime($tdate); // convert to timestamps
$days = (int)(($datetime2 - $datetime1)/86400);

@endphp

    @if($days <= 30)
    <div class="modal fade" id="warning_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    
                    
                    <h3 class="modal-title mr-4" id="exampleModalLabel">Warning Message</h3>
                    <div class="icon-circle bg-warning">
                        <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Your account will expire on: {{ Session::get('user')->account_valid_till }}</p>
                    <p>Please pay yearly service charge {{ Session::get('user')->service_charge }} BDT and extend your account validation date!</p>
                    <br />
                    <p><b>Admin Contact Information:</b></p>
                    <p>Mobile: +8801727135231</p>
                    <p>Email: info@techexpertsbd.com</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">OK</button>
                    <!-- <a class="btn btn-primary" href="/dashboard">ok</a> -->
                </div>
            </div>
        </div>
    </div>
</div>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#warning_modal").modal('show');
        });
    </script>
    @endif
    
@endif

@endsection