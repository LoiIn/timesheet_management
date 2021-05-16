@foreach ($timesheets as $item)
    <tr>
        <td>{{$item->created_at->format('d-M-y')}}</td>
        <td>{{isset($item->user->username)? $item->user->username : 'N/A'}}</td>
        @if(Auth::user()->hasRole('admin'))
        <td>
            {{$item->user->getCurTeams($item->user->id)}}
        </td>
        @endif
        <td>{{isset($item->problems)? $item->problems : 'N/A'}}</td>
        <td>{{isset($item->plan)? $item->plan : 'N/A'}}</td>
        <td>
        <a name="" id="timesheet-detail-btn" class="btn btn-outline-success" data-href="{{route('tasks.index', $item->id)}}" role="button">Detail</a>
        <a class="btn btn-outline-warning" href="{{route('timesheets.edit', $item->id)}}" role="button">Edit</a>
        <a href="">
            <form action="{{route('timesheets.destroy', $item->id)}}" method="post"  >
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-outline-danger">Delete</button>
            </form>
        </a>
        </td>
    </tr>
@endforeach