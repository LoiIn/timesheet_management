@if(count($roles) == 2)
  <div class="form-group">
    <div class="form-check">
      <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="checked-role" value="admin" id="">
          admin
      </label>
    </div>
  </div>
@endif

@if(count($roles) == 1)
  <div class="form-group">
    <div class="form-check">
      <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="checked-role" value="admin" id="">
          admin
      </label>
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="checked-role" value="manager" id="">
          manager
      </label>
    </div>
  </div>
@endif

@foreach ($roles as $role)
<div class="form-group">
  <div class="form-check">
    <label class="form-check-label">
        <input type="checkbox" class="form-check-input" name="checked-role" id="" value="{{$role}}" checked>
        {{$role}}
    </label>
  </div>
</div>
@endforeach