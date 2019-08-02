<div class="table-responsive">
    <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
        <thead class="back_table_color">
            <tr class="info">
               <th>No</th>
               <th>Date</th>
               <th>Business Name</th>
               <th>Ref No</th>
               <th>Request For</th>
               <th>Customer Name</th>
               <th>Surname</th>
               {{-- <th>Status</th> --}}
               <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $value)
            <tr>
               <td>{{ ++$i }}</td>
               <td>{{ $value->created_at }}</td>
               <td>{{ $value->header_business_name }}</td>
               <td>{{ $value->header_ref_no }}</td>
               <td>{{ get_direct_debit_form_customer_type($value->header_customer_req) }}</td>
               <td>{{ $value->main_customer_name }}</td>
               <td>{{ $value->main_customer_surname }}</td>
               {{-- <td><span class="label-custom label label-default">{{ get_status_label($value->status) }}</span></td> --}}
               <td>
                    <a href="{{ route('directdebitpdf', $value->id) }}" target="_blank" class="btn btn-add btn-sm"><i class="fa fa-file-pdf-o"></i></a>
                  {{-- <button type="button" class="btn btn-add btn-sm edit_this" edit_id="{{ $value->id }}"><i class="fa fa-pencil"></i></button> --}}
                  {{-- <button type="button" class="btn btn-danger btn-sm delete_this" delete_id="{{ $value->id }}"><i class="fa fa-trash-o"></i> </button> --}}
               </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}
</div>
