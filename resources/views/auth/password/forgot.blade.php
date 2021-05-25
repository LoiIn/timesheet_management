@extends('auth.layout')

@section('auth-content')
      <!-- forgot  Form -->
      <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="{{asset('assets/images/signin-image.jpg')}}" alt="sing up image"></figure>
                </div>

                <div class="signin-form">
                    @if(count($errors) > 0)
                        <div class="auth-card-alert-danger">
                            @foreach ($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif
                    @if(session('getFail'))
                        <div class="auth-card-alert-danger">
                            {{session('getFail')}}
                        </div>
                    @endif 
                    @if(session('getSuccess'))
                        <div class="auth-card-alert-success">
                            {{session('getSuccess')}}
                        </div>
                    @endif 
                    <h2 class="form-title">Reset password</h2>
                    <form method="POST" class="register-form" id="reset-pass-form">
                        @csrf
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email material-icons-name"></i></label>
                            <input type="text" name="email" id="email" placeholder="Email to get Password" />
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit" value="Send"/>
                        </div>
                        <div class="form-group">
                            <a name="" id="" class="button sign-in-btn" href="{{route('login.index')}}" role="button">Log in</a>
                            <a name="" id="" class="button sign-up-btn" href="{{route('register.index')}}" role="button">SignUp</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection