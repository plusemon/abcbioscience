@extends('frontend.layouts.app')
@section('title', 'Student Dashboard')
@section('content')

    <!--USER DASHBOARD-->
    <section class="user-dashboard py-4">
        <div class="container">
            <div class="dashboard-area d-flex bd-highlight">
                

          
            @include('frontend.studentdashboard.dashboardmenu')
         

              <div class="dashboard-main w-100 bd-highlight py-3">
                  <div class="dr-head dashboard-header">
                      <div class="ud-mobile">
                            <i class="fa fa-bars" id="ud-mobile-btn"></i> Profile Menu
                        </div>
                        <h6> Dashboard </h6>
                         
                    </div>
                    <div class="hr-body">
                    <div class="row">
                        

                        <div class="col-xs-12 col-ms-6 col-md-3 ">
                             <div class="itembox bg-success">
                                 <div class="itemboxbody">
                                      <h3>{{ $batchlist }}</h3>
                                      <p>Batch List</p>
                                 </div>
                                 <div class="itexboxlink">
                                     <a href="{{ route('student.batch.enroll') }}" title="">  See more <i class="fa fa-arrow-right"></i></a>
                                 </div>
                            </div>
                        </div>
                       <div class="col-xs-12 col-ms-6 col-md-3">
                             <div class="itembox bg-primary">
                                 <div class="itemboxbody">
                                      <h3>{{ $sheetsetting }}</h3>
                                      <p>Lecture Sheet</p>
                                 </div>
                                 <div class="itexboxlink">
                                     <a href="{{ route('student.sheet.available') }}" title="">  See more <i class="fa fa-arrow-right"></i></a>
                                 </div>
                            </div>
                    {{--      </div><div class="col-xs-12 col-ms-6 col-md-3">
                             <div class="itembox bg-info">
                                 <div class="itemboxbody">
                                      <h3>10</h3>
                                      <p>Batch List</p>
                                 </div>
                                 <div class="itexboxlink">
                                     <a href="" title="">  See more <i class="fa fa-arrow-right"></i></a>
                                 </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-ms-6 col-md-3">
                             <div class="itembox bg-warning">
                                 <div class="itemboxbody">
                                      <h3>10</h3>
                                      <p>Batch List</p>
                                 </div>
                                 <div class="itexboxlink">
                                     <a href="" title="">  See more <i class="fa fa-arrow-right"></i></a>
                                 </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-ms-6 col-md-3">
                             <div class="itembox bg-danger">
                                 <div class="itemboxbody">
                                      <h3>10</h3>
                                      <p>Batch List</p>
                                 </div>
                                 <div class="itexboxlink">
                                     <a href="" title="">  See more <i class="fa fa-arrow-right"></i></a>
                                 </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-ms-6 col-md-3">
                             <div class="itembox bg-dark ">
                                 <div class="itemboxbody">
                                      <h3>10</h3>
                                      <p>Batch List</p>
                                 </div>
                                 <div class="itexboxlink">
                                     <a href="" title="">  See more <i class="fa fa-arrow-right"></i></a>
                                 </div>
                            </div>
                        </div> <div class="col-xs-12 col-ms-6 col-md-3 ">
                             <div class="itembox bg-success">
                                 <div class="itemboxbody">
                                      <h3>10</h3>
                                      <p>Batch List</p>
                                 </div>
                                 <div class="itexboxlink">
                                     <a href="" title="">  See more <i class="fa fa-arrow-right"></i></a>
                                 </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-ms-6 col-md-3">
                             <div class="itembox bg-primary">
                                 <div class="itemboxbody">
                                      <h3>10</h3>
                                      <p>Batch List</p>
                                 </div>
                                 <div class="itexboxlink">
                                     <a href="" title="">  See more <i class="fa fa-arrow-right"></i></a>
                                 </div>
                            </div>
                        </div><div class="col-xs-12 col-ms-6 col-md-3">
                             <div class="itembox bg-info">
                                 <div class="itemboxbody">
                                      <h3>10</h3>
                                      <p>Batch List</p>
                                 </div>
                                 <div class="itexboxlink">
                                     <a href="" title="">  See more <i class="fa fa-arrow-right"></i></a>
                                 </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-ms-6 col-md-3">
                             <div class="itembox bg-warning">
                                 <div class="itemboxbody">
                                      <h3>10</h3>
                                      <p>Batch List</p>
                                 </div>
                                 <div class="itexboxlink">
                                     <a href="" title="">  See more <i class="fa fa-arrow-right"></i></a>
                                 </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-ms-6 col-md-3">
                             <div class="itembox bg-danger">
                                 <div class="itemboxbody">
                                      <h3>10</h3>
                                      <p>Batch List</p>
                                 </div>
                                 <div class="itexboxlink">
                                     <a href="" title="">  See more <i class="fa fa-arrow-right"></i></a>
                                 </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-ms-6 col-md-3">
                             <div class="itembox bg-dark ">
                                 <div class="itemboxbody">
                                      <h3>10</h3>
                                      <p>Batch List</p>
                                 </div>
                                 <div class="itexboxlink">
                                     <a href="" title="">  See more <i class="fa fa-arrow-right"></i></a>
                                 </div>
                            </div>
                        </div> --}}
                        

                    </div>


                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--END USER DASHBOARD-->



    @include('frontend.studentdashboard.mobilemenu')


@endsection



















