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
                    <div class="col-md-12">
                        @if($unpaidpayments->count()>0)
                          <div class="table-responsive">
                                <table id="" class="table table-striped table-bordered table-td-valign-middle" style="margin-top:10px;">
                                    <thead>
                                        <tr>
                                            
                                            <th class="text-nowrap">Class</th>
                                            <th class="text-nowrap">Session</th>
                                            <th class="text-nowrap">Batch</th>
                                            <th class="text-nowrap">Due <br/> Month</th>
                                            <th class="text-nowrap">Amount</th>
                                            <th class="text-nowrap">Fee Type</th>
                                            <th class="text-nowrap">Notification Date</th>
                                            <th class="text-nowrap">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($unpaidpayments as $collection)
                                            <tr>
                                               
                                                <td>
                                                    {{ $collection->classes?$collection->classes->name:NULL }}
                                                </td>
                                                <td>
                                                    {{ $collection->sessiones?$collection->sessiones->name:NULL }}
                                                </td>
                                                <td>
                                                    {{ $collection->batchsetting?$collection->batchsetting->batch_name:NULL }}
                                                </td>
                                                <td>
                                                    {{ $collection->months?$collection->months->name:NULL }}
                                                </td>
                                                <td>
                                                    {{ $collection->amount }}
                                                </td>
                                                <td>
                                                    {{$collection->feeCategores?$collection->feeCategores->name:NULL}}
                                                </td>
                                                <td>
                                                    {{Date('d-m-Y h:i A',strtotime($collection->created_at))}}
                                                </td>

                                                <td>
                                                    @if($collection->status==1)
                                                   <p class="btn btn-success btn-sm">Paid</p>
                                                   @elseif($collection->status==3)
                                                   <p class="btn btn-warning btn-sm">Verify Pending</p>
                                                   @else
                                                   <p class="btn btn-danger btn-sm">Unpaid</p>
                                                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModal_{{ $collection->id }}"> <i class="fa fa-money-bill"></i> Make Payment</a>
                                                  
                                                   
                                                    
                                                        
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal_{{ $collection->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                 <p class="text-danger p-5"> <b>Pls. Send money through  Personal Number - 
                                                                 <br> (1) 01705597641 (bkash)  or
                                                                 <br> (2) 01835889878 (bkash & Nagad)</b></p>
                                                                
                                                                <form action="{{ route('student.make.payment',$collection->id) }}" method="post">
                                                                @csrf
                                                                  <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Make Payment</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                      <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                    <label class="text-danger"> <b>Payment</b>  </label>
                                                                    <select class="form-control " name="payment_method_id" required>
                                                                        <option value="">Please Select Payment Method</option>
                                                                        @php
                                                                            $paymentmethods = App\Model\PaymentMethod::whereIn('id',[2,3,9])->get();
                                                                        
                                                                        @endphp
                                                                        
                                                                        
                                                                        @foreach($paymentmethods as $method)
                                                                        <option value="{{ $method->id }}"> {{ $method->method }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                  
                                                                    <br>
                                                                    <input type="text" class="form-control" name="transaction_id" value="" placeholder="Enter Transaction ID/Mobile Number" required>
                                                                    <div class="text-danger">  {{ $errors->first('transaction_id') }} </div>
                                                                   
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                                  </div>
                                                               </form>
                                                            </div>
                                                          </div>
                                                        </div>
                                                                                                           
                                                    @endif
                                                    
                                                   
                                                   
                                                   
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                          </div>  
                          @else
 
                          @endif
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
                        <div class="widget widget-stats bg-green">
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
                        <div class="widget widget-stats bg-red">
                            <div class="stats-icon"><i class="fa fa-money-bill"></i></div>
                                <div class="stats-info">
                                    <h4>Total Unpaid Amount</h4>
                                    <p> {{ $unpaidpaymenthistories }} </p>
                                </div>
                                <div class="stats-link">
                                    <a href="{{ route('student.payment.history') }}">View Detail  </a>
                                </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="widget widget-stats bg-info">
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
                                    <h4>Upcomming Written Test</h4>
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
                                    <h4>Total Written Questions</h4>
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