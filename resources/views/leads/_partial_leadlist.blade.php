<div class="table-responsive">
    <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
        <thead class="back_table_color">
            <tr class="info">
               <th>No</th>
               <th>FullName</th>
               <th>Company</th>
               <th>Suburb</th>
               <th>Contact Work</th>
               <th>Email</th>
               <th>Lead Status</th>
               <th>Sales Person</th>
               <th>Created Date</th>
               <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $value)
            <tr>
               <td>{{ ++$i }}</td>
               <td>{{ $value->first_name.' '.$value->last_name }}</td>
               <td>{{ $value->company_name }}</td>
               <td>{{ $value->suburb }}</td>
               <td>{{ $value->contact_work }}</td>
               <td>{{ $value->email }}</td>
               <td>{{ get_lead_status($value->lead_status) }}</td>
               <td>{{ $value->salesPerson->name }}</td>
               <td>{{ $value->created_at }}</td>
               <td>
                    <button type="button" class="btn btn-info btn-sm view_lead" view_id="{{ $value->id }}"><i class="fa fa-eye"></i></button>
                    @can('lead-edit')
                    <a href="{{ route('leadedit',$value->id) }}" class="btn btn-add btn-sm" edit_id="{{ $value->id }}"><i class="fa fa-pencil"></i></a>
                    @endcan
               </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}
</div>
