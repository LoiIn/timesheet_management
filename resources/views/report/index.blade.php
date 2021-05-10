@extends('layouts.app')

@section('content')
    
    @extends('components.header', ['username' => Auth::user()->username])  
    @include('report.report_table')
    @include('report.report_form_edit');
@endsection