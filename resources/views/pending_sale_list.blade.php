@extends('master')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-sm-10">
            <h1 class="h3 mb-2 text-gray-800">Pending List</h1>
        </div>
        <div class="col-sm-2">
            <a class="btn btn-success" href="/sale_product">
                <i class="fa fa-money-check-alt" aria-hidden="true"></i> Sale Product
            </a>    
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                @if(Session::has('flash_message'))
                    <p class="alert alert-danger">
                    {{ Session::get('flash_message') }}
                    </p>
                    {{ Session::forget('flash_message') }}
                @endif
                @if(Session::has('success_message'))
                    <p class="alert alert-success">
                    {{ Session::get('success_message') }}
                    </p>
                    {{ Session::forget('success_message') }}
                @endif
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Invoice No</th>
                            <th class="text-center">Table</th>
                            <th class="text-center">Customer ID</th>
                            <th class="text-center">Sale Type</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($pending_list AS $k => $pl)
                        <tr>
                            <td class="text-center">{{ $k+1 }}</td>
                            <td class="text-center">{{ $pl->invoice_no }}</td>
                            <td class="text-center">{{ $pl->table }}</td>
                            <td class="text-center">{{ $pl->customer_code }}</td>
                            <td class="text-center">{{ $pl->sell_type == 0 ? 'Restaurant' : 'Online' }}</td>
                            <td class="text-center">{{ $pl->grand_total }}</td>
                            <td class="text-center">
                                <a href="" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="/print/{{ $pl->id }}" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-print"></i> Print</a>
                                <a href="/print_invoice/{{ $pl->id }}" class="btn btn-sm btn-warning" onclick="return confirm('Are you sure to print invoice?')"><i class="fa fa-receipt"></i> Invoice</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection