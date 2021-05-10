@extends('layouts.app')

@section('content')
    
    @extends('components.header', ['username' => Auth::user()->username])  
    
    <!-- Sign up form -->
    <section class="about" >
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-lg-6">
                    <h2>TimeSheet Management</h2>
                </div>
                <div class="col-lg-6 text-right">
                  @if(session('ts_action_fail'))
                    <div class="alert alert-danger">
                        {{session('ts_action_fail')}}
                    </div>
                  @endif 
                  <a name="" id="" class="btn btn-primary" href="{{route('timesheets.create')}}" role="button">Add TS</a>
                </div>
            </div>
            @if (Auth::user()->hasRole('admin'))
              <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    @include('timesheet.search_form')
                </div>
              </div>
            @endif
            <table class="table mt-2 text-center">
                <thead>
                  <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Task</th>
                    <th scope="col">Problems</th>
                    <th scope="col">Plan</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($timesheets as $item)
                    <tr>
                      <td>{{$item->created_at}}</td>
                      <td>
                          @php
                            $tasks = $ts_tasks[$item->id]
                          @endphp
                          @include('timesheet.task', ['tasks' => $tasks])
                          <a name="" id="" class="btn btn-primary" href="{{route('tasks.create', $item->id)}}" role="button">Add Task</a>
                      </td>
                      <td>{{$item->problems}}</td>
                      <td>{{$item->plan}}</td>
                      <td>
                          <a class="btn btn-info" href="{{route('timesheets.edit', $item->id)}}" role="button">Edit</a>
                          @if(Auth::user()->hasPermission('delete_timesheet'))
                            <form action="{{route('timesheets.destroy', $item->id)}}" method="post"  >
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn btn-outline-danger">Delete</button>
                            </form>
                          @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
    </section>
@endsection