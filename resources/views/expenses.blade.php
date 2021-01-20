@extends('master')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-sm-10">
            <h1 class="h3 mb-2 text-gray-800">Expenditures</h1>
        </div>
        <div class="col-sm-2">
            <a class="btn btn-success" href="/create_expense">
                <i class="fa fa-plus" aria-hidden="true"></i> Expense
            </a>    
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Expenditures</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Expense</th>
                            <th class="text-center">User Name</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expenses as $k => $e)
                            <tr>
                                <td class="text-center">{{ $k+1 }}</td>
                                <td class="text-center">{{ $e->expenditures }}</td>
                                <td class="text-center">{{ $e->description }}</td>
                                <td class="text-center">{{ $e->date }}</td>
                                <td class="text-center">{{ $e->expense }}</td>
                                <td class="text-center">{{ $e->name }}</td>
                                <td class="text-center">Action</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection