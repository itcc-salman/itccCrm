@extends('layouts.app')
@section('title','Web Sales Form')
@section('styles')
<link href="{{ asset('assets/plugins/icheck/skins/all.css') }}" rel="stylesheet" />
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-wpforms"></i>
   </div>
   <div class="header-title">
      <h1>Web Sales Form</h1>
      <small></small>
   </div>
</section>
<!-- Main content -->
<section class="content">
   <div class="row">
        <div class="col-lg-12 pinpin">
            <div class="card" id="lobicard-custom-control" data-sortable="true">
                <div class="card-header">
                    <div class="card-title custom_title">
                        <h4>SERVICE AGREEMENT</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('websalesform') }}" method="POST" id="form_add">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="customer_select">Select Customer</label>
                                    <select name="customer_select" id="customer_select" class="form-control sm-select">
                                        <option value="">Select Customer</option>
                                        @foreach( $customers as $v )
                                        <option value="{{ $v->id }}">{{ $v->getCustomerFullName() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="customer_select">Sales Person</label>
                                    @if($user_role_id == 1)
                                    <select name="sales_person" id="sales_person" class="form-control sm-select">
                                        <option value="">Select Sales Person</option>
                                        @foreach( $users as $u )
                                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                                        @endforeach
                                    </select>
                                    @else
                                    <input type="hidden" name="sales_person" id="sales_person" value="{{ \Auth::id() }}">
                                    <input type="text" readonly value="{{ \Auth::user()->name }}" class="form-control">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <h5 class="bd-t p-t-4 bd-b p-b-4">Client Details</h5>

                        <div class="row p-t-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_name">Customer Name <small>(Given Name/s)</small></label>
                                    <input type="text" id="client_name" name="client_name" class="form-control" placeholder="Customer Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_surname">Customer Surname</label>
                                    <input type="text" id="client_surname" name="client_surname" class="form-control" placeholder="Customer Surname">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_company_name">Company Name</label>
                                    <input type="text" id="client_company_name" name="client_company_name" class="form-control" placeholder="Company Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_address_line_1">Address <small>(Street Name and Number)</small></label>
                                    <input type="text" id="client_address_line_1" name="client_address_line_1" class="form-control" placeholder="Street Name and Number">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_suburb">Suburb </label>
                                    <input type="text" id="client_suburb" name="client_suburb" class="form-control" placeholder="Suburb">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_state">State</label>
                                    <select name="client_state" id="client_state" class="form-control sm-select">
                                        <option value="">Select State</option>
                                        @foreach( get_states() as $k => $v )
                                        <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_postcode">Postcode</label>
                                    <input type="text" id="client_postcode" name="client_postcode" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Postcode">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_contact_work">Contact (W)</label>
                                    <input type="text" id="client_contact_work" name="client_contact_work" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Contact (W)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_contact_mobile">Contact (M)</label>
                                    <input type="text" id="client_contact_mobile" name="client_contact_mobile" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Contact (M)">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_abn">ABN</label>
                                    <input type="text" id="client_abn" name="client_abn" class="form-control" placeholder="ABN">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_email">Email Address</label>
                                    <input type="email" id="client_email" name="client_email" class="form-control" placeholder="Email Address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_website">Website</label>
                                    <input type="text" id="client_website" name="client_website" class="form-control" placeholder="Website">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="project_start_date">Project Start Date</label>
                                    <input type="text" id="project_start_date" name="project_start_date" class="form-control" placeholder="DD/MM/YYYY">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="project_amount">Total Amount</label>
                                    <input type="text" id="project_amount" name="project_amount" class="form-control" onkeypress="return isNumberOrSpaceKey(event)" placeholder="$">
                                </div>
                            </div>
                        </div>

                        <h5 class="bd-t p-t-4 bd-b p-b-4">Service/Products</h5>

                        <div class="row p-t-4" id="project_services_data">
                            @foreach( get_web_sales_services() as $k => $v )
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="checkbox" id="project_services_{{ $k }}" name="project_services[]" value="{{ $k }}">
                                    &nbsp;&nbsp;&nbsp;<label for="project_services_{{ $k }}">{{ $v }} </label>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div id="items_row" class="p-t-4 bd-t">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="item_descriptions_1">Item Description</label>
                                        <input type="text" id="item_descriptions_1" name="item_descriptions[]" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="unit_price_1">Unit Price</label>
                                        <input type="text" id="unit_price_1" name="unit_price[]" thisval="1" class="form-control calc" onkeypress="return isNumberKey(event)" placeholder="$">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="quantity_1">Quantity</label>
                                        <input type="text" id="quantity_1" name="quantity[]" thisval="1" class="form-control calc" onkeypress="return isNumberKey(event)" placeholder="0">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="total_1">Total</label>
                                        <input type="text" id="total_1" readonly name="total[]" class="form-control" placeholder="0">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <button id="add_items" class="btn btn-primary m-t-25"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="payment_type">Payment Type</label>
                                    <select name="payment_type" id="payment_type" class="form-control">
                                        <option value="">Select Payment Type</option>
                                        @foreach( get_payment_type() as $k => $v )
                                        <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="payment_method">Payment Method</label>
                                    <select name="payment_method" id="payment_method" class="form-control">
                                        <option value="">Select Payment Method</option>
                                        @foreach( get_payment_method() as $k => $v )
                                        <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div id="signature-pad">
                                    <div class="signature-pad--body">
                                        <canvas></canvas>
                                    </div>
                                    <div class="signature-pad--footer">
                                        <div class="description">Signature/s of Nominated Account Holder/s</div>
                                        <div class="signature-pad--actions">
                                            <div>
                                                <button type="button" class="button clear" data-action="clear">Clear</button>
                                                <button type="button" class="button" data-action="undo">Undo</button>
                                                <button type="button" class="button save" data-action="save-png">Save as PNG</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
   </div>
</section>
<!-- /.content -->
@endsection
@section('scripts')
<script src="{{ asset('assets/plugins/icheck/icheck.min.js') }}" ></script>
<script type="text/javascript">
    $(document).ready(function() {

        $(document).on('change', '#customer_select', function(e) {
            e.preventDefault();
            var _cust_id = $(this).val();
            $('#client_name').val('');
            $('#client_surname').val('');
            $('#client_company_name').val('');
            $('#client_address_line_1').val('');
            $('#client_suburb').val('');
            $('#client_state').val('').trigger('change');
            $('#client_postcode').val('');
            $('#client_contact_work').val('');
            $('#client_contact_mobile').val('');
            $('#client_abn').val('');
            $('#client_email').val('');
            $('#client_website').val('');
            if( _cust_id != '') {
                // call ajax here
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{!! route('customer_select') !!}',
                    type: 'POST',
                    data: { customer_id: _cust_id},
                    cache: false,
                    success: function (response) {
                        if(response.status == false) {
                            notify(response.msg,0);
                        } else {
                            var _cust = response.data;
                            $('#client_name').val(_cust.first_name);
                            $('#client_surname').val(_cust.last_name);
                            $('#client_company_name').val(_cust.company_name);
                            $('#client_address_line_1').val(_cust.address_line1);
                            $('#client_suburb').val(_cust.suburb);
                            $('#client_state').val(_cust.state).trigger('change');
                            $('#client_postcode').val(_cust.post_code);
                            $('#client_contact_work').val(_cust.contact_work);
                            $('#client_contact_mobile').val(_cust.contact_mobile);
                            $('#client_abn').val(_cust.abn);
                            $('#client_email').val(_cust.email);
                            $('#client_website').val(_cust.website_url);
                        }
                    },
                    error: function() {
                        console.log('Some error occurred in customer_select !!!');
                    }
                }); // end ajax here
            }
        });

        $('#project_services_data input').iCheck({
            checkboxClass: 'icheckbox_minimal',
            radioClass: 'iradio_minimal',
            increaseArea: '20%'
        });
        var _count = 2;
        $(document).on('click', '#add_items', function(e) {
            e.preventDefault();
            var _d = `<div class="row" id="items_`+_count+`">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="item_descriptions_`+_count+`">Item Description</label>
                                <input type="text" id="item_descriptions_`+_count+`" name="item_descriptions[]" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="unit_price_`+_count+`">Unit Price</label>
                                <input type="text" id="unit_price_`+_count+`" thisval="`+_count+`" name="unit_price[]" class="form-control calc" onkeypress="return isNumberKey(event)" placeholder="$">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="quantity_`+_count+`">Quantity</label>
                                <input type="text" id="quantity_`+_count+`" thisval="`+_count+`" name="quantity[]" class="form-control calc" onkeypress="return isNumberKey(event)" placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="total_`+_count+`">Total</label>
                                <input type="text" id="total_`+_count+`" readonly name="total[]" class="form-control" placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <button id="remove_item" remove="`+_count+`" class="btn btn-danger m-t-25 removeme"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                    </div>`;
            $('#items_row').append(_d);
            _count++;
        });

        $(document).on('click', '.removeme', function(e) {
            e.preventDefault();
            var _rmid = $(this).attr('remove');
            $('#items_'+_rmid).remove();
        });

        $(document).on('change', '.calc', function(e) {
            e.preventDefault();
            var _val = $(this).attr('thisval');
        });

        // submit form start
        $(document).on('submit', '#form_add', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{!! route('websalesform') !!}',
                type: 'POST',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response.status == false) {
                        notify(response.msg,0);
                    } else {
                        notify(response.msg,1);
                    }
                },
                error: function() {
                    console.log('Some error occurred in websalesform !!!');
                }
            }); // end ajax here
        });
        // submit form end

    });
</script>
@endsection
