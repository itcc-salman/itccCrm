<div class="table-responsive">
    <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
        <thead class="back_table_color">
            <tr class="info">
               <th>No</th>
               <th>Name</th>
               <th>Type</th>
               {{-- <th>Status</th> --}}
               <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $value)
            <tr>
               <td>{{ ++$i }}</td>
               <td>{{ $value->document_name }}</td>
               <td>{{ get_document_types($value->document_type) }}</td>
               {{-- <td><span class="label-custom label label-default">{{ get_status_label($value->status) }}</span></td> --}}
               <td>
                  <button type="button" class="btn btn-add btn-sm edit_this" edit_id="{{ $value->id }}"><i class="fa fa-pencil"></i></button>
                  {{-- <button type="button" class="btn btn-danger btn-sm delete_this" delete_id="{{ $value->id }}"><i class="fa fa-trash-o"></i> </button> --}}
               </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}
</div>
