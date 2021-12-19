@extends('students.layouts.app')
@section('title','Student Dashboard')
@section('content')


            <div id="content" class="content">

                 <div class="row">
                     <div class="col-xs-12">
                         <ol class="breadcrumb float-xl-left">
                            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                            <li class="breadcrumb-item">Student</li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                     </div>
                 </div>
                 <div class="row">

                    <div class="col-xl-3 col-md-6">
                        <div class="widget widget-stats bg-blue">
                            <div class="stats-icon"><i class="fa fa-users"></i></div>
                                <div class="stats-info">
                                    <h4><b>Total Batch</b></h4>
                                    <p>
                                        {{ $batchlist->count() }}
                                    </p>
                                </div>
                                <div class="stats-link">
                                    <a href="{{ route('student.batch.enroll') }}">View Detail</a>
                                    
                                </div>
                        </div>
                    </div>


                    <div class="col-xl-3 col-md-6">
                        <div class="widget widget-stats bg-info">
                            <div class="stats-icon"><i class="fa fa-file"></i></div>
                            <div class="stats-info">
                                <h4>Pending Attendance</h4>
                                <p> {{ $pending_attendances }} </p>
                            </div>
                            <div class="stats-link">
                             <a href="{{ route('student.attendance.pending') }}">View Detail</a>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-3 col-md-6">
                        <div class="widget widget-stats bg-info">
                            <div class="stats-icon"><i class="fa fa-file"></i></div>
                            <div class="stats-info">
                                <h4>Attendance History</h4>
                                <p> {{ $attendances }}  </p>
                            </div>
                            <div class="stats-link">
                             <a href="{{ route('student.attendance.history') }}">View Detail</a>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-3 col-md-6">
                        <div class="widget widget-stats bg-orange">
                            <div class="stats-icon"><i class="fa fa-money-bill"></i></div>
                                <div class="stats-info">
                                    <h4>Total Paid Amount</h4>
                                    <p> {{ $paymenthistories }} </p>
                                </div>
                                <div class="stats-link">
                                    <a href="{{ route('student.payment.history') }}">View Detail  </a>
                                </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="widget widget-stats bg-yellow">
                            <div class="stats-icon"><i class="fa fa-money-bill"></i></div>
                                <div class="stats-info">
                                    <h4>Upcomming Quiz Test</h4>
                                    <p> {{ $mcq_upcomming }} </p>
                                </div>
                                <div class="stats-link">
                                    <a href="{{route('student.exam.mcq.index')}}">View Detail  </a>
                                </div>
                            </div>
                        </div>

               

                    <div class="col-xl-3 col-md-6">
                        <div class="widget widget-stats bg-info">
                            <div class="stats-icon"><i class="fa fa-file"></i></div>
                            <div class="stats-info">
                                <h4>Total MCQ Question</h4>
                                <p> {{ $mcq_results }}  </p>
                            </div>
                            <div class="stats-link">
                                <a href="{{route('student.exam.mcq.history')}}">View Detail  </a>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-3 col-md-6">
                        <div class="widget widget-stats bg-orange">
                            <div class="stats-icon"><i class="fa fa-file"></i></div>
                                <div class="stats-info">
                                    <h4>Upcomming Written Quiz</h4>
                                    <p> {{ $written_upcomming }} </p>
                                </div>
                                <div class="stats-link">
                                    <a href="{{route('student.exam.written.index')}}">View Detail  </a>
                                </div>
                        </div>
                    </div>  


                    <div class="col-xl-3 col-md-6">
                        <div class="widget widget-stats bg-orange">
                            <div class="stats-icon"><i class="fa fa-file"></i></div>
                                <div class="stats-info">
                                    <h4>Total Written Quiz</h4>
                                    <p> {{ $written_results }} </p>
                                </div>
                                <div class="stats-link">
                                    <a href="{{route('student.exam.written.history')}}">View Detail  </a>
                                </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="widget widget-stats bg-orange">
                            <div class="stats-icon"><i class="fa fa-file"></i></div>
                                <div class="stats-info">
                                    <h4>Pending Home Works</h4>
                                    <p>{{ $homework_pending }}</p>
                                </div>
                                <div class="stats-link">
                                    <a href="{{ route('student.homework.pending') }}">View Detail  </a>
                                </div>
                        </div>
                    </div>  


                    <div class="col-xl-3 col-md-6">
                        <div class="widget widget-stats bg-orange">
                            <div class="stats-icon"><i class="fa fa-file"></i></div>
                                <div class="stats-info">
                                    <h4>Submitted Homeworks</h4>
                                    <p> {{ $homework_results }} </p>
                                </div>
                                <div class="stats-link">
                                    <a href="{{ route('student.homework.history') }}">View Detail  </a>
                                </div>
                        </div>
                    </div>


                    <div class="col-xl-3 col-md-6">
                        <div class="widget widget-stats bg-orange">
                            <div class="stats-icon"><i class="fa fa-file"></i></div>
                                <div class="stats-info">
                                    <h4>Available Sheet</h4>
                                    <p>{{ $sheetsetting }} </p>
                                </div>
                                <div class="stats-link">
                                    <a href="{{ route('student.sheet.available') }}">View Detail  </a>
                                </div>
                        </div>
                    </div>
 

            </div>
        </div>

@endsection