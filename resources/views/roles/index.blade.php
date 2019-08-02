@extends('layouts.app')
@section('title','Roles')

@section('styles')
<link href="{{ asset('assets/plugins/icheck/skins/all.css') }}" rel="stylesheet" />
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-user-plus"></i>
   </div>
   <div class="header-title">
      <h1>Roles</h1>
      <small>List of Roles</small>
   </div>
</section>
<!-- Main content -->
<section class="content">
   <div class="row">
        <div class="col-lg-12 pinpin">
            <div class="card" id="lobicard-custom-control" data-sortable="true">
                <div class="card-header">
                    <div class="card-title custom_title">
                        <h4>Role Details</h4>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                    @can('role-create')
                    {{-- <div class="btn-group d-flex" role="group">
                        <div class="buttonexport">
                            <a href="#" class="btn btn-add" data-toggle="modal" data-target="#addrole"><i class="fa fa-plus"></i> Add Role</a>
                        </div>
                    </div> --}}
                    @endcan
                    <!-- ./Plugin content:powerpoint,txt,pdf,png,word,xl -->
                    <div id="render_data"></div>
                </div>
            </div>
        </div>
   </div>
   <!-- User Modal1 -->
   <div class="modal fade" id="edit_role_modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header modal-header-primary">
               <h3><i class="fa fa-plus m-r-5"></i> Update Role</h3>
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="edit_body">

            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger float-left" data-dismiss="modal">Close</button>
            </div>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
   <!-- /.modal -->
   <!-- Modal -->
   <!-- User Modal1 -->
   <div class="modal fade" id="addrole" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header modal-header-primary">
               <h3><i class="fa fa-plus m-r-5"></i> Add New Role</h3>
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <form class="form-horizontal" id="create_role">
                        <div class="row">
                           <!-- Text input-->
                           <div class="col-md-12 form-group">
                              <label class="control-label" for="create_name">Name</label>
                              <input type="text" name="name" id="create_name" autocomplete="new-password" placeholder="Name" class="form-control">
                           </div>
                           <!-- Text input-->
                           <div class="col-md-12 form-group">
                                <label class="control-label">Permission</label>
                                <div class="row">
                                    @foreach($permission as $value)
                                    <div class="col-md-6">
                                        <div class="i-check">
                                            <input tabindex="{{ $value->id }}" type="checkbox" id="permission_{{ $value->id }}" name="permission[]" value="{{ $value->id }}">
                                            <label for="permission_{{ $value->id }}">{{ $value->name }}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                           </div>
                           <div class="col-md-12 form-group user-form-group">
                              <div class="float-right">
                                 <button type="submit" class="btn btn-add btn-sm">Save</button>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger float-left" data-dismiss="modal">Close</button>
            </div>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
   <!-- /.modal -->
</section>
<!-- /.content -->
@endsection
@section('scripts')
<script src="{{ asset('assets/plugins/icheck/icheck.min.js') }}" ></script>
<script type="text/javascript">

    $('#addrole .i-check input').iCheck({
        checkboxClass: 'icheckbox_flat-green'
    });

    $(document).ready(function() {
        getRenderedView('{!! route('roles') !!}');

        $('#addrole').on('hidden.bs.modal', function (e) {
            $(this)
            .find("input,textarea,select")
            .val('')
            .end()
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end();
            $('.icheckbox_flat-green').removeClass('checked');
        });

        $(document).on('click', '.pagination a',function(event) {
            event.preventDefault();
            var myurl = $(this).attr('href');
            getRenderedView(myurl);
        });

      // create user start
      $(document).on('submit', '#create_role', function(e) {
         e.preventDefault();
         $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });
         $.ajax({
            url: '{!! route('roleCreate') !!}',
            type: 'POST',
            data: $('#create_role').serialize(),
            success: function (response) {
                var current_tab = $(".page-item.active").index() + 1;
                if(response.status == false) {
                    notify(response.msg,0);
                } else {
                    $('#addrole').modal('toggle');
                    notify(response.msg,1);
                    // $(".page-item.active > span").text();
                    getRenderedView('{!! route('roles') !!}');
                    if( current_tab > 1 ) {
                        $(".pagination li:nth-child("+current_tab+") a").trigger('click');
                    }

               }

            },
            error: function() {
               console.log('Some error occurred in create_user !!!');
            }
         });
      });
      // create user end

      // data-toggle="modal" data-target="#update"
      // edit user get start
      $(document).on('click', '.edit_role', function(e) {
        e.preventDefault();
        var _edit_id = $(this).attr('edit_id');
        $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{!! route('getrole') !!}',
            type: 'post',
            data:{id: _edit_id},
            success: function(response) {
                console.log(response);
                if(response.status == true) {
                    $('#edit_body').html(response.html);
                    $('#edit_role .i-check input').iCheck({
                        checkboxClass: 'icheckbox_flat-green'
                    });
                    $('#edit_role_modal').modal();
                }
            },
            error: function() {
                console.log('Some error occurred in edit_role_get !!!');
            }
        });
      });
      // edit user get end

      // edit user start
      $(document).on('submit', '#edit_role', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{!! route('roleEdit') !!}',
            type: 'POST',
            data: $('#edit_role').serialize(),
            success: function (response) {
                var current_tab = $(".page-item.active").index() + 1;
                if(response.status == false) {
                    notify(response.msg,0);
                } else {
                    $('#edit_role_modal').modal('toggle');
                    notify(response.msg,1);
                    getRenderedView('{!! route('roles') !!}');
                    if( current_tab > 1 ) {
                        $(".pagination li:nth-child("+current_tab+") a").trigger('click');
                    }
                }

            },
            error: function() {
               console.log('Some error occurred in create_role !!!');
            }
        });
      });
      // edit user end

   });

    $(document).on("click", '.delete_role', function () {
        var _delete_id = $(this).attr('delete_id');
        swal({
            title: "Are you sure?",
            text: "Your will not be able to revert back !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function (isConfirm) {
            if (isConfirm) {
                // call ajax here
                $.ajax({
                    url: '{!! route('roleDelete') !!}/'+_delete_id,
                    type: 'GET',
                    success: function (response) {
                        // console.log(response);
                        if(response.status == false) {
                            notify(response.msg,0);
                        } else {
                            swal("Deleted!", response.msg, "success");
                            // notify(response.msg,1);
                            getRenderedView('{!! route('roles') !!}');
                        }
                    },
                    error: function() {
                       console.log('Some error occurred in delete_role !!!');
                    }
                });
            }
        });
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
