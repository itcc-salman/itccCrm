@extends('layouts.app')
@section('title','Edit Lead')
@section('styles')
<link href="{{ asset('assets/plugins/timedropper/timedropper.css') }}" rel="stylesheet" />
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
      <h1>Edit Lead</h1>
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
                    <form action="{{ route('leadeditstore') }}" method="POST" id="edit">
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
                                        <option value="{{ $k }}" {{ $k == $data->state ? 'selected="selected"' : '' }}>{{ $v }}</option>
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
                                        <option value="{{ $v->id }}" {{ $k == $data->industry ? 'selected="selected"' : '' }}>{{ $v->name }}</option>
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
                                        <option value="{{ $k }}" {{ $k == $data->lead_status ? 'selected="selected"' : '' }}>{{ $v }}</option>
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
                                        @if( $v->roles[0]->id != 1)
                                        <option value="{{ $v->id }}" {{ $v->id == $data->sales_person_id ? 'selected="selected"' : '' }}>{{ $v->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @else
                            <input type="hidden" name="customer_select" value="{{ \Auth::id() }}">
                            @endif
                        </div>

                        <div class="reset-button">
                            <a href="{{ route('leads') }}" class="btn btn-danger"> Cancel</a>
                            <button type="submit" class="btn btn-success"> Update</button>
                            <button type="button" data-toggle="modal" data-target="#meeting_modal" class="btn btn-info pull-right">Add Meeting</button>
                        </div>
                   </form>
                </div>
             </div>
         </div>
    </div>


    <div class="row">
        <div class="col-lg-12 pinpin">
            <div class="card" id="lobicard-custom-control" data-sortable="true">
                <div class="card-header">
                    <div class="card-title custom_title">
                        <h4>Meetings List</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div id="render_data"></div>
                </div>
            </div>
        </div>
   </div>


    <!-- User Modal1 -->
   <div class="modal fade" id="meeting_modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" id="modal_data">
        <div class="modal-content">
            <form method="POST" id="meeting_form">
                <div class="modal-header modal-header-primary">
                   <h3><i class="fa fa-plus m-r-5"></i> Add Meeting</h3>
                   <input type="hidden" name="leadid" value="{{ $data->id }}">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" id="edit_body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Sales Person</label>
                                @if($user_role_id == 1)
                                <select name="sales_person" id="sales_person" class="form-control sm-select">
                                    <option value="">Select Sales Person</option>
                                    @foreach( $users as $u )
                                    @if( $u->roles[0]->id != 1)
                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @else
                                <input type="hidden" name="sales_person" id="sales_person" value="{{ \Auth::id() }}">
                                <input type="text" readonly value="{{ \Auth::user()->name }}" class="form-control">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="body">Note</label>
                                <textarea name="body" id="body" class="form-control" placeholder="Note"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="meeting_at">Meeting Date</label>
                                <input type="text" name="meeting_at" id="meeting_at" class="form-control datepicker" placeholder="DD/MM/YYYY">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="meeting_time">Meeting Time</label>
                                <input type="text" name="meeting_time" id="meeting_time" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="meeting_status">Meeting Status</label>
                                <select name="meeting_status" id="meeting_status" class="form-control">
                                    <option value="">Select</option>
                                    @foreach( get_meeting_status() as $k => $v )
                                    <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="meeting_summary">Summary</label>
                                <textarea name="meeting_summary" id="meeting_summary" class="form-control" placeholder="Summary"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                   <button type="button" class="btn btn-danger float-left" data-dismiss="modal">Close</button>
                </div>
            </form>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
   <!-- /.modal -->

   <!-- Edit Modal1 -->
   <div class="modal fade" id="meeting_modal_edit" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" id="modal_data_edit">

      </div>
      <!-- /.modal-dialog -->
   </div>
   <!-- /.modal -->

</section>
<!-- /.content -->
@endsection
@section('scripts')
<script src="{{ asset('assets/plugins/timedropper/timedropper.js') }}" ></script>
<script type="text/javascript">
    $(document).ready(function(e) {

        getRenderedView('{!! route('leadMeetings') !!}?id={{ $data->id }}');

        $('#meeting_modal').on('hidden.bs.modal', function (e) {
            $(this)
            .find("input,textarea,select")
             .val('')
             .end()
          .find("input[type=checkbox], input[type=radio]")
             .prop("checked", "")
             .end();
        });

        $( "#meeting_time" ).timeDropper({
            format: 'h:m A',
            meridians: true,
            setCurrentTime: false,
        });

        // edit meeting get popup data start
        $(document).on('click', '.edit_this', function(e) {
            e.preventDefault();
            var _edit_id = $(this).attr('edit_id');
            $.ajaxSetup({
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{!! route('meetingedit') !!}',
                type: 'post',
                data:{id: _edit_id},
                success: function(response) {
                    if(response.status == true) {
                        $('#modal_data_edit').html(response.html);
                        $('#meeting_modal_edit').modal();
                        $( "#meeting_time_edit" ).timeDropper({
                            format: 'h:m A',
                            meridians: true,
                            setCurrentTime: false,
                        });
                        $('.sm-select').select2({
                            allowClear: true
                        });

                        $('.datepicker').datepicker({
                            format: 'dd/mm/yyyy',
                            autoclose: true,
                            todayHighlight: true,
                            clearBtn: true
                        });
                    }
                },
                error: function() {
                    console.log('Some error occurred in edit_meeting_get !!!');
                }
            });
        });
        // edit meeting get popup data end

        // update meeting start
        $(document).on('submit', '#meeting_form_edit', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{!! route('meetingeditstore') !!}',
                type: 'post',
                data: $('#meeting_form_edit').serialize(),
                success: function(response) {
                    // console.log(response);
                    if(response.status == false) {
                        notify(response.msg,0);
                    } else {
                        $('#meeting_modal_edit').modal('toggle');
                        notify(response.msg,1);
                        // getRenderedView('{!! route('leadMeetings') !!}');
                        getRenderedView('{!! route('leadMeetings') !!}?id={{ $data->id }}');
                    }
                },
                error: function() {
                    console.log('Some error occurred in add meeting !!!');
                }
            }); // end ajax call
        });
        // update meeting end

        // create meeting start
        $(document).on('submit', '#meeting_form', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{!! route('meetingstore') !!}',
                type: 'post',
                data: $('#meeting_form').serialize(),
                success: function(response) {
                    // console.log(response);
                    if(response.status == false) {
                        notify(response.msg,0);
                    } else {
                        $('#meeting_modal').modal('toggle');
                        notify(response.msg,1);
                        // getRenderedView('{!! route('leadMeetings') !!}');
                        getRenderedView('{!! route('leadMeetings') !!}?id={{ $data->id }}');
                    }
                },
                error: function() {
                    console.log('Some error occurred in add meeting !!!');
                }
            }); // end ajax call
        });
        // create meeting end

        // create customer start
        $(document).on('submit', '#edit', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{!! route('leadeditstore') !!}',
                type: 'post',
                data: $('#edit').serialize(),
                success: function(response) {
                    $('input').removeClass('invalid').next('.custom_error').remove();
                    $('select').removeClass('invalid').next('.custom_error').remove();
                    // console.log(response);
                    if(response.status == false) {
                        $.each(response.errors, function(i,e) {
                            $("[name='"+i+"']").addClass('invalid')
                            .after('<span class="custom_error text-danger">'+e+'</span>');
                        });
                    } else {
                        window.location.href =  "{{ route('leads') }}";
                    }
                },
                error: function() {
                    console.log('Some error occurred in edit_lead_store !!!');
                }
            }); // end ajax call
        });
        // create customer end
    });

    function getRenderedView(url){

        $.ajax({
            url:url,
            method: 'get',
            cache: false,
            async: false,
            success: function (response) {
                $('#render_data').html(response.html);
            },
            error: function () {
                console.log('Some unknown error occurred !!!');
            }
        });
   }
</script>
@endsection
