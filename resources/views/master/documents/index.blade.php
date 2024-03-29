@extends('layouts.app')
@section('title','Documents')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-file-text"></i>
   </div>
   <div class="header-title">
      <h1>Documents</h1>
      <small>List of Documents</small>
   </div>
</section>
<!-- Main content -->
<section class="content">
   <div class="row">
        <div class="col-lg-12 pinpin">
            <div class="card" id="lobicard-custom-control" data-sortable="true">
                <div class="card-header">
                    <div class="card-title custom_title">
                        <h4>Documents Details</h4>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                    {{-- <div class="btn-group d-flex" role="group">
                        <div class="buttonexport">
                            <a href="#" class="btn btn-add" data-toggle="modal" data-target="#adduser"><i class="fa fa-plus"></i> Add Industry</a>
                        </div>
                    </div> --}}
                    <!-- ./Plugin content:powerpoint,txt,pdf,png,word,xl -->
                    <div id="render_data"></div>
                </div>
            </div>
        </div>
   </div>
   <!-- User Modal1 -->
   <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header modal-header-primary">
               <h3><i class="fa fa-plus m-r-5"></i> Update Industry</h3>
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
   <div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header modal-header-primary">
               <h3><i class="fa fa-plus m-r-5"></i> Add new Industry</h3>
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <form class="form-horizontal" id="create_user">
                        <div class="row">
                           <!-- Text input-->
                           <div class="col-md-12 form-group">
                              <label class="control-label" for="create_name">Upload Document</label>
                              <input type="file" name="document" id="create_name" placeholder="Name" class="form-control">
                           </div>
                           <!-- Text input-->
                           <div class="col-md-12 form-group">
                              <label class="control-label">Document Type</label>
                              <select name="document_type" id="document_type" class="form-control">
                                    <option value="">Select Document Type</option>
                                    @foreach(get_document_types() as $k => $v)
                                        <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                              </select>
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
<script src="{{ asset('js/bootstrap-filestyle.min.js') }}" ></script>
<script type="text/javascript">

    $(document).ready(function() {
      getRenderedView('{!! route('masterdocuments') !!}');

        $('#adduser').on('hidden.bs.modal', function (e) {
            $(this)
            .find("input,textarea,select")
             .val('')
             .end()
          .find("input[type=checkbox], input[type=radio]")
             .prop("checked", "")
             .end();
        });

        $(document).on('click', '.pagination a',function(event) {
            event.preventDefault();
            var myurl = $(this).attr('href');
            getRenderedView(myurl);
        });

      // create user start
      $(document).on('submit', '#create_user', function(e) {
         e.preventDefault();
         $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });
         $.ajax({
            url: '{!! route('documentcreate') !!}',
            type: 'POST',
            data: $('#create_user').serialize(),
            success: function (response) {
                var current_tab = $(".page-item.active").index() + 1;
                if(response.status == false) {
                    notify(response.msg,0);
                } else {
                    $('#adduser').modal('toggle');
                    notify(response.msg,1);
                    getRenderedView('{!! route('masterdocuments') !!}');
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
      $(document).on('click', '.edit_this', function(e) {
        e.preventDefault();
        var _edit_id = $(this).attr('edit_id');
        $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{!! route('documentget') !!}',
            type: 'post',
            data:{id: _edit_id},
            success: function(response) {
                console.log(response);
                if(response.status == true) {
                    $('#edit_body').html(response.html);
                    $('#document_edit').filestyle({
                        iconName : 'fa fa-file-pdf-o',
                        buttonName : 'btn-add',
                        buttonText : ' Select a PDF'
                    });
                    $('#edit_modal').modal();
                }
            },
            error: function() {
                console.log('Some error occurred in edit_user_get !!!');
            }
        });
      });
      // edit user get end

      // edit user start
      $(document).on('submit', '#edit_form', function(e) {
         e.preventDefault();
         $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });
         $.ajax({
            url: '{!! route('documentedit') !!}',
            type: 'POST',
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                var current_tab = $(".page-item.active").index() + 1;
                if(response.status == false) {
                    notify(response.msg,0);
                } else {
                    $('#edit_modal').modal('toggle');
                    notify(response.msg,1);
                    getRenderedView('{!! route('masterdocuments') !!}');
                    if( current_tab > 1 ) {
                        $(".pagination li:nth-child("+current_tab+") a").trigger('click');
                    }
                }

            },
            error: function() {
               console.log('Some error occurred in industryedit !!!');
            }
         });
      });
      // edit user end

   });

    $(document).on("click", '.delete_this', function () {
        var _delete_id = $(this).attr('delete_id');
        swal({
            title: "Are you sure?",
            text: "Your will not be able to recover this record!",
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
                    url: '{!! route('documentdelete') !!}/'+_delete_id,
                    type: 'GET',
                    success: function (response) {
                        var current_tab = $(".page-item.active").index() + 1;
                        // console.log(response);
                        if(response.status == false) {
                            notify(response.msg,0);
                        } else {
                            swal("Deleted!", response.msg, "success");
                            // notify(response.msg,1);
                            getRenderedView('{!! route('masterdocuments') !!}');
                            if( current_tab > 1 ) {
                                $(".pagination li:nth-child("+current_tab+") a").trigger('click');
                            }
                        }
                    },
                    error: function() {
                       console.log('Some error occurred in delete_this !!!');
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
