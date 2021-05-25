@extends('auth.layout')

@section('auth-content')
      <!-- reset form -->
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
                        @if(session('resetFail'))
                            <div class="auth-card-alert-danger">
                                {{session('resetFail')}}
                            </div>
                        @endif 
                        <div class="form-group">
                            <label for="password"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="password" placeholder="Your Password"/>
                        </div>
                        <div class="form-group">
                            <label for="re-password"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="re-password" id="re-password" placeholder="Repeat your password"/>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Save"/>
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="{{asset('assets/images/signup-image.jpg')}}" alt="sing up image"></figure>
                </div>
            </div>
        </div>
    </section>
@endsection