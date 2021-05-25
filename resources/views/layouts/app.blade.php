{{-- @if(Auth::check()) --}}
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>TSMana - Home</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">

  <!-- Page CSS Files -->
  <link href="{{asset('assets/vendor/page/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/page/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/page/icofont/icofont.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/page/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/page/venobox/venobox.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/page/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/page/aos/aos.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('assets/fonts/material-icon/css/material-design-iconic-font.min.css')}}" rel="stylesheet">

  <!-- Data css -->
  <link rel="stylesheet" href="{{asset('assets/css/datepicker.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/datepicker.date.css')}}">

  <!-- Calendar css-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css"/>
</head>

<body>
    
    @yield('content')
    @include('components.footer')

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Page JS Files -->
  <script src="{{asset('assets/vendor/page/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('assets/vendor/page/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/vendor/page/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/page/jquery.easing/jquery.easing.min.js')}}"></script>
  <script src="{{asset('assets/vendor/page/php-email-form/validate.js')}}"></script>
  <script src="{{asset('assets/vendor/page/venobox/venobox.min.js')}}"></script>
  <script src="{{asset('assets/vendor/page/waypoints/jquery.waypoints.min.js')}}"></script>
  <script src="{{asset('assets/vendor/page/counterup/counterup.min.js')}}"></script>
  <script src="{{asset('assets/vendor/page/owl.carousel/owl.carousel.min.js')}}"></script>
  <script src="{{asset('assets/vendor/page/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('assets/vendor/page/aos/aos.js')}}"></script>
  
  <!-- Date JS -->
  {{-- <script src="{{asset('assets/vendor/others/popper.min.js')}}"></script> --}}
  <script src="{{asset('assets/vendor/others/picker.js')}}"></script>
  <script src="{{asset('assets/vendor/others/picker.date.js')}}"></script>
  <script src="{{asset('assets/vendor/others/picker.time.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>

  <!-- Calendar JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
  
  @yield('script')
  @yield('calendarScript')
  <script>
    // $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }});
  </script>

</body>

</html>
{{-- @else 
{{route('login')}}
@endif --}}