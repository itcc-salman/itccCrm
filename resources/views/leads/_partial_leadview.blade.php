<div class="modal-content">
    <div class="modal-header modal-header-primary">
       <h3><i class="fa fa-user m-r-5"></i> Leads Info</h3>
       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <td width="50%"><strong>Lead Status :</strong> {{ get_lead_status($data->lead_status) }}</td>
                        <td width="50%"><strong>Created Date :</strong> {{ $data->created_at }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <td colspan="2" align="center"><strong>Customer Details</strong></td>
                    </tr>
                    <tr>
                        <td width="50%"><strong>First Name :</strong> {{ $data->customer->first_name }}</td>
                        <td width="50%"><strong>Last Name :</strong> {{ $data->customer->last_name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Company Name :</strong> {{ $data->customer->company_name }}</td>
                        <td><strong>ABN :</strong> {{ $data->customer->abn }}</td>
                    </tr>
                    <tr>
                        <td><strong>Street Name and Number :</strong> {{ $data->customer->address_line1 }}</td>
                        <td><strong>Suburb :</strong> {{ $data->customer->suburb }}</td>
                    </tr>
                    <tr>
                        <td><strong>State :</strong> {{ get_states($data->customer->state) }}</td>
                        <td><strong>Post Code :</strong> {{ $data->customer->post_code }}</td>
                    </tr>
                    <tr>
                        <td><strong>Contact (Work) :</strong> {{ $data->customer->contact_work }}</td>
                        <td><strong>Contact (Mobile) :</strong> {{ $data->customer->contact_mobile }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email :</strong> {{ $data->customer->email }}</td>
                        <td><strong>Website URL :</strong> {{ $data->customer->website_url }}</td>
                    </tr>
                    <tr>
                        <td><strong>No of Employees :</strong> {{ $data->customer->no_of_employees }}</td>
                        <td><strong>Industry :</strong> {{ $data->customer->get_industry->name }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {!! $meetings_html !!}
            </div>
        </div>
    </div>
    <div class="modal-footer">
       <button type="button" class="btn btn-danger float-left" data-dismiss="modal">Close</button>
    </div>
</div>
<!-- /.modal-content -->
