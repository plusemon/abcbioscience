@extends('backend.layouts.app')
@section('title', 'Mcq Exam Absend Students SMS')
@section('content')

    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Send SMS to MCQ exam absent students</h4>
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

                @if ($exam)
                    <div class="bg-light border py-2 text-center" style="position: relative;">
                        <h2>{{ optional($exam->mcqQuestionSubjects)->question_no }}</h2>
                        <h4>Session: {{ optional($exam->sessiones)->name }}, Class:
                            {{ optional($exam->classes)->name }}, Batch:
                            {{ optional($exam->batchsetting)->batch_name }}
                        </h4>
                        <h4>Subject: {{ optional($exam->mcqQuestionSubjects->subjects)->name }}</h4>
                        <h4>Chapter: {{ optional($exam->mcqQuestionSubjects->chapter)->name }}</h4>
                        <h4>Topic: {{ optional($exam->mcqQuestionSubjects)->topic }}</h4>
                        <h4>Total Mark: {{ $exam->mcqQuestionSubjects->mcqQuestions->count() }}</h4>
                        <h4>Exam Date : {{ Date('d-m-Y', strtotime($exam->exam_start_date_time)) }} </h4>
                    </div>
                @endif

                <form action="{{ route('mcq.result.sms') }}" method="POST">
                    @csrf

                   @if (isset($all_students))
                        <input type="hidden" name="sms_type" value="all">
                   @endif

                    <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                    <input type="hidden" name="test_name" value="{{ optional($exam->mcqQuestionSubjects)->question_no}}">
                    <input type="hidden" name="subject_name" value="{{ optional($exam->mcqQuestionSubjects->subjects)->name}}">

                    <table class="table table-hovered table-bordered table-td-valign-middle">
                        <thead>
                            <tr>
                                <th class="text-nowrap"><input type="checkbox" id="checkAll">
                                    <label for="checkAll" style="margin-bottom: -2px;margin-left: 5px;">Check
                                        All</label>
                                </th>
                                <th class="text-nowrap">Student ID</th>
                                <th class="text-nowrap">Student Name</th>
                                <th class="text-nowrap">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($students)
                                @foreach ($students as $student)
                                    @if (isset($all_students))
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="students_ids[]" value="{{ $student->id ?? null }}">
                                            </td>
                                            <td>{{ $student->user->useruid ?? '' }}</td>
                                            <td>{{ $student->user->name ?? '' }}</td>

                                            @if ($student->resultId)
                                                <td>{{ $student->result }}</td>
                                            @else
                                                <td>Absent</td>
                                            @endif
                                        </tr>
                                    @elseif(!isset($student->resultId))
                                        <tr>
                                            <td><input type="checkbox" name="students_ids[]" value="{{ $student->id ?? null }}"></td>
                                            <td>{{ $student->user->useruid ?? '' }}</td>
                                            <td>{{ $student->user->name ?? '' }}</td>

                                            @if ($student->resultId)
                                                <td>{{ $student->result }}</td>
                                            @else
                                                <td>Absent</td>
                                            @endif
                                        </tr>
                                    @endif

                                @endforeach
                            @endisset

                        </tbody>
                    </table>
                    <div class="text-center">
                        @if (!isset($all_students))
                            <div class="form-group" style="display:none">
                                <textarea name="message" id="message" class="form-control" rows="10"
                                          placeholder="Write sms here to send Batch Student"></textarea>
                                <span class="text-danger">{{ $errors->first('message') }}</span>
                            </div>
                            <ul id="sms-counter" class="list-unstyled pt-4"  style="display:none">
                                <li>Length: <span class="length"></span></li>
                                <li>Messages: <span class="messages"></span></li>
                                <li>Per Message: <span class="per_message"></span></li>
                                <li>Remaining: <span class="remaining"></span></li>
                            </ul>
                        @endif
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    </div>

@endsection

@section('customjs')
    <script>
        $("#checkAll").click(function() {
            $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
        });

        $("input[type=checkbox]").click(function() {
            if (!$(this).prop("checked")) {
                $("#checkAll").prop("checked", false);
            }
        });
    </script>
@endsection
