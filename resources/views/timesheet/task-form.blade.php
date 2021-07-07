<div class="col-lg-6">
    <h3 class="text-center">Existed</h3>
    <div class="form-group">
      <label for="">Choose task</label>
      <select class="form-control" name="" id="old-tasks-display">
        <option data-href="{{route('tasks.infor', 0)}}" value="0">----------</option>
        @foreach ($tasks as $task)
            <option data-href="{{route('tasks.infor', $task['id'])}}" value="{{$task['id']}}">{{$task['content']}}</option>
        @endforeach
      </select> 
    </div>
</div>
<div class="col-lg-6">
    <h3 class="text-center">New</h3>
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
            <label for="end_date">End date</label>
            <input type="text" class="form-control choose-date" name="end_date" id="end_date" placeholder="Choose end date of task" value="{{old('end_date', isset($task->end_date) ? $task->end_date : '')}}">
        </div>
    </form>
</div>
<div class="col-lg-12 text-center mt-3">
    <a class="btn btn-primary" href="{{route('timesheets.index')}}" role="button">Cancle</a>
    <button type="submit" class="btn btn-success" form="add-task-form">Save</button>
</div>

@section('script')
    <script>
      $(function () {
        $("#old-tasks-display").change(function (e) { 
            e.preventDefault();
            if(parseInt($(this).children("option:selected").val()) !== 0){
                var url = $(this).children("option:selected").attr("data-href");
                $.ajax({
                    type: "GET",
                    url: url,
                    data: "data",
                    success: function (data) {
                        $('#content').val(data.content); 
                        $('#end_date').val(data.end_date);
                    }
                });
            }
        });
      })
    </script>
@endsection