@extends('layouts.app')

@section('content')
    
    @extends('components.header', ['username' => Auth::user()->username])  
    @include('report.report-table')
    @include('report.report-form');
@endsection