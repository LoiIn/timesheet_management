<form method="POST" id="add-task-form" enctype="multipart/form-data">
    @csrf
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $err)
                {{$err}}<br>
            @endforeach
        </div>
    @endif
    @if(session('task-action-fail'))
        <div class="alert alert-danger">
            {{session('task-action-fail')}}
        </div>
    @endif 
    <div class="form-group">
      <label for="timesheet">Created date of Timesheet</label>
      <input type="text" class="form-control" id="" placeholder="" value="2021-04-30" readonly name="ts">
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <input type="text" class="form-control" id="content" placeholder="Put content for new task" name="content" value="{{old('content', isset($task->content) ? $task->content : '')}}">
    </div>
    <div class="form-group">
        <label for="end_date"><i class="col-form-label"></i></label>
        <input type="text" class="form-control choose_date" name="end_date" id="end_date" placeholder="Choose end date of task" value="{{old('end_date', isset($task->end_date) ? $task->end_date : '')}}">
    </div>
    <div class="form-group text-center">
        <a class="btn btn-primary" href="{{route('timesheets.index')}}" role="button">Cancle</a>
        <button type="submit" class="btn btn-success">Save</button>
    </div>
</form>