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

    <div class="modal fade" id="report-form-edit" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Change Roles</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="role-form-content">
                
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <a name="" id="save-change-role-btn" class="btn btn-primary" data-href = "" role="button">Save</a>
            </div>
          </div>
        </div>
      </div>
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

            $('.edit-role-btn').click(function (e) { 
                e.preventDefault();
                var url = $(this).attr('data-href');
                $('#save-change-role-btn').attr('data-href', url);
                $.ajax({
                    method: 'GET',
                    url: url,
                    data: "data",
                    success: function (data) {
                        $('#report-form-edit').modal('show');
                        $('#role-form-content').fadeIn(); 
                        $('#role-form-content').html(data);
                    }
                });
            });

            $('#save-change-role-btn').click(function (e) { 
                e.preventDefault();
                var _token = $('input[name="_token"]').val(),
                    roles = [],
                    $memberId = $('#save-change-role-btn').attr('name');
                var url = $(this).attr('data-href');
                $('input[name="checked-role"]:checked').each(function() {
                    roles.push(this.value);
                });
                $.ajax({
                    method: 'POST',
                    url: url,
                    data:  {queries: roles, _token:_token},
                    success: function (data) {
                       console.log(data);
                    }
                });
            });
        });
    </script>
@endsection