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
                                    <label for="lead_status">Lead status</label>
                                    <select name="lead_status" id="lead_status" class="form-control">
                                        <option value="">Select</option>
                                        @foreach( get_lead_status() as $k => $v )
                                        <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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
                    // console.log(response);
                    if(response.status == false) {
                        notify(response.msg,0);
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
