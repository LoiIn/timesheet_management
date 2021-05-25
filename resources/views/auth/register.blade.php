@extends('auth.layout')

@section('auth-content')
      <!-- Sign up form -->
      <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Sign up</h2>
                    <form method="POST" class="register-form" id="register-form" enctype="multipart/form-data">
                        @csrf
                        @if(count($errors) > 0)
                            <div class="auth-card-alert-danger">
                                @foreach ($errors->all() as $err)
                                    {{$err}}<br>
                                @endforeach
                            </div>
                        @endif
                        @if(session('registerFail'))
                            <div class="auth-card-alert-danger">
                                {{session('registerFail')}}
                            </div>
                        @endif 
                        <div class="form-group">
                            <label for="username"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="username" id="username" placeholder="User Name" value="{{old('username', isset($user->username) ? $user->username : '')}}"/>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="Your Email" value="{{old('email', isset($user->email) ? $user->email: '')}}"/>
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
                            <input type="text" name="address" id="address" placeholder="Your address" value="{{old('address', isset($user->address) ? $user->address: '')}}"/>
                        </div>
                        <div class="form-group" style="overflow: unset !important">
                            <label for="birthday"><i class="zmdi zmdi-calendar"></i></label>
                            <input type="text" name="birthday" id="birthday" placeholder="Your birthday" value="{{old('birthday', isset($user->birthday) ? $user->birthday: '')}}">
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
@endsection