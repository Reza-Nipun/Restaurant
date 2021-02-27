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
                        <input class="form-control form-control-user" 
                            list="customers" name="customer_code" id="customer_code">

                        <datalist id="customers">
                            <option value="0">Edge</option>
                            <option value="Firefox">Firefox</option>
                            <option value="Chrome">Chrome</option>
                            <option value="Opera">Opera</option>
                            <option value="Safari">Safari</option>
                        </datalist>
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
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table-data" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">Item</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">
                                        <span class="btn btn-sm btn-success" title="Add Item" id="tr_clone_add">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">
                                        <input class="form-control" 
                                            list="customers" name="product_name" id="product_name">

                                        <datalist id="customers">
                                            <option value="0">Edge</option>
                                            <option value="Firefox">Firefox</option>
                                            <option value="Chrome">Chrome</option>
                                            <option value="Opera">Opera</option>
                                            <option value="Safari">Safari</option>
                                        </datalist>
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="form-control" name="price" id="price" readonly="readonly" />
                                    </td>
                                    <td class="text-center">
                                        <input type="number" class="form-control" name="quantity" id="quantity" />
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="form-control" name="total_price" id="total_price" readonly="readonly" />
                                    </td>
                                    <td class="text-center">
                                        <span class="btn btn-sm btn-danger delete" title="Remove Item">
                                            <i class="fa fa-archive" aria-hidden="true"></i>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                                
            </form>
        </div>
    </div>

</div>

    <script type="text/javascript">
    
    $('#customer').on('change', function() {
        var value = $(this).val();
        alert($('#customers [value="' + value + '"]').data('customvalue'));
    });

    // function addNewItem(){
    //     $.ajax({
    //         type:'POST',
    //         url:"/add_new_item_row",
    //         data:{"_token": "{{ csrf_token() }}"},
    //         success:function(data){
    //             if(data.length > 0){
    //                 $("#email_emessage").css('display', 'block');
    //                 $("#email_address").val('');
    //                 $("#submit_btn").attr('disabled', 'disabled');
    //             }else{
    //                 $("#email_emessage").css('display', 'none');
    //                 $("#submit_btn").attr('disabled', false);

    //                 $("#confirm_password").blur();
    //             }
    //         }
    //     });
    // }

    $("#tr_clone_add").on("click",function(){
       
       var $tableBody = $('#table-data').find("tbody"),
               $trLast = $tableBody.find("tr:last"),
               $trNew = $trLast.clone();
               $trNew.find('input').val('');
           $trLast.after($trNew);
       });

       $(".delete").live('click', function(event) {
            var rowCount = $('#table-data tbody tr').length;

            console.log(rowCount);

            $(this).parent().parent().remove();
        });
    </script>

@endsection