{{-- @if(Auth::check()) --}}
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

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

  <script>
    $('#search-btn').click(function (e) { 
      e.preventDefault();
      var usernameQuery = $('#search-username').val(),
          roleQuery     = $('#search-role select').find(":selected").val(),
          monthQuery    = $('#search-month select').find(":selected").val(),
          querys =[usernameQuery, roleQuery, monthQuery];
      console.log(querys);
      var _token = $('input[name="_token"]').val(); 
      $.ajax({
        url:"{{route('search')}}", 
        method:"POST", 
        data:{querys:querys, _token:_token},
        success:function(data){ 
          $('#search-report-result').fadeIn(); 
          $('#search-report-result').html(data);
        }
      });
    });

    $('#ts-all-btn').click(function (e) { 
      e.preventDefault();
      $.ajax({
        url:"{{route('timesheets.admin-index')}}", 
        method:"GET", 
        success:function(data){ 
          $('#ts-all').fadeIn(); 
          $('#ts-all').html(data);
        }
      });
    });

    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

</body>

</html>
{{-- @else 
{{route('login')}}
@endif --}}