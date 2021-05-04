@extends('layouts.app')

@section('content')
  @extends('components.header', ['username' => Auth::user()->username]) 
  <section class="about" >
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <h2>Edit Task</h2>
            </div>
        </div>
        @include('timesheet.task_form')
    </div>
</section>
@endsection