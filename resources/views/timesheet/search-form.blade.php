<form action="timesheets.admin_show" id="search-form"> 
    @csrf
    @method('GET')
    <div class="row">
      <div class="col form-group">
        <input type="text" class="form-control" placeholder="Username">
      </div>
      <div class="col form-group">
        <input type="text" class="form-control choose_date" name="" id ="" placeholder="Choose date" value="{{old('end_date', isset($task->end_date) ? $task->end_date : '')}}">
      </div>
      <div class="col">
        <button type="submit" class="btn btn-outline-primary" form="search-form">Search</button>
      </div>      
    </div>
</form>
