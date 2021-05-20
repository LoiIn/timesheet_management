@extends('layouts.app')

@section('content')
    
    @extends('components.services')
    @extends('components.slidebar')
    @extends('components.header', ['username' => Auth::user()->username, 'nav_home' => 'active'])  
    
@endsection