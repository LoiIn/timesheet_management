@extends('layouts.app')

@section('content')

    @extends('components.header', ['username' => Auth::user()->username])  
    <div class="main-content">
        <section class="about" >
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>Report</h2>
                    </div>
                </div>
                @if(Auth::user()->hasRole('admin'))
                    @include('report.search-form')
                @endif
                @include('report.report-table')
        </div>
    </section>
    </div> 
    @include('report.report-form')
@endsection