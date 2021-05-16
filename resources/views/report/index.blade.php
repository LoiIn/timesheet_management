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

@section('script')
    <script>
        $(function () {
            $('#search-btn').click(function (e) { 
            e.preventDefault();
            var usernameQuery = $('#search-username').val(),
                roleQuery     = $('#search-role select').find(":selected").val(),
                monthQuery    = $('#search-month select').find(":selected").val(),
                queries =[usernameQuery, roleQuery, monthQuery];
            var _token = $('input[name="_token"]').val(); 
            $.ajax({
                url:"{{route('reports.search')}}", 
                method:"POST", 
                data:{queries:queries, _token:_token},
                success:function(data){ 
                $('#search-report-result').fadeIn(); 
                $('#search-report-result').html(data);
                }
            });
            });
        });
    </script>
@endsection