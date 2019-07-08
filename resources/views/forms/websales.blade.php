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
                        <h5 class="bd-t p-t-4 bd-b p-b-4">Client Details</h5>

                        <div class="row p-t-4">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="client_name">Customer Name <small>(Given Name/s)</small></label>
                                    <input type="text" id="client_name" name="client_name" class="form-control" placeholder="Customer Name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="client_surname">Customer Surname</label>
                                    <input type="text" id="client_surname" name="client_surname" class="form-control" placeholder="Customer Surname">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="client_company_name">Company Name</label>
                                    <input type="text" id="client_company_name" name="client_company_name" class="form-control" placeholder="Company Name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="client_state">State</label>
                                    <select name="client_state" id="client_state" class="form-control">
                                        <option value="">Select State</option>
                                        @foreach( get_states() as $k => $v )
                                        <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="client_postcode">Postcode</label>
                                    <input type="text" id="client_postcode" name="client_postcode" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Postcode">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="client_contact_work">Contact (W)</label>
                                    <input type="text" id="client_contact_work" name="client_contact_work" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Contact (W)">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="client_contact_mobile">Contact (M)</label>
                                    <input type="text" id="client_contact_mobile" name="client_contact_mobile" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Contact (M)">
                                </div>
                            </div>
                            <div class="col-md-4">
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
                                    <input type="text" id="project_start_date" name="project_start_date" class="form-control" placeholder="YYYY/MM/DD">
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
