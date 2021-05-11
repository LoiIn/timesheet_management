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
                        @php
                            $avatar = $member->avatar
                        @endphp
                        <img src="{{getAvatarUrl($avatar)}}" class="img-fluid" alt="">
                        </div>
                        <div class="col-lg-6 pt-4 pt-lg-0 offset-lg-1">
                        <h3>Profiles</h3>
                        <ul>
                            <li>
                                <i class="icofont-check-circled"></i>
                                <span>{{$member->username}}</span>
                            </li>
                            <li>
                                <i class="icofont-check-circled"></i>
                                <span>{{$member->email}}</span>
                            </li>
                            <li>
                                <i class="icofont-check-circled"></i>
                                <span>{{$member->address}}</span>
                            </li>
                            <li>
                                <i class="icofont-check-circled"></i>
                                <span>{{$member->birthday}}</span>
                            </li>
                        </ul>
                        @if(session('user-action-fail'))
                            <div class="alert alert-danger">
                                {{session('user-action-fail')}}
                            </div>
                        @endif 
                        <form action="{{route('members.destroy', $member->id)}}" method="post"  >
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->


    
@endsection