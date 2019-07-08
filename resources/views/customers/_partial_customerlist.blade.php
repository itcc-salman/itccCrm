<div class="table-responsive">
    <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
        <thead class="back_table_color">
            <tr class="info">
               <th>No</th>
               <th>Name</th>
               <th>Email</th>
               <th>Suburb</th>
               <th>Contact Work</th>
               <th>Mobile</th>
               <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $value)
            <tr>
               <td>{{ ++$i }}</td>
               <td>{{ $value->getCustomerFullName() }}</td>
               <td>{{ $value->email }}</td>
               <td>{{ $value->suburb }}</td>
               <td>{{ $value->contact_work }}</td>
               <td>{{ $value->contact_mobile }}</td>
               <td>
                  <button type="button" class="btn btn-info btn-sm view_customer" view_id="{{ $value->id }}"><i class="fa fa-eye"></i></button>
                  @can('customer-edit')
                  <a href="{{ route('customeredit',$value->id) }}" class="btn btn-add btn-sm" edit_id="{{ $value->id }}"><i class="fa fa-pencil"></i></a>
                  @endcan
                  @can('customer-delete')
                  <button type="button" class="btn btn-danger btn-sm delete_customer" delete_id="{{ $value->id }}"><i class="fa fa-trash-o"></i> </button>
                  @endcan
               </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}
</div>
