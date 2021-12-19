@extends('students.layouts.app')
@section('title', 'Written Exam History')
@section('content')
    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Written Exam History</h4>
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
                            <table id="" class="table table-striped table-bordered table-td-valign-middle datatables">
                                <thead>
                                    <tr>
                                        <th width="1%">ID</th>
                                        <th class="text-nowrap">Question No/Name</th>
                                        <th class="text-nowrap">Class</th>
                                        <th class="text-nowrap">Session</th>
                                        <th class="text-nowrap">Batch</th>
                                        <th class="text-nowrap">Subject</th>
                                        <th class="text-nowrap">Exam Date</th>
                                        <th class="text-nowrap">Result</th>
                                        <th class="text-nowrap">Download</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($exams as $exam)
                                        <tr>
                                            <td> {{ $loop->iteration }}</td>
                                            <td> {{ optional($exam->writtenQuestionSubjects)->question_no }} </td>
                                            <td> {{ optional($exam->classes)->name }}</td>
                                            <td> {{ optional($exam->sessiones)->name }}</td>
                                            <td> {{ optional($exam->batchsetting)->batch_name }}</td>
                                            <td> {{ optional($exam->subjects)->name }}</td>
                                            @if ($exam->result)
                                                <td> {{ $exam->result->created_at->format('d-m-Y') }}</td>
                                                <td>{{ $exam->result->result ?? 'Pending' }}</td>
                                            @else
                                                <td></td>
                                                <td class="text-danger">Missed</td>
                                            @endif
                                            <td> 
                                            <a href="{{ asset($exam->writtenexam->attachment) }}"
                                                        class="btn btn-outline-primary" download>Download </a>
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
