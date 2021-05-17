@extends('layouts.app')

@section('content')
    
    @extends('components.header', ['username' => Auth::user()->username])  
    
    <!-- Sign up form -->
    <section class="about" >
        <div class="container mt-5">
           <div class="row">
               <div class="col-lg-12">
                   Calendar
               </div>
           </div>
           <div class="row mt-5">
                <div class="col-lg-12" id="calendar">
                </div>
            </div>
        </div>
    </section>
@endsection

@section('calendarScript')
    <script>
         $(document).ready(function () {
            var calendarDom = $('#calendar');
            var calendar = new FullCalendar.Calendar(calendarDom, {
                initialView: 'dayGridMonth',
                events: [
                    @foreach($timesheets as $timesheet)
                    {
                    title: '{{ $timesheet->user->username }}',
                    start: '{{ $timesheet->created_at }}',
                    url: '{{ route('timesheets.edit', $timesheet->id) }}'
                    },
                    @endforeach
                ]
            });
            calendar.render();
        });
    </script>
@endsection