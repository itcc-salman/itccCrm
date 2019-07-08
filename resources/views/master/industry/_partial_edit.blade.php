<div class="row">
    <div class="col-md-12">
      <form class="form-horizontal" id="edit_form">
        <div class="row">
           <!-- Text input-->
           <div class="col-md-12 form-group">
              <label class="control-label" for="create_name">Name</label>
              <input type="text" name="name" id="edit_name" placeholder="Name" value="{{ $data->name }}" class="form-control">
           </div>
           <div class="col-md-12 form-group">
                <label class="control-label">Status</label>
                <select name="status" id="mystatus" class="form-control">
                    <option value="">Select Status</option>
                    @foreach(get_status_fields() as $k => $v)
                        <option value="{{ $k }}" {{ $k == $data->status ? 'selected="selected"' : '' }}>{{ $v }}</option>
                    @endforeach
                </select>
           </div>
           <div class="col-md-12 form-group user-form-group">
              <div class="float-right">
                <input type="hidden" name="id" value="{{ $data->id }}">
                <button type="submit" class="btn btn-add btn-sm">Update</button>
              </div>
           </div>
        </div>
      </form>
    </div>
</div>
