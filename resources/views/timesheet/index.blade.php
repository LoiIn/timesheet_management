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
                    <button type="button" class="btn btn-primary">Add TS</button>
                </div>
            </div>
            <table class="table table-striped mt-2 text-center">
                <thead>
                  <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Date</th>
                    <th scope="col">Task</th>
                    <th scope="col">Problems</th>
                    <th scope="col">Plan</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>2021-04-28</td>
                    <td>
                        @include('timesheet.task')
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-task" data-whatever="">Add Task</button>
                        @include('timesheet.add_task')
                    </td>
                    <td>@mdo</td>
                    <td>abc</td>
                    <td>
                        
                        <button type="button" class="btn btn-info">Edit</button>
                    </td>
                  </tr>
                </tbody>
              </table>
        </div>
    </section>
@endsection