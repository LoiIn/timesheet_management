<table class="table table-striped text-center">
    <thead>
      <tr>
        <th scope="col">Task ID</th>
        <th scope="col">Content</th>
        <th scope="col">Time exist</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($tasks as $task)
        <tr>
          <th scope="row">{{$task->id}}</th>
          <td>{{$task->content}}</td>
          <td>{{$task->time_exist}}</td>
          <td>
              <button type="button" class="btn btn-warning">Edit</button>
              <button type="button" class="btn btn-danger">Remove</button>
          </td>
        </tr>
      @endforeach
    </tbody>
</table>