@extends('layouts.app')
@section('title','Customers')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-user-plus"></i>
   </div>
   <div class="header-title">
      <h1>Customers</h1>
      <small>List of Customers</small>
   </div>
</section>
<!-- Main content -->
<section class="content">
   <div class="row">
        <div class="col-lg-12 pinpin">
            <div class="card" id="lobicard-custom-control" data-sortable="true">
                <div class="card-header">
                    <div class="card-title custom_title">
                        <h4>Customer Details</h4>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                    @can('customer-create')
                    <div class="btn-group d-flex" role="group">
                        <div class="buttonexport">
                            <a href="{{ route('customercreate') }}" class="btn btn-add"><i class="fa fa-plus"></i> Add Customer</a>
                        </div>
                    </div>
                    @endcan
                    <!-- ./Plugin content:powerpoint,txt,pdf,png,word,xl -->
                    <div id="render_data"></div>
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

    $(document).ready(function() {
        getRenderedView('{!! route('customers') !!}');

        $(document).on('click', '.pagination a',function(event) {
            event.preventDefault();
            var myurl = $(this).attr('href');
            getRenderedView(myurl);
        });

        // get view_customer data start
        $(document).on('click', '.view_customer', function(e) {
            e.preventDefault();
            var _view_id = $(this).attr('view_id');
            $.ajaxSetup({
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{!! route('viewcustomer') !!}',
                type: 'post',
                data:{id: _view_id},
                success: function(response) {
                    // console.log(response);
                    if(response.status == true) {
                        $('#modal_data').html(response.html);
                        $('#customer_modal').modal();
                    }
                },
                error: function() {
                    console.log('Some error occurred in edit_user_get !!!');
                }
            }); // end ajax call
        });
        // get view_customer data end

    });

    $(document).on("click", '.delete_customer', function () {
        var _delete_id = $(this).attr('delete_id');
        swal({
            title: "Are you sure?",
            text: "Your will not be able to recover this customer!",
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
                $.ajaxSetup({
                    headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{!! route('customerDelete') !!}',
                    type: 'POST',
                    data: {id: _delete_id},
                    success: function (response) {
                        var current_tab = $(".page-item.active").index() + 1;
                        // console.log(response);
                        if(response.status == false) {
                            notify(response.msg,0);
                        } else {
                            swal("Deleted!", response.msg, "success");
                            // notify(response.msg,1);
                            getRenderedView('{!! route('customers') !!}');
                            if( current_tab > 1 ) {
                                $(".pagination li:nth-child("+current_tab+") a").trigger('click');
                            }
                        }
                    },
                    error: function() {
                       console.log('Some error occurred in delete_customer !!!');
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
