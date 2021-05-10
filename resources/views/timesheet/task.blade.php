<table class="table table-striped text-center">
    <thead>
      <tr>
        <th scope="col">Task ID</th>
        <th scope="col">Content</th>
        <th scope="col">End-date</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($tasks as $task)
        <tr>
          <th scope="row">{{$task->id}}</th>
          <td>{{$task->content}}</td>
          <td>{{$task->end_date}}</td>
          <td>
              <a name="" id="" class="btn btn-outline-warning" href="{{route('tasks.edit', ['ts_id'=>$item->id, 'id'=>$task->id])}}" role="button">Edit</a>
              {{-- <button type="button" class="btn btn-danger">Remove</button> --}}
              <form action="{{route('tasks.destroy', ['ts_id'=>$item->id, 'id'=>$task->id])}}" method="post"  >
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-outline-danger">Delete</button>
              </form>
          </td>
        </tr>
      @endforeach
    </tbody>
</table>