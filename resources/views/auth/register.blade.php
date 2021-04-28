<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TSMana - SignUp</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{asset('assets/fonts/material-icon/css/material-design-iconic-font.min.css')}}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/datepicker.date.css')}}">
</head>
<body>

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form" enctype="multipart/form-data">
                            @csrf
                            @if(count($errors) > 0)
                                <div class="auth-card-alert">
                                    @foreach ($errors->all() as $err)
                                        {{$err}}<br>
                                    @endforeach
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="username"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="username" placeholder="User Name"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Your Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re_password"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_password" id="re_password" placeholder="Repeat your password"/>
                            </div>
                            <div class="form-group">
                                <label for="address"><i class="zmdi zmdi-info"></i></label>
                                <input type="text" name="address" id="address" placeholder="Your address"/>
                            </div>
                            <div class="form-group" style="overflow: unset !important">
                                <label for="birthday"><i class="zmdi zmdi-calendar"></i></label>
                                <input type="text" name="birthday" id="birthday" placeholder="Your birthday">
                            </div>
                            <div class="form-group">
                                <label for="avatar"><i class="zmdi zmdi-image"></i></label>
                                <input type="file" name="avatar" id="avatar" style="width: 100% !important">
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="{{asset('assets/images/signup-image.jpg')}}" alt="sing up image"></figure>
                        <a href="{{route('login.index')}}" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/others/picker.js')}}"></script>
    <script src="{{asset('assets/vendor/others/picker.date.js')}}"></script>
    <script src="{{asset('assets/js/register.js')}}"></script>
</body>
</html>