@if(Auth::check())
<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container">

      <div class="logo float-left">
        <h1 class="text-light"><a href="index.html"><span>TSMana</span></a></h1>
      </div>

      <nav class="nav-menu float-right d-none d-lg-block">
        <ul>
          <li class="active"><a href="{{route('home.index')}}">Home</a></li>
          <li><a href="{{route('timesheets.index')}}">Timesheet</a></li>          
          <li><a href="{{route('reports.index')}}">Report</a></li>
          @if (empty($username))
            <li><a href="{{route('login.index')}}">SignIn</a></li>
          @else
            <li class="drop-down">
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
