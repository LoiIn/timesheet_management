<thead>
    <tr>
      <th scope="col" rowspan="2">Date</th>
      <th scope="col" colspan="3">Task</th>
      <th scope="col" rowspan="2">Problems</th>
      <th scope="col" rowspan="2">Plan</th>
      <th scope="col" rowspan="2">Actions</th>
    </tr>
    <tr>
      <th scope="col" >Content</th>
      <th scope="col" >End-date</th>
      <th scope="col" >Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($timesheets as $item)
      <tr>
        <td rowspan="{{count($ts_tasks[$item->id]) + 1}}">{{$item->created_at}}</td>
        <td colspan="3">
          <a name="" id="" class="btn btn-primary" href="{{route('tasks.create', $item->id)}}" role="button">Add Task</a>
        </td>
        <td rowspan="{{count($ts_tasks[$item->id]) + 1}}">{{$item->problems}}</td>
        <td rowspan="{{count($ts_tasks[$item->id]) + 1}}">{{$item->plan}}</td>
        <td rowspan="{{count($ts_tasks[$item->id]) + 1}}">
          <a class="btn btn-outline-warning" href="{{route('timesheets.edit', $item->id)}}" role="button">Edit</a>
          @if(Auth::user()->hasPermission('delete_timesheet'))
            <form action="{{route('timesheets.destroy', $item->id)}}" method="post"  >
              @csrf
              @method('delete')
              <button type="submit" class="btn btn-outline-danger">Delete</button>
            </form>
          @endif
        </td>
      </tr>
      @foreach ($ts_tasks[$item->id] as $task)
        <tr>
          <td>{{$task->content}}</td>
          <td>{{$task->end_date}}</td>
          <td>
            <a name="" id="" class="btn btn-outline-warning" href="{{route('tasks.edit', ['ts_id'=>$item->id, 'id'=>$task->id])}}" role="button">Edit</a>
            <form action="{{route('tasks.destroy', ['ts_id'=>$item->id, 'id'=>$task->id])}}" method="post"  >
              @csrf
              @method('delete')
              <button type="submit" class="btn btn-outline-danger">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
    @endforeach
  </tbody>