@extends('backend.layouts.app')
@section('title', 'Show Student')
@section('content')
    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Student Information</h4>
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
                        <th colspan="4">Student User Information</th>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $student->user ? $student->user->name : '' }}</td>
                        <th rowspan="2">Image</th>
                        <td rowspan="2"> <img src="{{ asset($student->user->image) }}" alt="" width="50"></a> </td>
                    </tr>

                    <tr>
                        <th>Mobile</th>
                        <td>{{ $student->user ? $student->user->mobile : '' }}</td>



                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $student->user ? $student->user->address : '' }}</td>

                        <th width="10%">School Name</th>
                        <td width="40%"> {{-- {{ $student->user?$student->user->school_name:NULL }} --}} </td>
                    </tr>

                    <tr>
                        <th>Section</th>
                        <td>{{ $student->user ? $student->user->section_id : '' }}</td>

                        <th width="10%">Roll</th>
                        <td width="40%"> {{ $student->user ? $student->user->roll : null }} </td>
                    </tr>


                    <tr>
                        <th colspan="4">
                            Student Personal Information

                            {{-- <a href="{{ route('admin.promotion-class.create','student_id='.$student->user->id) }}" class="btn btn-primary btn-sm pull-right">
                                    <i class="fa fa-check"></i> 
                                    Promotion
                                </a> --}}
                        </th>
                    </tr>
                    <tr>
                        <th width="10%">Student ID</th>
                        <td width="40%">{{ $student->user->useruid }}</td>
                        <th width="10%">Name</th>
                        <td width="40%">{{ $student->user->name }}</td>
                    </tr>

                    <tr>
                        <th width="10%">Father Name</th>
                        <td width="40%">{{ $student->user->studentInfo ? $student->user->studentinfo->father : '' }}</td>
                        <th width="10%">Mother</th>
                        <td width="40%">{{ $student->user->studentinfo ? $student->user->studentinfo->mother : '' }}</td>
                    </tr>

                    <tr>
                        <th width="10%">Guardian Mobile</th>
                        <td width="40%">
                            {{ $student->user->studentinfo ? $student->user->studentinfo->guardian_mobile : '' }}
                        </td>
                        <th width="10%">Own Mobile</th>
                        <td width="40%">{{ $student->user->studentinfo ? $student->user->studentinfo->own_mobile : '' }}
                        </td>
                    </tr>
                    <tr>
                        <th width="10%">Email</th>
                        <td width="40%">{{ $student->user->studentinfo ? $student->user->studentinfo->email : '' }}</td>
                        <th width="10%">Whatsapp</th>
                        <td width="40%">
                            {{ $student->user->studentinfo ? $student->user->studentinfo->whatsapp_number : '' }}
                        </td>
                    </tr>

                    <tr>
                        <th width="10%">facebook Id Link</th>
                        <td width="40%"> <a
                                href="{{ $student->user->studentinfo ? $student->user->studentinfo->facebook_id : '' }}"
                                target="_blank">Facebook</a> </td>
                        <th width="10%">Bkash Number</th>
                        <td width="40%">
                            {{ $student->user->studentinfo ? $student->user->studentinfo->bkash_number : '' }}
                        </td>
                    </tr>
                    <tr>
                        <th width="10%">Note</th>
                        <td width="40%">{{ $student->user->studentinfo ? $student->user->studentinfo->notes : '' }} </td>
                        <th width="10%">Address</th>
                        <td width="40%">{{ $student->user->studentinfo ? $student->user->studentinfo->address : '' }}
                        </td>
                    </tr>
                    <tr>
                        <th width="10%">School Name</th>
                        <td width="40%"> {{-- {{ $student->user->students?$student->user->students->school_name:NULL }} --}} </td>
                        <th width="10%">Status</th>
                        <td width="40%">
                            @if ($student->status == 1)
                                <p class="btn btn-primary btn-sm">Active</p>
                            @elseif($student->status == 2)
                                <p class="btn btn-warning btn-sm">Pending</p>
                            @elseif($student->status == 0)
                                <p class="btn btn-danger btn-sm">Deleted</p>
                            @endif
                        </td>
                    </tr>


                    <tr>
                        <th colspan="4">Academic Information</th>
                    </tr>
                    <tr>
                        <th>Class</th>
                        <td>{{ $student->classes ? $student->classes->name : null }}</td>
                        <th> Session</th>
                        <td>{{ $student->sessiones ? $student->sessiones->name : null }}</td>
                    </tr>
                    <tr>
                        <th>Batch</th>
                        <td>{{ $student->batchsetting ? $student->batchsetting->batch_name : null }}</td>
                        <th>Batch Type</th>
                        <td>{{ $student->batchTypes ? $student->batchTypes->name : null }}</td>
                    </tr>
                    <tr>
                        <th>Roll</th>
                        <td>{{ $student->roll }}</td>
                    </tr>
                    <tr>
                        <th>Admission Date</th>
                        <td>{{ $student->admission_date }}</td>

                        <th>Start Month</th>
                        <td>{{ $student->month ? $student->month->name : null }}</td>
                    </tr>

                    <tr>
                        <th>Student Type</th>
                        <td>
                            {{ $student->studentype ? $student->studentype->name : null }}
                        </td>
                        <th width="10%">Status</th>
                        <td width="40%">
                            @if ($student->activate_status == 1)
                                <p class="btn btn-primary btn-sm">Active</p>
                            @elseif($student->activate_status ==2)
                                <p class="btn btn-warning btn-sm">Deactive</p>
                            @elseif($student->activate_status ==0)
                                <p class="btn btn-danger btn-sm">Deleted</p>
                            @endif
                        </td>
                    </tr>



                </table>
            </div>
        </div>
        {{-- mcq exam history --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">MCQ Exam History </h4>
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
                <table class="table table-bordered table-hovered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Exam</th>
                            <th>Subject</th>
                            <th>Batch</th>
                            <th>Class</th>
                            <th>Session</th>
                            <th>Total Mark</th>
                            <th>Result</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mcq_results as $answer)
                            <tr>
                                <td>{{ $answer->created_at->format('d-m-Y') }}</td>
                                <td>{{ optional($answer->mcqQuestionSubjects)->question_no }}</td>
                                <td>{{ $answer->subjects->name }}</td>

                                <td> {{ $answer->batchsetting->batch_name }}</td>
                                <td> {{ $answer->classes->name }}</td>

                                <td> {{ $answer->sessiones->name }}</td>

                                <td>
                                    {{ optional(optional($answer->mcqQuestionSubjects)->mcqQuestions)->count() ?? '' }}
                                </td>

                                <td> {{ $answer->mcqexamanssummery->where('result',1)->count()  }} </td> 
                                <td>
                                    <a href="{{ route('admin.mcq.exam.results.show', $answer->id) }}" class="btn btn-primary btn-sm ">Show Answers
                                        <i class="fa fa-eye ml-0 ml-sm-2"></i></a>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>
                </table>
                {{ $mcq_results->links() }}
            </div>
        </div>
        {{-- written exam history --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Written Exam History </h4>
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
                <div class="table-responsive">
                    <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
                        <thead>
                            <tr>
                                <th width="1%">ID</th>
                                <th class="text-nowrap">Date</th>
                                <th class="text-nowrap">Exam</th>
                                <th class="text-nowrap">Class</th>
                                <th class="text-nowrap">Session</th>
                                <th class="text-nowrap">Batch</th>
                                <th class="text-nowrap">Subject</th>
                                <th class="text-nowrap">Result</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($written_results as $result)
                                <tr>
                                    <td> {{ $loop->iteration }}</td>
                                    <td> {{ optional($result->created_at)->format('d-m-Y') }}</td>
                                    <td> {{ optional($result->topic->writtenQuestionSubjects)->question_no }} </td>
                                    <td> {{ optional($result->topic->classes)->name }}</td>
                                    <td> {{ optional($result->topic->sessiones)->name }}</td>
                                    <td> {{ optional($result->topic->batchsetting)->batch_name }}</td>
                                    <td> {{ optional($result->topic->subjects)->name }}</td>
                                    <td>{{ optional($result->topic->result)->result ?? 'Not ready' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                {{ $written_results->links() }}
                </div>
            </div>
        </div>
        {{-- Payment history --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Payment History </h4>
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
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Invoice</th>
                            <th>Reference</th>
                            <th>Amount</th>
                            <th>Received Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payment_history as $payment)
                            <tr>
                                <td>{{ $payment->created_at->format('d-m-Y') }}</td>
                                <td>{{ $payment->invoice_no }}</td>
                                <td>{{ $payment->reference_no }}</td>
                                <td>{{ $payment->amount }}</td>
                                <td>{{ $payment->receive_date->format('d-m-Y') }}</td>
                            </tr>
                        @empty

                        @endforelse
                    </tbody>
                </table>
                {{ $payment_history->links() }}
            </div>
        </div>
        {{-- attendence history --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Attendence History </h4>
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
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($attendances as $attendance)
                            <tr>
                                <td>{{ $attendance->created_at->format('d-m-Y') }}</td>
                                <td>{{ $attendance->attendance }}</td>
                        @empty

                        @endforelse
                    </tbody>
                </table>
                {{ $attendances->links() }}
            </div>
        </div>
    </div>
    @section('customjs')

    @endsection
@endsection
