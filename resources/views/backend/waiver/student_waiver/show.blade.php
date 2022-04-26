@extends('backend.layouts.app')
@section('title','Show Student')
@section('content')
 <div id="content" class="content">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Show Student   </h4>
                    <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand">
                                <i class="fa fa-expand"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload">
                            <i class="fa fa-redo"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse">
                            <i class="fa fa-minus"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove">
                            <i class="fa fa-times"></i>
                            </a>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">

                        
                        <tr>
                            <th width="10%">Name</th>
                            <td width="40%">
                                 {{$student->students?$student->students->user?$student->students->user->name:NULL:NULL}}
                            </td>
                            <th width="10%">Student ID</th>
                            <td width="40%">
                                {{$student->students?$student->students->user?$student->students->user->useruid:NULL:NULL}}
                            </td>
                        </tr>
                        <tr>
                            <th width="10%">Father</th>
                            <td width="40%">{{$student->students?$student->students->user?$student->students->user->studentInfo?$student->students->user->studentInfo->father:NULL:NULL:NULL}}</td>
                            <th width="10%">Mother</th>
                            <td width="40%">{{$student->students?$student->students->user?$student->students->user->studentInfo?$student->students->user->studentInfo->mother:NULL:NULL:NULL}}</td>
                        </tr>

                        <tr>
                            <th width="10%">Own Mobile</th>
                            <td width="40%">{{$student->students?$student->students->user?$student->students->user->studentInfo?$student->students->user->studentInfo->own_mobile:NULL:NULL:NULL}}</td>
                            <th width="10%">Email</th>
                            <td width="40%">{{ $student->user?$student->user->email:'' }}</td>
                        </tr>
                        <tr>
                            <th>Class</th>
                            <td>{{ $student->classes?$student->classes->name:NULL }}</td>
                            <th> Session</th>
                            <td>{{ $student->sessiones?$student->sessiones->name:NULL }}</td>
                        </tr>
                        <tr>
                            <th>Batch</th>
                            <td>{{ $student->batchsetting?$student->batchsetting->batch_name:NULL }}</td>
                            <th>Roll</th>
                            <td>{{ $student->students?$student->students->roll:NULL }}</td>
                        </tr>
                        <tr>
                            <th>Admission Date</th>
                            <td>{{ $student->students?$student->students->admission_date:NULL }}</td>

                            <th>Admission Month</th>
                            <td>{{ $student->students?$student->students->month?$student->students->month->name:NULL:NULL }}</td>
                        </tr>

                        <tr>
                            <th>Student Type</th>
                            <td>
                                {{ $student->students?$student->students->studentype?$student->students->studentype->name:NULL:NULL }}
                            </td>
                            <th width="10%">Status</th>
                            <td width="40%">
                                 @if($student->students?$student->students->activate_status:NULL ==1)
                                <p class="btn btn-primary btn-sm">Active</p>
                                @elseif($student->students?$student->students->activate_status:NULL ==2)
                                <p class="btn btn-warning btn-sm">Deactive</p>
                                @elseif($student->students?$student->students->activate_status:NULL ==0)
                                <p class="btn btn-danger btn-sm">Deleted</p>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th colspan="4">
                                Student Waiver Information 
                            </th>
                        </tr>
                        <tr>
                            <th width="10%">Fee Category</th>
                            <td width="40%">{{ $student->feeCategories?$student->feeCategories->name:NULL }}</td>
                            <th width="10%">Waiver</th>
                            <td width="40%">{{ $student->waivers?$student->waivers->name:NULL }}</td>
                        </tr>
                        <tr>
                            <th width="10%">Fee Category Amount</th>
                            <td width="40%">{{ $student->feeAmountSettings?$student->feeAmountSettings->amount:NULL }}</td>
                            <th width="10%">Waiver Value (Amoun)</th>
                            <td width="40%">
                                @php
                                   $waiver =  $student->waivers?$student->waivers->amount:0;
                                   $waiver_type_id =$student->waiver_type_id;
                                   $feeAmount = $student->feeAmountSettings?$student->feeAmountSettings->amount:0;
                                   $waiver_discount = 0;
                                   if($waiver_type_id == 1)
                                   {
                                        $waiver_discount = ($feeAmount * $waiver) / 100 ;
                                   }

                                @endphp
                                {{ number_format($feeAmount - $waiver_discount,2,'.','') }} <br/>
                                (Waiver Amount : {{number_format($waiver_discount,2,'.','')}})
                            </td>
                        </tr>
                        <tr>
                            <th width="10%">Start Month</th>
                            <td width="40%">{{ $student->startMonth?$student->startMonth->name:NULL }}</td>
                            <th width="10%">End Month</th>
                            <td width="40%">{{ $student->endMonth?$student->endMonth->name:NULL }}</td>
                        </tr>

                        
                        <tr>
                            <th width="10%">Created By</th>
                            <td width="40%"> {{ $student->createdBy?$student->createdBy->name:NULL }} </td>
                            <th width="10%">Status</th>
                            <td width="40%">
                                @if($student->activate_status == 1)
                                <p class="btn btn-primary btn-sm">Active</p>
                                @elseif($student->activate_status == 2)
                                <p class="btn btn-warning btn-sm">Deactive</p>
                                @elseif($student->activate_status == 0)
                                <p class="btn btn-danger btn-sm">Deleted</p>
                                @endif
                            </td>
                        </tr>
                         <tr>
                            <th colspan="4">
                                <a href="{{route('admin.student-waiver.index')}}" class="btn btn-sm btn-primary pull-right" > Back </a>
                            </th>
                        </tr>




                    </table>
                </div>
            </div>
        </div>



@section('customjs')




@endsection
@endsection
