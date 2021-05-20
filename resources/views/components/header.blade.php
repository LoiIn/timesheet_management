@if(Auth::check())
<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container">

      <div class="logo float-left">
        <h1 class="text-light"><a href="index.html"><span>TSMana</span></a></h1>
      </div>

      <nav class="nav-menu float-right d-none d-lg-block">
        <ul>
          <li class="{{isset($nav_home) ? $nav_home : ''}}"><a href="{{route('home.index')}}">Home</a></li>
          <li class="drop-down {{isset($nav_timesheet) ? $nav_timesheet : ''}}">
            <a href="">Timesheet</a>
            <ul>
              <li><a href="{{route('timesheets.index')}}">Me</a></li>
              @if (Auth::user()->hasRole('manager'))
                <li><a href="{{route('timesheets.manage')}}">Teams</a></li>
              @endif   
              <li><a href="{{route('calendar.index')}}">Calendar</a></li> 
            </ul>
          </li>                         
          <li class="{{isset($nav_report) ? $nav_report : ''}}"><a href="{{route('reports.index')}}">Report</a></li>
          @if (empty($username))
            <li class="{{isset($nav_profile) ? $nav_profile : ''}}"><a href="{{route('login.index')}}">SignIn</a></li>
          @else
            <li class="drop-down {{isset($nav_profile) ? $nav_profile : ''}}">
                <a href="">{{ $username }}</a>
                <ul>
                <li><a href="{{route('user.index')}}">Profiles</a></li>
                <li><a href="{{route('logout')}}">SignOut</a></li>
                </ul>
            </li>   
          @endif       
        </ul>
      </nav><!-- .nav-menu -->

    </div>
</header><!-- End Header -->
@else 
{{route('login')}}
@endif
