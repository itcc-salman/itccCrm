<div class="table-responsive">
    <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
        <thead class="back_table_color">
            <tr class="info">
               <th>No</th>
               <th>Sales Person Name</th>
               <th>Subject</th>
               <th>Note</th>
               <th>Meeting Date / Time</th>
               <th>Status</th>
               <th>Summary</th>
               <th>Created Date</th>
               @if( !$hide )
               <th>Action</th>
               @endif
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach ($data as $key => $value)
            <tr>
               <td>{{ $i++ }}</td>
               <td>{{ $value->salesPerson->name }}</td>
               <td>{{ $value->subject }}</td>
               <td>{{ $value->body }}</td>
               <td>{{ $value->meeting_at }} {{ $value->meeting_time }}</td>
               <td>{{ get_meeting_status($value->meeting_status) }}</td>
               <td>{{ $value->meeting_summary }}</td>
               <td>{{ $value->created_at }}</td>
               @if( !$hide )
               <td>
                  <button type="button" class="btn btn-add btn-sm edit_this" data-toggle="tooltip" title="@lang('lang.edit')" edit_id="{{ $value->id }}"><i class="fa fa-pencil"></i></button>
               </td>
               @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
