@extends('layouts.app')

@section('content')
    
    @extends('components.header', ['username' => Auth::user()->username])  
    
    <!-- ======= About Section ======= -->
    <section class="about" data-aos="fade-up">
        <div class="container">
            <div class="about-content">
                <div class="about-form">
                    <div class="row">
                        <div class="col-lg-4">
                        @if(empty(Auth::user()->avatar))
                            <img src="source/images/avatar/man.jpg" class="img-fluid" alt="">
                        @else
                            <img src="source/images/avatar/{{Auth::user()->avatar}}" class="img-fluid" alt="">   
                        @endif
                        </div>
                        <div class="col-lg-6 pt-4 pt-lg-0 offset-lg-1">
                        <h3>Profiles</h3>
                        <ul>
                            <li>
                                <i class="icofont-check-circled"></i>
                                <span>{{Auth::user()->username}}</span>
                            </li>
                            <li>
                                <i class="icofont-check-circled"></i>
                                <span>{{Auth::user()->email}}</span>
                            </li>
                            <li>
                                <i class="icofont-check-circled"></i>
                                <span>{{Auth::user()->address}}</span>
                            </li>
                            <li>
                                <i class="icofont-check-circled"></i>
                                <span>{{Auth::user()->birthday}}</span>
                            </li>
                        </ul>
                        <a name="" id="" class="btn btn-primary" href="{{route('user_edit_profiles')}}" role="button">Edit</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->


    
@endsection

{{-- @include('user.profiles', ['user' => Auth::user()]) --}}
{{-- @include('user.edit_profiles', ['user' => Auth::user()]) --}}