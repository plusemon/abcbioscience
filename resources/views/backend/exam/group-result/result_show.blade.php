@extends('backend.layouts.app')
@section('title', 'Show Exam Results')
@section('content')

<div id="content" class="content">
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">Show Exam Results</h4>
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


                  <div class="bg-light border py-2 text-center">
                       
                        @if($group->mcq_exam_type==1)
                        
                        <h4>MCQ Question Name :  {{ $group->mcqexamsetting->mcqQuestionSubjects->question_no }} </h4>
                        <h4> Topic :  {{ $group->mcqexamsetting->mcqQuestionSubjects->topic }} </h4>
                        <h4>Exam hold on : {{ date('d-m-Y h:i A',strtotime($group->mcqexamsetting->exam_start_date_time ))}}  </h4>
                        
                        @elseif($group->mcq_exam_type==2)
                        
                        <h4>MCQ Question Name :  {{ $group->offlinemcqexamsetting->OfflineMcqQuestionSubjects->question_no }} </h4>
                        <h4> Topic :  {{ $group->offlinemcqexamsetting->OfflineMcqQuestionSubjects->topic }} </h4>
                        <h4>Exam hold on : {{ date('d-m-Y h:i A',strtotime($group->offlinemcqexamsetting->exam_start_date_time ))}}  </h4>
                        <h4>Total Mark :{{ $group->offlinemcqexamsetting->OfflineMcqQuestionSubjects->total_mark }} </h4>
                        @endif

                        <h4>Written Question Name :  {{ $group->writtenexamsetting->writtenQuestionSubjects->question_no }} </h4>
                        <h4> Topic :  {{ $group->writtenexamsetting->writtenQuestionSubjects->topic }} </h4>
                        <h4>Exam hold on : {{ date('d-m-Y h:i A',strtotime($group->writtenexamsetting->exam_start_date_time ))}}  </h4>
                        <h4>Total Mark : {{ $group->writtenexamsetting->writtenQuestionSubjects->total_mark }} </h4>
                 </div>






            <form action="{{ route('admin.result.group.update',$group->id) }}"  method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="mcqtotalmark" value="{{ $group->mcq_exam_total_mark }}">
                <input type="hidden" name="writtentotalmark" value="{{ $group->written_exam_total_mark  }}">
                <input type="hidden" name="totalmark" value="{{ $group->mcq_exam_total_mark + $group->written_exam_total_mark }}">
                            
            <table class="table table-hovered table-bordered table-td-valign-middle">
                <thead>
                    <tr>
                        <th class="text-nowrap">Sl No</th>
                        <th class="text-nowrap">Student ID</th>
                        <th class="text-nowrap">Student Name</th>
                        <th class="text-nowrap">Mobile</th>
                        <th class="text-nowrap">MCQ</th>
                        <th class="text-nowrap">Written</th>
                        <th class="text-nowrap">Total</th>
                        <th>SMS</th>
                        
                    </tr>
                </thead>
                <tbody>
                     
                    @foreach($students as $student)

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $student->user?$student->user->useruid:'' }}

                                <input type="hidden" name="student_id[]" value="{{ $student->id }}">


                            </td>
                            <td>{{ $student->user?$student->user->name:'' }}</td>
                            <td>{{ $student->user?$student->user->mobile:'' }}</td>

 
 
 
                             @php

                                    $total = 0;
                                    $mcq = 0;
                                    $written = 0;

                                    $totalmark = $group->mcq_exam_total_mark + $group->written_exam_total_mark;


                                    $resultcount = App\Model\McqExamStudentAnsSummary::where('student_id',$student->id)
                                                                                ->where('class_id',$student->class_id)
                                                                                ->where('session_id',$student->session_id)
                                                                                ->where('batch_setting_id',$student->batch_setting_id)
                                                                                ->where('mcq_exam_setting_id',$group->mcq_exam_setting_id)
                                                                                ->count();

                                    $result = App\Model\McqExamStudentAnsSummary::where('student_id',$student->id)
                                                                                ->where('class_id',$student->class_id)
                                                                                ->where('session_id',$student->session_id)
                                                                                ->where('batch_setting_id',$student->batch_setting_id)
                                                                                ->where('mcq_exam_setting_id',$group->mcq_exam_setting_id)
                                                                                ->first();
                                                                                
                                                                                
                                    $offlineMcqcount  =  App\Models\OfflineMcqExamResult::where('student_id',$student->id)
                                                                        ->where('class_id',$student->class_id)
                                                                        ->where('session_id',$student->session_id)
                                                                        ->where('batch_setting_id',$student->batch_setting_id)
                                                                        ->where('exam_setting_id',$group->offlinemcq_exam_setting_id)
                                                                        ->count();                                
                                                                        
                                    $offlinemcqresult = App\Models\OfflineMcqExamResult::where('student_id',$student->id)
                                                                        ->where('class_id',$student->class_id)
                                                                        ->where('session_id',$student->session_id)
                                                                        ->where('batch_setting_id',$student->batch_setting_id)
                                                                        ->where('exam_setting_id',$group->offlinemcq_exam_setting_id)
                                                                        ->first();      
                                                                                


                                    $writtencount = App\Models\WrittenExamResult::where('student_id',$student->id)
                                                                        ->where('class_id',$student->class_id)
                                                                        ->where('session_id',$student->session_id)
                                                                        ->where('batch_setting_id',$student->batch_setting_id)
                                                                        ->where('exam_setting_id',$group->written_exam_setting_id)
                                                                        ->count();



                                    $writtenresult = App\Models\WrittenExamResult::where('student_id',$student->id)
                                                                        ->where('class_id',$student->class_id)
                                                                        ->where('session_id',$student->session_id)
                                                                        ->where('batch_setting_id',$student->batch_setting_id)
                                                                        ->where('exam_setting_id',$group->written_exam_setting_id)
                                                                        ->first();

                                @endphp









                            @if($group->mcq_exam_type==1)
                            
                            {{-- mcq Exam --}}

                            <td>

                               
                                @if($resultcount>0)
                                    @php
                                     $mcqabsent = 0;
                                    @endphp
                                    {{ $mcq =  $result->mcqexamanssummery->where('result',1)->count() }}  
                                    <input type="hidden" name="mcq[]" value="{{ $mcq }}">
                                   
                                @else
                                    <span class="text-danger">   Absent  </span>
                                    @php
                                     $mcqabsent = 1;
                                    @endphp
                                    <input type="hidden" name="mcq[]" value="Absent">
                                @endif
                                
                            </td>
                            
                            @elseif($group->mcq_exam_type==2)  
                            
                            {{-- Offline MCQ  --}}
                         
                            <td>
                                
 
                                @if($offlineMcqcount>0)
                                    @if($offlinemcqresult->result== null)
                                     <span class="text-warning">     Result Not Publish    </span> 
                                    @else
                                    {{ $mcq = $offlinemcqresult->result }} 
                                    <input type="hidden" name="mcq[]" value="{{ $mcq }}">
                                    @endif
                                     @php
                                     $mcqabsent = 0;
                                    @endphp
                                @else
                                    @php
                                     $mcqabsent = 1;
                                    @endphp
                                    <span class="text-danger">   Absent  </span>
                                    <input type="hidden" name="mcq[]" value="Absent">
                                @endif


                            </td>
                         @endif
                         
                            {{-- written exam --}}
                            <td>
                                


                                @if($writtencount>0)
                                    @if($writtenresult->result== null)
                                     <span class="text-warning">     Result Not Publish    </span> 
                                    @else
                                    {{ $written = $writtenresult->result }} 
                                    <input type="hidden" name="written[]" value="{{ $written = $writtenresult->result }}">
                                    @endif
                                     @php
                                     $writtentabsent = 0;
                                    @endphp
                                @else
                                    @php
                                     $writtentabsent = 1;
                                    @endphp
                                    <span class="text-danger">   Absent  </span>
                                    <input type="hidden" name="written[]" value="Absent">
                                @endif


                            </td>


                            <td>
                                
                                @if($mcqabsent==1 && $writtentabsent==1)
                                    <span class="text-danger">   Absent  </span>
                                    <input type="hidden" name="result[]" value="Absent">
                                @else

                                    @if( $total = $mcq + $written ==0)
                                        00 Out of {{ $totalmark }}

                                        <input type="hidden" name="result[]" value="00">

                                    @else

                                    {{  $total = $mcq + $written  }}   Out of {{ $totalmark }}


                                    <input type="hidden" name="result[]" value="{{  $total = $mcq + $written  }}">

                                    @endif

                                @endif
                              

                            </td>
                            <td>
                                <select name="sms[]">
                                    <option value="No">NO</option>
                                    <option value="Yes">Yes</option>
                                    
                                </select>
                            </td>
                        </tr>

                    @endforeach
                    <tr>
                        <td> <button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-check"></i> Submit</button> </td>
                    </tr>

                    
                </tbody>
            </table>

            </form>
        </div>
        
    </div>

</div>
</div>

@endsection
 