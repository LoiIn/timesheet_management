<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                @if (Auth::user()->hasRole('admin'))
                <th scope="col">STT</th>
                @endif
                <th scope="col">Month</th>
                <th scope="col">Username</th>
                <th scope="col">Role(s)</th>
                <th scope="col">Requested</th>
                <th scope="col">Out of date</th>
                @if (Auth::user()->hasRole('admin'))
                <th scope="col">More</th>
                @endif
                </tr>
            </thead>
            <tbody class="search-result">
                @foreach ($reports as $report)
                    <tr>
                        @if (Auth::user()->hasRole('admin'))
                            <th scope="row">{{$report['stt']}}</th>
                        @endif
                        <th scope="row">{{$report['month']}}</th>
                        <td>
                            <div class="row">
                                <div class="col-lg-8">
                                    <span>{{$report['username']}}</span>
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
                                    <span>{{$report['roles']}}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-lg-8">
                                    <span>{{$report['regris_time']}}</</span>
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
                                    <span>{{$report['regris_late_time']}}</span>
                                </div>
                                <div class="col-lg-3 offset-lg-1 text-right">
                                    <a name="" id="" class="btn btn-default" href="#" role="button">
                                        <i class="fas fa-chevron-down"></i>
                                    </a>
                                </div>
                            </div>
                        </td>
                        @if (Auth::user()->hasRole('admin'))
                            <td>
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <a name="" id="" class="btn btn-outline-danger" href="#" role="button" data-toggle="modal" data-target="#report-form-edit">Edit Roles</a>
                                        <a name="" id="" class="btn btn-success" href="{{route('members.index', ['member_id' => $report['stt']])}}" role="button">Profiles</a>
                                    </div>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
