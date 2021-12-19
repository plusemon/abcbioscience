@extends('backend.layouts.app')
@section('title', 'Mcq Exam Results')
@section('content')

    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Mcq Exam Result List </h4>
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

                <form action="">
                    <div class="row">

                        <div class="form-group col-md-2">
                            <label>Class</label>
                            <select name="class" class="form-control" id="classId" onchange="getBatches()">
                                <option value="">SELECT CLASS</option>
                                @foreach ($classes as $class)
                                    <option {{ $class->id == request()->class ? 'selected' : '' }} value="{{ $class->id }}">
                                        {{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label>Session</label>
                            <select name="session" id="sessionId" class="form-control" onchange="getBatches()">
                                <option value="">SELECT SESSIONS</option>
                                @foreach ($sessions as $session)
                                    <option {{ $session->id == request()->session ? 'selected' : '' }} value="{{ $session->id }}">
                                        {{ $session->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Batch</label>
                            <select name="batch" class="form-control" id="batchId" onchange="getExams(this.value)"></select>
                        </div>

                        <div class="form-group col-md-4 ">
                            <label>Exam</label>
                            <select name="exam" class="form-control" id="examList" onchange="getResults(this.value)"></select>
                        </div>
                        <div class="form-group col-md-1">
                            <button type="submit" id="submitBtn" class="d-none btn btn-success"
                                    style="margin-top: 25px">Search</button>
                        </div>
                    </div>

                </form>
                @if ($exam)
                    <div class="bg-light border py-2 text-center" style="position: relative;">
                        <button onclick="window.open('{{ request()->fullUrl() }}&print=true','blank')" class="btn btn-black"
                                style="position: absolute; right:20px;">Print</button>

                        <button onclick="window.open('{{ request()->fullUrl() }}&sms=abs_student','blank')" class="btn btn-info"
                                style="position: absolute; right:20px; top:50px">SMS Absent Students</button>

                        <button onclick="window.open('{{ request()->fullUrl() }}&sms=all_students','blank')" class="btn btn-primary"
                                style="position: absolute; right:20px; top:100px">SMS All Students</button>

                        <h1>{{ optional($exam->mcqQuestionSubjects)->question_no }}</h1>
                        <h4>Session: {{ optional($exam->sessiones)->name }}</h4>
                        <h4>Class: {{ optional($exam->classes)->name }}</h4>
                        <h4>Batch: {{ optional($exam->batchsetting)->batch_name }}</h4>
                        <h4>Subject: {{ optional($exam->mcqQuestionSubjects->subjects)->name }}</h4>
                        <h4>Chapter: {{ optional($exam->mcqQuestionSubjects->chapter)->name }}</h4>
                        <h4>Topic: {{ optional($exam->mcqQuestionSubjects)->topic }}</h4>
                        <h4>Total Mark: {{ $exam->mcqQuestionSubjects->mcqQuestions->count() }}</h4>
                        <h4>Exam Date : {{ Date('d-m-Y', strtotime($exam->exam_start_date_time)) }} </h4>
                    </div>
                @endif


                <form action="" method="get">

                    <table class="table table-hovered table-bordered table-td-valign-middle">
                        <thead>
                            <tr>
                                <th class="text-nowrap">Sl No</th>
                                <th class="text-nowrap">Student ID</th>
                                <th class="text-nowrap">Student Name</th>
                                <th class="text-nowrap">Result</th>
                                <th class="text-nowrap">Answer Summery</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($students)
                                @foreach ($students as $student)
                                    <tr>
                                        {{-- <td>{{ $loop->index + 1 }}</td> --}}
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $student->user->useruid ?? '' }}</td>
                                        <td>{{ $student->user->name ?? '' }}</td>
                                        @if ($student->resultId)
                                            @if (is_numeric($student->result))
                                                <td>
                                                    <div class="badge badge-success">{{ $student->result }}</div>
                                                </td>
                                                <td class="text-center">

                                                    <a href="{{ route('admin.mcq.exam.results.show', $student->resultId) }}"
                                                       class="btn btn-green btn-rounded btn-sm ShowResult"
                                                       data-id="{{ $student->resultId }}">View Answers</a>

                                                    <a href="" class="btn btn-danger btn-rounded btn-sm reassign"
                                                       data-id="{{ $student->resultId }}">Re-Assign </a>
                                                </td>
                                            @else
                                                <td>
                                                    <div class="badge badge-warning">Incompleted</div>
                                                </td>
                                                <td class="text-center">

                                                    <a href="{{ route('admin.mcq.exam.results.show', $student->resultId) }}"
                                                       class="btn btn-green btn-rounded btn-sm ShowResult"
                                                       data-id="{{ $student->resultId }}">View Answers</a>

                                                    <a href="" class="btn btn-danger btn-rounded btn-sm reassign"
                                                       data-id="{{ $student->resultId }}">Re-Assign </a>

                                                </td>
                                            @endif

                                        @else
                                            <td>
                                                <div class="badge badge-danger">
                                                    Absent
                                                </div>
                                            </td>
                                            <td>

                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endisset

                        </tbody>
                    </table>

                    <button class="btn btn-primary btn-sm" type="submit" name="pdf"> <i class="fa fa-download"></i> PDF</button>
                    <button class="btn btn-success btn-sm" type="submit" name="sms"> <i class="fa fa-paper-plane-o"></i> SEND
                        Message</button>
                </form>

            </div>
            <div class="justify-content-center d-flex">

            </div>
        </div>

    </div>
    </div>









    <!-- Modal -->
    <div class="modal  fade" id="result_student" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Student MCQ Result</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="resultshow"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>





















@endsection

@section('customjs')
    <script>
        function getBatches() {

            var classId = $('#classId').val();
            var sessionId = $('#sessionId').val();
            var batch = $('#batchId');

            if (classId && sessionId) {
                var url = `{{ request()->url() }}?class=${classId}&session=${sessionId}`;
                $.ajax(url)
                    .then(res => {
                        batch.html('')
                        batch.append(`<option value="">SELECT BATCH</option>`)
                        res.forEach(item => {
                            batch.append(`<option value="${item.id}">${item.batch_name}</option>`);
                        })
                    })
                    .catch(e => console.log(e))
            }
        }

        function getExams(batchId) {

            var classId = $('#classId').val();
            var sessionId = $('#sessionId').val();
            var url = `{{ request()->url() }}?class=${classId}&session=${sessionId}&batch=${batchId}`;
            var examList = $('#examList');

            if (batchId) {
                $.ajax(url)
                    .then(res => {
                        examList.html('')
                        res.length > 0 ? $('#submitBtn').removeClass('d-none') : $('#submitBtn').addClass('d-none');
                        res.forEach(item => {
                            examList.append(
                                `<option value="${item.id}">${item.mcq_question_subjects.question_no}</option>`
                            );
                        })
                    })
                    .catch(e => console.log(e))
            }
        }


        function getResults(examId) {

            var url = `{{ request()->url() }}?class=${classId}&session=${sessionId}&batch=${batchId}&exam=${examId}`;

            $.ajax(url)
                .then(res => {
                    res.forEach(item => {
                        console.log(item);
                    })
                })
                .catch(e => console.log(e))
        }





        //=====================================================================================
        $(document).on('click', '.ShowResult', function(e) {
            e.preventDefault();
            $('#resultshow').html(`<h4 class="text-center">Please wait moment</h4>`);
            $('#result_student').modal('show');
            var result_id = $(this).data('id');

            $.ajax({
                type: "get",
                url: "{{ route('admin.mcq.exam.results.show', 1) }}",
                data: {
                    result_id: result_id
                },
                success: function(data) {
                    $('#resultshow').html(data);
                    $('#result_student').modal('show');
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });



        });
        //=====================================================================================





        $(document).on('click', '.reassign', function(e) {
            e.preventDefault();

            var result_id = $(this).data('id');

            $.ajax({
                type: "get",
                url: "{{ route('admin.mcq.exam.result.delete',1) }}",
                data: {
                    result_id: result_id
                },
                success: function(data) {
                    location.reload();
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });
    </script>
@endsection
