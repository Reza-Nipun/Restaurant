<?php use Illuminate\Support\Facades\Session; ?>

@extends('master')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Sales Account</h1>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>
        <div class="card-body">
            <form action="{{ url('/update_sales_account/'.$sales_account_info->id) }}" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user" name="name"
                            placeholder="Shop Name" required="required" value="{{ $sales_account_info->name }}">
                            <span>* Shop Name</span>
                    </div>
                    <div class="col-sm-6">
                        <input type="email" class="form-control form-control-user" name="email" id="email_address"
                            placeholder="Email Address" required="required" readonly="readonly" value="{{ $sales_account_info->email }}">
                            <span>* Email Address</span>
                            <p style="color: red; display: none;" id="email_emessage">Email Address Already Exist!</p>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <select class="form-control" name="status" required="required">
                            <option value="">Select Status</option>
                            <option value="1" <?php echo ($sales_account_info->status == 1 ? "selected='selected'" : '');?>>Active</option>
                            <option value="0" <?php echo ($sales_account_info->status == 0 ? "selected='selected'" : '');?>>Inactive</option>
                        </select>
                        <span>* Status</span>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" value="{{ $sales_account_info->phone }}" />
                        <span> Phone</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control" id="mobile" name="mobile" required="required" placeholder="Enter Phone Number 8801*********" value="{{ $sales_account_info->mobile }}" />
                        <span>* Mbile</span>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="receipt_note" name="receipt_note" required="required" placeholder="Enter receipt note" value="{{ $sales_account_info->receipt_note }}" />
                        <span>* Receipt Note</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <textarea class="form-control" name="address" placeholder="Enter shop address">{{ $sales_account_info->address }}</textarea>
                        <span>* Shop Address</span>
                    </div>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" id="vat_percentage" name="vat_percentage" value="{{ $sales_account_info->vat_percentage }}" required="required" placeholder="Enter VAT percentage" value="{{ $sales_account_info->vat_percentage }}" />
                        <span>* VAT Percentage</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <button class="btn btn-success">UPDATE</button>
                        <a class="btn btn-primary" href="{{ url('/reset_password/'.$sales_account_info->id) }}" onclick="return confirm('Are you sure to reset password?');">Reset Password</a>
                    </div>
                    <div class="col-sm-6">
                        
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

    <script type="text/javascript">
    
        function checkEmailAddressAvailability(){
            var email = $("#email_address").val();

            if(email_address != ''){
                $.ajax({
                    type:'POST',
                    url:"{{ url('/user_availability') }}",
                    data:{"_token": "{{ csrf_token() }}", email: email},
                    success:function(data){
                        if(data.length > 0){
                            $("#email_emessage").css('display', 'block');
                            $("#email_address").val('');
                            $("#submit_btn").attr('disabled', 'disabled');
                        }else{
                            $("#email_emessage").css('display', 'none');
                            $("#submit_btn").attr('disabled', false);

                            $("#confirm_password").blur();
                        }
                    }
                });
            }
        }

    </script>

@endsection