<form action="timesheets.admin_show" id="search-form"> 
    @csrf
    <div class="row">
      <div class="col form-group">
        <input id="search-username" type="text" class="form-control" placeholder="Username">
      </div>
      <div class="col form-group">
        <input id="search-startDate" type="text" class="form-control choose-date" name="" id ="" placeholder="Choose startdate" value="">
      </div>
      <div class="col form-group">
        <input id="search-endDate" type="text" class="form-control choose-date" name="" id ="" placeholder="Choose end date" value="">
      </div>
      <div class="col">
        <a name="" id="search-timesheet-btn" class="btn btn-outline-primary" href="#" role="button">Search</a>
      </div>      
    </div>
</form>
