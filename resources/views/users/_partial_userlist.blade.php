<div class="table-responsive">
    <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
        <thead class="back_table_color">
            <tr class="info">
               <th>No</th>
               <th>FullName</th>
               <th>Email</th>
               <th>Phone</th>
               <th>Commission %</th>
               <th>Roles</th>
               <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $user)
            <tr>
               <td>{{ ++$i }}</td>
               <td>{{ $user->name }}</td>
               <td>{{ $user->email }}</td>
               <td>{{ $user->phone == '' ? '-' : $user->phone }}</td>
               <td>{{ $user->commission == '' ? '-' : $user->commission }}</td>
               <td>
                @if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $v)
                       <span class="label-custom label label-default">{{ $v }}</span>
                    @endforeach
                @endif
               </td>
               <td>
                    @can('user-edit')
                    <button type="button" class="btn btn-add btn-sm edit_user" edit_id="{{ $user->id }}"><i class="fa fa-pencil"></i></button>
                    @endcan
                    @can('user-delete')
                    <button type="button" class="btn btn-danger btn-sm delete_user" delete_id="{{ $user->id }}"><i class="fa fa-trash-o"></i> </button>
                    @endcan
               </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}
</div>
