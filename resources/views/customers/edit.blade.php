@extends('layouts.app')
@section('title','Edit Customer')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-user-plus"></i>
   </div>
   <div class="header-title">
      <h1>Edit Customer</h1>
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
                        <a class="btn btn-add" href="{{ route('customers') }}"><i class="fa fa-list"></i> Customer List </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('customereditstore') }}" method="POST" id="customer_edit">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fname">First Name</label>
                                    <input type="text" id="fname" name="first_name" value="{{ $data->first_name }}" class="form-control" placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lname">Last Name</label>
                                    <input type="text" id="lname" name="last_name" value="{{ $data->last_name }}" class="form-control" placeholder="Last Name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" value="{{ $data->email }}" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_name">Company Name</label>
                                    <input type="text" id="company_name" name="company_name" value="{{ $data->company_name }}" class="form-control" placeholder="Company Name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact_work">Contact (Work)</label>
                                    <input type="text" id="contact_work" name="contact_work" value="{{ $data->contact_work }}" onkeypress="return isNumberOrSpaceKey(event)" class="form-control" placeholder="Contact (Work)">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact_mobile">Contact (Mobile)</label>
                                    <input type="text" id="contact_mobile" name="contact_mobile" value="{{ $data->contact_mobile }}" onkeypress="return isNumberOrSpaceKey(event)" class="form-control" placeholder="Contact (Mobile)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="abn">ABN</label>
                                    <input type="text" id="abn" name="abn" value="{{ $data->abn }}" class="form-control" placeholder="ABN">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address_line1">Street Name and Number</label>
                                    <input type="text" id="address_line1" name="address_line1" value="{{ $data->address_line1 }}" class="form-control" placeholder="Street Name and Number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="suburb">Suburb</label>
                                    <input type="text" id="suburb" name="suburb" value="{{ $data->suburb }}" class="form-control" placeholder="Suburb">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <select id="state" name="state" class="form-control sm-select">
                                        <option value="">Select State</option>
                                        @foreach( get_states() as $k => $v )
                                        <option value="{{ $k }}" {{ $data->state == $k ? "selected='selected'" : '' }} >{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="post_code">Post Code</label>
                                    <input type="text" id="post_code" name="post_code" value="{{ $data->post_code }}" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Post Code">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="website_url">Website Url</label>
                                    <input type="text" id="website_url" name="website_url" value="{{ $data->website_url }}" class="form-control" placeholder="Website Url">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_of_employees">No Of Employees</label>
                                    <input type="text" id="no_of_employees" name="no_of_employees" value="{{ $data->no_of_employees }}" onkeypress="return isNumberKey(event)" class="form-control" placeholder="No Of Employees">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="industry">Industry</label>
                                    <select name="industry" id="industry" class="form-control">
                                        <option value="">Select Industry</option>
                                        @foreach( $industry as $v )
                                        <option value="{{ $v->id }}" {{ $v->id == $data->industry ? 'selected="selected"' : '' }}>{{ $v->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="reset-button">
                            <a href="{{ route('customers') }}" class="btn btn-danger"> Cancel</a>
                            <button type="submit" class="btn btn-success"> Update</button>
                        </div>
                   </form>
                </div>
             </div>
         </div>
    </div>
    <!-- User Modal1 -->
   <div class="modal fade" id="customer_modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" id="modal_data">
      </div>
      <!-- /.modal-dialog -->
   </div>
   <!-- /.modal -->
</section>
<!-- /.content -->
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(e) {

        // create customer start
        $(document).on('submit', '#customer_edit', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{!! route('customereditstore') !!}',
                type: 'post',
                data: $('#customer_edit').serialize(),
                success: function(response) {
                    // console.log(response);
                    if(response.status == false) {
                        notify(response.msg,0);
                    } else {
                        window.location.href =  "{{ route('customers') }}";
                    }
                },
                error: function() {
                    console.log('Some error occurred in edit_customer_store !!!');
                }
            }); // end ajax call
        });
        // create customer end
    });
</script>
@endsection
