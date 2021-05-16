@extends('layouts.app')

@section('content')
    
    @extends('components.header', ['username' => Auth::user()->username])  
    
    <!-- Sign up form -->
    <section class="about" >
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-lg-6">
                  <h2>Team's TimeSheet</h2>                    
                </div>
                <div class="col-lg-6">
                  @include('timesheet.search-form')
                </div>
            </div>
            <table class="table table-bordered mt-2 text-center" id="ts-all">
                <thead>
                  <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Username</th>
                    @if(Auth::user()->hasRole('admin'))
                      <th scope="col">Team</th>
                    @endif
                    <th scope="col">Problems</th>
                    <th scope="col">Plan</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody id="search-timesheet-result">
                  @foreach ($timesheets as $item)
                    <tr>
                      <td>{{$item->created_at->format('d-M-y')}}</td>
                      <td>{{isset($item->user->username)? $item->user->username : 'N/A'}}</td>
                      @if(Auth::user()->hasRole('admin'))
                        <td>
                          {{$item->user->getCurTeams($item->user->id)}}
                        </td>
                      @endif
                      <td>{{isset($item->problems)? $item->problems : 'N/A'}}</td>
                      <td>{{isset($item->plan)? $item->plan : 'N/A'}}</td>
                      <td>
                        <a name="" id="timesheet-detail-btn" class="btn btn-outline-success" data-href="{{route('tasks.index', $item->id)}}" role="button">Detail</a>
                        <a class="btn btn-outline-warning" href="{{route('timesheets.edit', $item->id)}}" role="button">Edit</a>
                        <a href="">
                          <form action="{{route('timesheets.destroy', $item->id)}}" method="post"  >
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                          </form>
                        </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="detail-timesheet" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Detail</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="timesheet-content">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('script')
    <script>
      $(function () {
        $('#timesheet-detail-btn').click(function (e) { 
          e.preventDefault();
          var url = $(this).attr('data-href');
          $.ajax({
            url: url,
            method: 'GET',
            data: "data",
            success: function (data) {
              $('#detail-timesheet').modal('show');
              $('#timesheet-content').fadeIn();
              $('#timesheet-content').html(data);
            }
          });
        });

        $('#search-timesheet-btn').click(function (e) { 
          e.preventDefault();
          var usernameQuery  = $('#search-username').val(),
              startDateQuery = $('#search-startDate').val(),
              endDateQuery   = $('#search-endDate').val();
          var queries = [usernameQuery, startDateQuery, endDateQuery];
          $.ajax({
              url:"{{route('timesheets.search')}}", 
              method:"GET", 
              data:{queries:queries},
              success:function(data){ 
                $('#search-timesheet-result').fadeIn(); 
                $('#search-timesheet-result').html(data);
              }
          });
        });
      })
    </script>
@endsection