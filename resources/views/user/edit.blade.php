@extends('layouts.app')

@section('content')
    
    @extends('components.header', ['username' => Auth::user()->username])  
    
    <!-- Sign up form -->
    <section class="about" >
        <div class="container">
            <div class="about-content">
                <div class="about-form">
                    <div class="row">
                        <div class="col-lg-6">
                            <h2 class="about-title">Edit</h2>
                            <form method="POST" class="edit-form" id="edit-form" enctype="multipart/form-data" action="{{route('user.update')}}">
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
                                    <input type="text" name="username" id="username" placeholder="User Name" value="{{Auth::user()->username}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="email"><i class="zmdi zmdi-email"></i></label>
                                    <input type="email" name="email" id="email" placeholder="Your Email" value="{{Auth::user()->email}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="address"><i class="zmdi zmdi-info"></i></label>
                                    <input type="text" name="address" id="address" placeholder="Your address" value="{{Auth::user()->address}}"/>
                                </div>
                                <div class="form-group" style="overflow: unset !important">
                                    <label for="birthday"><i class="zmdi zmdi-calendar"></i></label>
                                    <input type="text" name="birthday" id="birthday" placeholder="Your birthday" value="{{Auth::user()->birthday}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="re_avatar"><i class="zmdi zmdi-image"></i></label>
                                    <input type="file" name="re_avatar" id="re_avatar" class="img-fluid">
                                </div>
                                <div class="form-group form-button">
                                    <button type="submit" class="btn btn-success" form="edit-form">Save</button>
                                    <a name="" id="" class="btn btn-primary" href="{{route('user.edit_pass')}}" role="button" >Change Pass</a>
                                    <a href="{{route('user.index')}}" class="btn btn-danger" role="button">Cancle</a>
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-6">
                            <div class="about-image text-center">
                                @php
                                    $avatar = Auth::user()->avatar
                                @endphp
                                <img src="{{getAvatarUrl($avatar, $type = 'edit')}}" alt="sing up image">
                            </div>
                        </div>
                    </div>
                </div>
                    
               
            </div>
        </div>
    </section>
@endsection