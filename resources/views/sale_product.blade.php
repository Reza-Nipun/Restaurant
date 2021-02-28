<?php use Illuminate\Support\Facades\Session; ?>

@extends('master')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Sale Product</h1>
    

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
            <form action="/save_product" method="POST">
                {{ csrf_field() }} 
                <div class="form-group row">
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <label>Sale Type <span style="color: red;">*</span></label>
                        <select class="form-control" id="sale_type" name="sale_type" required="required">
                            <option value="">Sale Type</option>
                            <option value="0">Restaurant</option>
                            <option value="1">Online</option>
                        </select>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <label>Table </label>
                        <select class="form-control">
                            <option value="">Select Table</option>
                            @foreach($tables as $t)
                                <option value="{{ $t->id }}">{{ $t->table }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <label>Customer Code </label>
                        <input class="form-control" name="customer_code" id="customer_code" />
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <label>Payment Type</label>
                        <select class="form-control" id="payment_type" name="payment_type">
                            <option value="">Payment Type</option>
                            <option value="0">Cash</option>
                            <option value="1">Mobile Banking</option>
                            <option value="2">Card</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5">
                        <select class="form-control" name="item" id="item">
                            <option value="">Select Product</option>
                            @foreach($products as $p)
                                <option value="{{ $p->id.'~'.$p->price }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <span class="btn btn-sm btn-success" title="Add Item" id="add_item">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </span>
                    </div>
                    
                </div>
                <div class="form-group row">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table-data" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">Item</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                                
            </form>
        </div>
    </div>

</div>

<script type="text/javascript">

    $('select').select2();

    $('#add_item').on('click', function() {
        var item_value = $("#item").val();
        var res = item_value.split('~');

        var prod_id = res[0];
        var prod_price = res[1];
        var prod_name = $("#item option:selected").text();

        $("#table-data tbody").append(
            '<tr><td class="text-center"><input type="text" class="form-control" name="product_name[]" id="product_name" value="'+prod_name+'" /><input type="text" class="form-control" name="product_id[]" id="product_id" value="'+prod_id+'" /></td><td class="text-center"><input type="text" class="form-control" name="product_price[]" id="product_price" value="'+prod_price+'" /></td><td class="text-center"><input type="text" class="form-control" name="quantity[]" id="quantity" value="" /></td><td class="text-center"><input type="text" class="form-control" name="total_price[]" id="total_price" value="" /></td><td class="text-center"><span class="btn btn-sm btn-danger" id="DeleteButton" title="Remove Item"><i class="fa fa-archive" aria-hidden="true"></i></span></td></tr>'
        );
    });

    $("#table-data").on("click", "#DeleteButton", function() {
        $(this).closest("tr").remove();
    });

</script>

@endsection