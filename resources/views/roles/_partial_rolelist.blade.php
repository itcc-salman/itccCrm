<div class="table-responsive">
    <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
        <thead class="back_table_color">
            <tr class="info">
               <th>No</th>
               <th>Role Name</th>
               <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $key => $role)
            <tr>
               <td>{{ ++$i }}</td>
               <td>{{ $role->name }}</td>
               <td>
                  @can('role-edit')
                    <button type="button" class="btn btn-add btn-sm edit_role" edit_id="{{ $role->id }}"><i class="fa fa-pencil"></i></button>
                  @endcan
                  {{-- <button type="button" class="btn btn-danger btn-sm delete_role" delete_id="{{ $role->id }}"><i class="fa fa-trash-o"></i> </button> --}}
               </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $roles->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}
</div>