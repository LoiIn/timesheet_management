@foreach ($reports as $row)
<tr>
    <th scope="row">{{$row['stt']}}</th>
    <th scope="row">{{$row['month']}}</th>
    <td>
        <div class="row">
            <div class="col-lg-8">
                <span>{{$row['username']}}</span>
            </div>
            <div class="col-lg-3 offset-lg-1 text-right">
                <a name="" id="" class="btn btn-default" href="#" role="button">
                    <i class="fas fa-chevron-down"></i>
                </a>
            </div>
        </div>
    </td>
    <td>
        <div class="row">
            <div class="col-lg-8">
                <span>{{$row['roles']}}</span>
            </div>
        </div>
    </td>
    <td>
        <div class="row">
            <div class="col-lg-8">
                <span>{{$row['regris_time']}}</</span>
            </div>
            <div class="col-lg-3 offset-lg-1 text-right">
                <a name="" id="" class="btn btn-default" href="#" role="button">
                    <i class="fas fa-chevron-down"></i>
                </a>
            </div>
        </div>
    </td>
    <td>
        <div class="row">
            <div class="col-lg-8">
                <span>{{$row['regris_late_time']}}</span>
            </div>
            <div class="col-lg-3 offset-lg-1 text-right">
                <a name="" id="" class="btn btn-default" href="#" role="button">
                    <i class="fas fa-chevron-down"></i>
                </a>
            </div>
        </div>
    </td>
    <td>
        <div class="row">
            <div class="col-lg-12 text-center">
                <a name="" id="" class="btn btn-outline-danger" href="#" role="button" data-toggle="modal" data-target="#report-form-edit">Edit Roles</a>
                <a name="" id="" class="btn btn-success" href="{{route('members.index', ['member_id'=>$row['stt']])}}" role="button">Profiles</a>
                <a name="" id="" class="btn btn-outline-primary" href="#" role="button">Export</a>
            </div>
        </div>
    </td>
</tr>
@endforeach