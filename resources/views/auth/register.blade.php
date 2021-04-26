<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TSMana - SignUp</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="source/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="source/css/login.css">
    <link rel="stylesheet" href="source/css/datepicker.css">
    <link rel="stylesheet" href="source/css/datepicker.date.css">
</head>
<body>

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="new_username"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="new_username" id="new_username" placeholder="User Name"/>
                            </div>
                            <div class="form-group">
                                <label for="new_email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="new_email" id="new_email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="new_password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="new_password" id="new_password" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"/>
                            </div>
                            <div class="form-group">
                                <label for="address"><i class="zmdi zmdi-info"></i></label>
                                <input type="text" name="address" id="address" placeholder="Enter your address"/>
                            </div>
                            <div class="form-group" style="overflow: unset !important">
                                <label for="birthday"><i class="zmdi zmdi-calendar"></i></label>
                                <input type="text" id="birthday" placeholder="Your birthday">
                            </div>
                            <div class="form-group">
                                <label for="avatar"><i class="zmdi zmdi-image"></i></label>
                                <input type="file"  id="avatar">
                            </div>
                            {{-- <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div> --}}
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="source/images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="{{route('login.index')}}" class="signup-image-link" style="margin-top: 170px">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="source/vendor/jquery/jquery.min.js"></script>
    <script src="source/vendor/others/picker.js"></script>
    <script src="source/vendor/others/picker.date.js"></script>
    <script src="source/js/main.js"></script>
</body>
</html>