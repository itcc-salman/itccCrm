<div class="row">
    <div class="col-md-12">
      <form class="form-horizontal" id="edit_form" enctype="multipart/form-data">
        <div class="row">
           <!-- Text input-->
           <div class="col-md-12 form-group">
              <label class="control-label" for="create_name">Upload Document</label>
              <input type="file" name="document" id="document_edit" class="filestyle">
              <p class="text-danger f-s-12">Only PDF allowed</p>
           </div>
           <div class="col-md-12 form-group">
                <label class="control-label">Document Type</label>
                <select name="document_type" id="document_type" class="form-control">
                    <option value="">Select Document Type</option>
                    @foreach(get_document_types() as $k => $v)
                        <option value="{{ $k }}" {{ $k == $data->document_type ? 'selected="selected"' : '' }}>{{ $v }}</option>
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
