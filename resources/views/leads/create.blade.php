@extends('layouts.app')
@section('title','Add Lead')
@section('styles')
<style type="text/css">
    .select2-container {
        width: 100% !important;
        padding: 0;
    }
</style>
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-user-plus"></i>
   </div>
   <div class="header-title">
      <h1>Add Lead</h1>
      <small></small>
   </div>
</section>
<!-- Main content -->
<section class="content">
       <div class="row">
          <!-- Form controls -->
          <div class="col-sm-12">
             <div class="card all_btn_card" id="lobicard-custom-control1" data-sortable="true">
                <div class="card-header all_card_btn">
                    <div class="card-title custom_title">
                        <a class="btn btn-add" href="{{ route('leads') }}"><i class="fa fa-list"></i> Leads List </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('leadstore') }}" method="POST" id="customer_add">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fname">First Name</label>
                                    <input type="text" id="fname" name="first_name" class="form-control" placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lname">Last Name</label>
                                    <input type="text" id="lname" name="last_name" class="form-control" placeholder="Last Name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_name">Company Name</label>
                                    <input type="text" id="company_name" name="company_name" class="form-control" placeholder="Company Name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact_work">Contact (Work)</label>
                                    <input type="text" id="contact_work" name="contact_work" onkeypress="return isNumberOrSpaceKey(event)" class="form-control" placeholder="Contact (Work)">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact_mobile">Contact (Mobile)</label>
                                    <input type="text" id="contact_mobile" name="contact_mobile" onkeypress="return isNumberOrSpaceKey(event)" class="form-control" placeholder="Contact (Mobile)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="abn">ABN</label>
                                    <input type="text" id="abn" name="abn" class="form-control" placeholder="ABN">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address_line1">Street Name and Number</label>
                                    <input type="text" id="address_line1" name="address_line1" class="form-control" placeholder="Street Name and Number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="suburb">Suburb</label>
                                    <input type="text" id="suburb" name="suburb" class="form-control" placeholder="Suburb">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <select id="state" name="state" class="form-control sm-select">
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
                                    <label for="post_code">Post Code</label>
                                    <input type="text" id="post_code" name="post_code" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Post Code">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="website_url">Website Url</label>
                                    <input type="text" id="website_url" name="website_url" class="form-control" placeholder="Website Url">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_of_employees">No Of Employees</label>
                                    <input type="text" id="no_of_employees" name="no_of_employees" onkeypress="return isNumberKey(event)" class="form-control" placeholder="No Of Employees">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="industry">Industry</label>
                                    <select name="industry" id="industry" class="form-control">
                                        <option value="">Select Industry</option>
                                        @foreach( $industry as $v )
                                        <option value="{{ $v->id }}">{{ $v->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lead_status">Lead status</label>
                                    <select name="lead_status" id="lead_status" class="form-control">
                                        <option value="">Select</option>
                                        @foreach( get_lead_status() as $k => $v )
                                        <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @if( $user_role_id == 1 )
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="customer_select">Select Sales Person</label>
                                    <select name="customer_select" id="customer_select" class="form-control sm-select">
                                        <option value="">Select Sales Person</option>
                                        @foreach( $users as $v )
                                        <option value="{{ $v->id }}">{{ $v->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @else
                            <input type="hidden" name="customer_select" value="{{ \Auth::id() }}">
                            @endif
                        </div>

                        <div class="reset-button">
                            <button type="reset" class="btn btn-warning"> Reset</button>
                            <button type="submit" class="btn btn-success"> Save</button>
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
<script type="text/javascript">

    $(document).ready(function(e) {

        // create customer start
        $(document).on('submit', '#customer_add', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{!! route('leadstore') !!}',
                type: 'post',
                data: $('#customer_add').serialize(),
                success: function(response) {
                    $('input').removeClass('invalid').next('.custom_error').remove();
                    $('select').removeClass('invalid').next('.custom_error').remove();
                    // console.log(response);
                    if(response.status == false) {
                        $.each(response.errors, function(i,e) {
                            $("[name='"+i+"']").addClass('invalid')
                            .after('<span class="custom_error text-danger">'+e+'</span>');
                        });
                        // notify(response.msg,0);
                    } else {
                        window.location.href =  "{{ route('leads') }}";
                    }
                },
                error: function() {
                    console.log('Some error occurred in edit_user_get !!!');
                }
            }); // end ajax call
        });
        // create customer end
    });
</script>
@endsection
