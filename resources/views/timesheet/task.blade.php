<table class="table table-bordered text-center">
    <thead>
      <tr>
        <th scope="col">Task ID</th>
        <th scope="col">Content</th>
        <th scope="col">End-date</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($tasks as $task)
        <tr>
          <th scope="row">{{$task->id}}</th>
          <td>{{$task->content}}</td>
          <td>{{$task->end_date}}</td>
        </tr>
      @endforeach
    </tbody>
</table>