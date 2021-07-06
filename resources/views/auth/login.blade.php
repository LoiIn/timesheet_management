@extends('auth.layout')

@section('auth-content')
      <!-- Sing in  Form -->
      <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="{{asset('assets/images/signin-image.jpg')}}" alt="sing up image"></figure>
                    <a href="{{route('register.index')}}" class="signup-image-link">Create an account</a>
                </div>

                <div class="signin-form">
                    @if(count($errors) > 0)
                        <div class="auth-card-alert-danger">
                            @foreach ($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif
                    @if(session('loginFail'))
                        <div class="auth-card-alert-danger">
                            {{session('loginFail')}}
                        </div>
                    @endif 
                    @if(session('registerSuccess'))
                        <div class="auth-card-alert-success">
                            {{session('registerSuccess')}}
                        </div>
                    @endif 
                    @if(session('resetSuccess'))
                        <div class="auth-card-alert-success">
                            {{session('resetSuccess')}}
                        </div>
                    @endif 
                    <h2 class="form-title">Sign In</h2>
                    <form method="POST" class="register-form" id="login-form">
                        @csrf
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email material-icons-name"></i></label>
                            <input type="text" name="email" id="email" placeholder="Email" />
                        </div>
                        <div class="form-group">
                            <label for="password"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="password" placeholder="Password"/>
                        </div>
                        <div class="form-group">
                            <a href="{{route('forgot.index')}}" class="a-tag">Forgor password</a>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                        </div>
                    </form>
                    <div class="social-login">
                        <span class="social-label">Or login with</span>
                        <ul class="socials">
                            <li><a href="{{route('login.facebook')}}"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                            <li><a href="{{route('login.google')}}"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection