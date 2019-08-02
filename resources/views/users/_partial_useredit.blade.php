<div class="row">
    <div class="col-md-12">
      <form class="form-horizontal" id="edit_user">
        <div class="row">
           <!-- Text input-->
           <div class="col-md-12 form-group">
              <label class="control-label" for="create_name">FullName</label>
              <input type="text" name="name" id="edit_name" placeholder="FullName" value="{{ $user->name }}" class="form-control">
           </div>
           <!-- Text input-->
           <div class="col-md-12 form-group">
              <label class="control-label">Email</label>
              <input type="email" id="edit_email" readonly autocomplete="new-password" value="{{ $user->email }}" placeholder="Email" class="form-control">
           </div>
           <div class="col-md-12 form-group">
                <label class="control-label" for="phone">Phone</label>
                <input type="text" name="phone" id="phone" autocomplete="new-password" value="{{ $user->phone }}" placeholder="Phone" onkeypress="return isNumberOrSpaceKey(event)" class="form-control">
           </div>
           <div class="col-md-12 form-group">
                <label class="control-label" for="commission">Commission %</label>
                <input type="text" name="commission" id="commission" autocomplete="new-password" value="{{ $user->commission }}" placeholder="Commission" onkeypress="return isNumberKey(event)" class="form-control">
           </div>
           {{-- <div class="col-md-12 form-group">
              <label class="control-label">Password</label>
              <input type="password" name="password" autocomplete="new-password" id="create_password" placeholder="Password" class="form-control">
           </div>
           <div class="col-md-12 form-group">
              <label class="control-label">Confirm Password</label>
              <input type="password" name="confirm-password" autocomplete="new-password" id="create_confirm_password" placeholder="Confirm Password" class="form-control">
           </div> --}}
           <div class="col-md-12 form-group">
              <label class="control-label">Role</label>
              <select name="roles" id="edit_roles" class="form-control">
                 <option value="">Select Role</option>
                 @foreach($roles as $role)
                 <option value="{{ $role }}" {{ $role == $userRole ? 'selected="selected"' : '' }}>{{ $role }}</option>
                 @endforeach
              </select>
           </div>
           <div class="col-md-12 form-group user-form-group">
              <div class="float-right">
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <button type="submit" class="btn btn-add btn-sm">Update</button>
              </div>
           </div>
        </div>
      </form>
    </div>
</div>
