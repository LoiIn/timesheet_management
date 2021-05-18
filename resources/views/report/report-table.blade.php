<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered">
            <thead class="text-center">
                <tr>
                @if (Auth::user()->hasRole('admin'))
                <th scope="col">ID</th>
                @endif
                <th scope="col">Month</th>
                <th scope="col">Username</th>
                @if (Auth::user()->hasRole('admin'))
                    <th scope="col">Role(s)</th>
                @endif
                <th scope="col">Requested</th>
                <th scope="col">Out of date</th>
                @if (Auth::user()->hasRole('admin'))
                <th scope="col">More</th>
                @endif
                </tr>
            </thead>
            <tbody id="search-report-result">
                @foreach ($reports as $report)
                    <tr>
                        @if (Auth::user()->hasRole('admin'))
                            <th scope="row">{{$report->user_id}}</th>
                        @endif
                        <th scope="row">{{$report->month}}</th>
                        <td>
                            <div class="row">
                                <div class="col-lg-8">
                                    <span>{{$report->user->username}}</span>
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
                                <div class="col-lg-8 change-role-result">
                                    <span>{{convertRolesArrayToString($report->user->roles()->pluck('name')->toArray())}}</span>
                                </div>
                            </div>
                        </td>
                        @endif
                        <td>
                            <div class="row">
                                <div class="col-lg-8">
                                    <span>{{$report->registrations_times}}</</span>
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
                                    <span>{{$report->registrations_late_times}}</span>
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
                                        <a data-id="{{$report->user_id}}" id="" class="btn btn-outline-danger edit-role-btn" data-href="{{route('members.edit_role', ['member_id' => $report->user_id])}}" role="button" data-toggle="modal" data-target="#report-form-edit">Edit Roles</a>
                                        <a name="" id="" class="btn btn-success" href="{{route('members.index', ['member_id' => $report->user_id])}}" role="button">Profiles</a>
                                        <a class="btn btn-outline-primary" href="{{ route('export', ['member_id' => $report->user_id]) }}">Export</a>
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
