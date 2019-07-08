<div class="row">
    <div class="col-md-12">
      <form class="form-horizontal" id="edit_role">
        <div class="row">
           <!-- Text input-->
           <div class="col-md-12 form-group">
              <label class="control-label" for="create_name">Name</label>
              <input type="text" name="name" id="create_name" value="{{ $role->name }}" autocomplete="new-password" placeholder="Name" class="form-control">
           </div>
           <!-- Text input-->
           <div class="col-md-12 form-group">
                <label class="control-label">Permission</label>
                <div class="row">
                    @foreach($permission as $value)
                    <div class="col-md-6">
                        <div class="i-check">
                            <input tabindex="{{ $value->id }}" {{ in_array($value->id, $rolePermissions) ? 'checked="checked"' : false }} type="checkbox" id="permission_{{ $value->id }}" name="permission[]" value="{{ $value->id }}">
                            <label for="permission_{{ $value->id }}">{{ $value->name }}</label>
                        </div>
                    </div>
                    @endforeach
                </div>
           </div>
           <div class="col-md-12 form-group user-form-group">
              <div class="float-right">
                <input type="hidden" name="role_id" value="{{ $role->id }}">
                <button type="submit" class="btn btn-add btn-sm">Update</button>
              </div>
           </div>
        </div>
      </form>
    </div>
</div>
