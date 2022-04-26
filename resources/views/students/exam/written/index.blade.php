@extends('students.layouts.app')
@section('title', 'Written Exam')
@section('content')
    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Written Exam </h4>
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
                <div class="row">
                    <div class="col-md-12">

                        <div class="table-responsive">
                            <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
                                <thead class="text-center">
                                    <tr>
                                        <th class="text-nowrap">Question No/Name</th>
                                        <th class="text-nowrap">Subject</th>
                                        <th class="text-nowrap">Exam start time</th>
                                        <th class="text-nowrap">Exam end time</th>
                                        <th class="text-nowrap">Attend Exam</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($exams as $exam)
                                        <tr>
                                            <td> {{ optional($exam->writtenexam)->question_no }}
                                            </td>
                                            <td> {{ optional($exam->subjects)->name }}</td>
                                            <td> {{ $exam->exam_start_date_time->format('d-m-Y h:i a') }}</td>
                                            <td>
                                                {{ $exam->exam_end_date_time->format('d-m-Y h:i a') }}
                                            </td>
                                            <td>
                                                @php
                                                    $start = $exam->exam_start_date_time;
                                                    $end = $exam->exam_end_date_time;
                                                    $now = now();
                                                    $isValidTime = $start <= $now && $end > $now;
                                                @endphp

                                                @if ($isValidTime)
                                                    <a href="{{ route('student.exam.written.create', ['exam_id' => $exam->id]) }}"
                                                        class="btn btn-primary">View Exam</a>
                                                @elseif($now < $start)
                                                
                                                <p class="btn btn-warning font-weight-bold">  Comming Soon .... </p>
                                                
                                                @elseif($now > $end) <p class="btn btn-danger">Time out </p>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
@endsection
