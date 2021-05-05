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
              
              <div class="row mt-5">
                <div class="col-lg-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Month</th>
                            <th scope="col">Username</th>
                            <th scope="col">Requested</th>
                            <th scope="col">Out of date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $report)
                                <tr>
                                    <th scope="row">{{$report['stt']}}</th>
                                    <th scope="row">{{$report['month']}}</th>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <span>{{$report['username']}}</span>
                                            </div>
                                            <div class="col-lg-3 offset-lg-1 text-right">
                                                <a name="" id="" class="btn btn-default" href="#" role="button">
                                                    <i class="fas fa-chevron-down"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <span>{{$report['regris_time']}}</</span>
                                            </div>
                                            <div class="col-lg-3 offset-lg-1 text-right">
                                                <a name="" id="" class="btn btn-default" href="#" role="button">
                                                    <i class="fas fa-chevron-down"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <span>{{$report['regris_late_time']}}</span>
                                            </div>
                                            <div class="col-lg-3 offset-lg-1 text-right">
                                                <a name="" id="" class="btn btn-default" href="#" role="button">
                                                    <i class="fas fa-chevron-down"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
              </div>
          </div>
      </section>
    </div>
    
@endsection