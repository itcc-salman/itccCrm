@extends('layouts.app')
@section('title','Digital Sales')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-file-text"></i>
   </div>
   <div class="header-title">
      <h1>Sales</h1>
      <small>List of Digital Sales</small>
   </div>
</section>
<!-- Main content -->
<section class="content">
   <div class="row">
        <div class="col-lg-12 pinpin">
            <div class="card" id="lobicard-custom-control" data-sortable="true">
                <div class="card-header">
                    <div class="card-title custom_title">
                        <h4>Digital Sales Details
                            <a class="btn btn-add pull-right" href="{{ route('digitalsalesform') }}"><i class="fa fa-file-text"></i>&nbsp; Add Digital Sales</a>
                        </h4>
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

</section>
<!-- /.content -->
@endsection
@section('scripts')
<script type="text/javascript">

    $(document).ready(function() {
      getRenderedView('{!! route('digitalsales') !!}');

        $(document).on('click', '.pagination a',function(event) {
            event.preventDefault();
            var myurl = $(this).attr('href');
            getRenderedView(myurl);
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
