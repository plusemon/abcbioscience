@extends('backend.layouts.app')
@section('title','Dashboard')
@section('content')


<div id="content" class="content">

     <div class="row">
         <div class="col-xs-12">
             <ol class="breadcrumb float-xl-left">
                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
         </div>
     </div>
     <div class="row">

        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-blue">
                <div class="stats-icon"><i class="fa fa-users"></i></div>
                    <div class="stats-info">
                        <h4><b>Total Students</b></h4>
                        <p>
                            {{ $totalstudent }}
                        </p>
                    </div>
                    <div class="stats-link">
                        <a href="{{ route('student.index') }}">View Detail</a>
                        
                    </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-info">
                <div class="stats-icon"><i class="fa fa-file"></i></div>
                <div class="stats-info">
                    <h4>Today Attendance</h4>
                    <p> {{ $todayattendance }}</p>
                </div>
                <div class="stats-link">
                 <a href="{{ route('student.attendance.index') }}">View Detail</a>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-orange">
                <div class="stats-icon"><i class="fa fa-money-bill"></i></div>
                    <div class="stats-info">
                        <h4>Total Payment Received</h4>
                        <p> {{ $totalpaymentreceive }}</p>
                    </div>
                    <div class="stats-link">
                        <a href="{{ route('admin.fee-collection.index') }}">View Detail  </a>
                    </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-yellow">
                <div class="stats-icon"><i class="fa fa-money-bill"></i></div>
                    <div class="stats-info">
                        <h4> Total Today Payment Received</h4>
                        <p> {{ $todaytotalpaymentreceive }}</p>
                    </div>
                    <div class="stats-link">
                        <a href="{{ route('admin.fee-collection.index') }}">View Detail  </a>
                    </div>
                </div>
            </div>

        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-blue">
                <div class="stats-icon"><i class="fa fa-file"></i></div>
                    <div class="stats-info">
                        <h4>Total Sheet</h4>
                        <p>{{ $totalsheet }}</p>
                    </div>
                    <div class="stats-link">
                        <a href="{{ route('sheet.index') }}">View Detail</a>
                    </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-info">
                <div class="stats-icon"><i class="fa fa-file"></i></div>
                <div class="stats-info">
                    <h4>Total MCQ Question</h4>
                    <p> {{ $totalmcqquestion }}</p>
                </div>
                <div class="stats-link">
                    <a href="{{ route('admin.mcq.index') }}">View Detail  </a>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-orange">
                <div class="stats-icon"><i class="fa fa-file"></i></div>
                    <div class="stats-info">
                        <h4>Total Written Question</h4>
                        <p>{{ $totalwrittenquestion }}</p>
                    </div>
                    <div class="stats-link">
                        <a href="{{ route('written.question.index') }}">View Detail  </a>
                    </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-red">
                <div class="stats-icon"><i class="fa fa-envelope"></i></div>
                    <div class="stats-info">
                        <h4>Contact Us</h4>
                        <p>{{ $contacts }}</p>
                    </div>
                    <div class="stats-link">
                        <a href="{{ route('contact.index') }}">View Detail  </a>
                    </div>
                </div>
            </div>


        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-icon"><i class="fa fa-message"></i></div>
                    <div class="stats-info">
                        <h4>SMS Balance</h4>
                        <p> 

                            <?php
                                         
                                        $url = "http://66.45.237.70/balancechk.php?username=01818737845&password=BlackAzad&type=sms";
                                        $ch = curl_init(); // Initialize cURL
                                        curl_setopt($ch, CURLOPT_URL,$url);
                                        curl_setopt($ch, CURLOPT_ENCODING, '');
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
                                        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
                                        $smsresult = curl_exec($ch);
                                        $amount= $data['sms_balance'] = $smsresult;
                                       
                                       echo $amount;
                                       
                              ?>
                                         

                                     </p>
                    </div>
                    <div class="stats-link">
                        <a href="http://login.bulksmsbd.com/default.php"> Login SMS Panel</a>
                    </div>
                </div>
            </div>
            
            
            <div class="col-xl-3 col-md-6">
                <div class="widget widget-stats bg-red">
                    <div class="stats-icon"><i class="fa fa-users"></i></div>
                        <div class="stats-info">
                            <h4>Pending Student</h4>
                            <p>{{ $pendingstudents }}</p>
                        </div>
                        <div class="stats-link">
                            <a href="{{ route('student.pending.index') }}">View Detail  </a>
                        </div>
                </div>
            </div>
             
            <div class="col-xl-3 col-md-6">
                <div class="widget widget-stats bg-red">
                    <div class="stats-icon"><i class="fa fa-users"></i></div>
                        <div class="stats-info">
                            <h4>Non Enrolled User List</h4>
                            
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($studentusers as $user)
                            @if ($user->activestudents->count() ==  0)
                                @php $i++ @endphp       
                            @endif
                      @endforeach
                            
                            
                            <p>{{ $i }}</p>
                        </div>
                        <div class="stats-link">
                            <a href="{{ route('student.non.errol.users') }}">View Detail  </a>
                        </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="widget widget-stats bg-red">
                    <div class="stats-icon"><i class="fa fa-list"></i></div>
                        <div class="stats-info">
                            <h4> Total Batch</h4>
                             
                            <p>{{ $batchlist }}</p>
                        </div>
                        <div class="stats-link">
                            <a href="{{ route('batch.schedule.index') }}">View Detail  </a>
                        </div>
                </div>
            </div>
            
            

            </div>
        </div>

@endsection