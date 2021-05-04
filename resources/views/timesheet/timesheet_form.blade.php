<form method="POST" id="add-ts-form" enctype="multipart/form-data">
    @csrf
    @if(count($errors) > 0)
      <div class="alert alert-danger">
          @foreach ($errors->all() as $err)
              {{$err}}<br>
          @endforeach
      </div>
    @endif
    <div class="form-group">
      <label for="problems">Problems</label>
      <textarea class="form-control" id="problems" rows="3" name="problems">
        {{old('problems', isset($timesheet->problems) ? $timesheet->problems : '')}}
      </textarea>
    </div>
    <div class="form-group">
      <label for="plan">Plan</label>
      <textarea class="form-control" id="plan" rows="3" name="plan">
        {{old('plan', isset($timesheet->plan) ? $timesheet->plan : '')}}
      </textarea>
    </div>
    <div class="form-group text-center">
        <a class="btn btn-primary" href="{{route('timesheets.index')}}" role="button">Cancle</a>
        <button type="submit" class="btn btn-success">Save</button>
    </div>
</form>