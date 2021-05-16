@extends('layouts.app')

@section('content')
    
    @extends('components.header', ['username' => Auth::user()->username])  
    
    <!-- Sign up form -->
    <section class="about" >
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-lg-6">
                  <h2>Your Timesheet</h2>                    
                </div>
                <div class="col-lg-6 text-right">
                  @if(session('ts-action-fail'))
                    <div class="alert alert-danger">
                        {{session('ts-action-fail')}}
                    </div>
                  @endif 
                  <a name="" id="" class="btn btn-outline-primary" href="{{route('timesheets.create')}}" role="button">Add TS</a>
                </div>
            </div>
            <table class="table table-bordered mt-2 text-center" id="ts-all">
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
                      <td rowspan="{{count($tasks[$item->id]) + 1}}">{{$item->created_at->format('d-M-y')}}</td>
                      <td colspan="3">
                        <a name="" id="" class="btn btn-primary" href="{{route('tasks.create', $item->id)}}" role="button">Add Task</a>
                      </td>
                      <td rowspan="{{count($tasks[$item->id]) + 1}}">{{isset($item->problems) ? $item->problems : 'N/A'}}</td>
                      <td rowspan="{{count($tasks[$item->id]) + 1}}">{{isset($item->plan) ? $item->plan : 'N/A'}}</td>
                      <td rowspan="{{count($tasks[$item->id]) + 1}}">
                        <a class="btn btn-outline-warning" href="{{route('timesheets.edit', $item->id)}}" role="button">Edit</a>
                        @if(Auth::user()->hasRole('admin'))
                          <form action="{{route('timesheets.destroy', $item->id)}}" method="post"  >
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                          </form>
                        @endif
                      </td>
                    </tr>
                    @foreach ($tasks[$item->id] as $task)
                      <tr>
                        <td>{{isset($task->content) ? $task->content : 'N/A'}}</td>
                        <td>{{isset($task->end_date) ? $task->end_date : 'N/A'}}</td>
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
              </table>
        </div>
    </section>
@endsection