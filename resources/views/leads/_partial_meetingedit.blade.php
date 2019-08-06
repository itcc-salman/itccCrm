<div class="modal-content">
    <form method="POST" id="meeting_form_edit">
        <div class="modal-header modal-header-primary">
           <h3><i class="fa fa-plus m-r-5"></i> Update Meeting</h3>
           <input type="hidden" name="id" value="{{ $data->id }}">
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body" id="edit_body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Sales Person</label>
                        @if($user_role_id == 1)
                        <select name="sales_person" id="sales_person" class="form-control sm-select">
                            <option value="">Select Sales Person</option>
                            @foreach( $users as $u )
                            <option value="{{ $u->id }}" {{ $u->id == $data->sales_person_id ? 'selected="selected"' : '' }}>{{ $u->name }}</option>
                            @endforeach
                        </select>
                        @else
                        <input type="hidden" name="sales_person" id="sales_person" value="{{ \Auth::id() }}">
                        <input type="text" readonly value="{{ \Auth::user()->name }}" class="form-control">
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" name="subject" id="subject" value="{{ $data->subject }}" class="form-control" placeholder="Subject">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="body">Note</label>
                        <textarea name="body" id="body" value="{{ $data->body }}" class="form-control" placeholder="Note"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="meeting_at">Meeting Date</label>
                        <input type="text" name="meeting_at" value="{{ $data->meeting_at }}" id="meeting_at" class="form-control datepicker" placeholder="DD/MM/YYYY">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="meeting_time">Meeting Time</label>
                        <input type="text" name="meeting_time" value="{{ $data->meeting_time }}" id="meeting_time_edit" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="meeting_status">Meeting Status</label>
                        <select name="meeting_status" id="meeting_status" class="form-control">
                            <option value="">Select</option>
                            @foreach( get_meeting_status() as $k => $v )
                            <option value="{{ $k }}" {{ $k == $data->meeting_status ? 'selected="selected"' : '' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="meeting_summary">Summary</label>
                        <textarea name="meeting_summary" id="meeting_summary" value="{{ $data->meeting_summary }}" class="form-control" placeholder="Summary"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Update</button>
           <button type="button" class="btn btn-danger float-left" data-dismiss="modal">Close</button>
        </div>
    </form>
 </div>
 <!-- /.modal-content -->
