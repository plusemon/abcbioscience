@extends('backend.layouts.app')
@section('title', 'Diagram Exam Results')
@section('content')

    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Diagram Exam Results List</h4>
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
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label>Session</label>
                            <select name="session" id="sessionId" class="form-control" onchange="getBatches()">
                                <option value="">SELECT SESSIONS</option>
                                @foreach ($sessions as $session)
                                    <option value="{{ $session->id }}">{{ $session->name }}</option>
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
                        <h1>Exam Name : {{ optional($exam->diagramQuestionSubjects)->question_no }}</h1>
                        <h3>Chapter : {{ optional($exam->diagramQuestionSubjects->chapter)->name }}</h3>
                        <h3>Topic : {{ optional($exam->diagramQuestionSubjects)->topic }}</h3>
                        <h4>Session: {{ optional($exam->sessiones)->name }}</h4>
                        <h4>Class: {{ optional($exam->classes)->name }}</h4>
                        <h4>Batch: {{ optional($exam->batchsetting)->batch_name }}</h4>
                        <h4>Total Mark : {{ optional($exam->diagramQuestionSubjects)->total_mark }}</h4>
                        <h4>Exam hold on : {{ date('d-m-Y h:i A', strtotime($exam->exam_start_date_time)) }} to
                            {{ date('d-m-Y h:i A', strtotime($exam->exam_end_date_time)) }} </h4>
                    </div>
                @endif


                <form action="{{ route('admin.diagram.exam.mark.entry') }}" method="post" accept-charset="utf-8">
                    @csrf

                    @if ($exam)
                        <input type="hidden" name="exam_setting_id" value="{{ $exam->id }}">
                    @endif
                    <table class="table table-hovered table-bordered table-td-valign-middle">
                        <thead>
                            <tr>
                                <th class="text-nowrap">Sl No</th>
                                <th class="text-nowrap">Student ID</th>
                                <th class="text-nowrap">Student Name</th>
                                {{-- <th class="text-nowrap">Submited at</th> --}}
                                <th class="text-nowrap">Result</th>
                                <th class="text-nowrap">Status</th>

                                <th>Mark</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($students)
                                @foreach ($students as $student)

                                    <tr>

                                        {{-- <td>{{ $loop->index + 1 }}</td> --}}
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $student->user->useruid ?? '' }}

                                            <input type="hidden" name="student_id[]" value="{{ $student->id }}">


                                        </td>

                                        <td>{{ $student->user->name ?? '' }}</td>



                                        @if ($student->resultId)
                                            <td>
                                                @if ($student->result != null)
                                                    {{ $student->result }}
                                                @else
                                                    <span class="text-warning">Unpublish</span>
                                                    <input type="hidden" name="written_exam_result_id[]"
                                                           value="{{ $student->resultId }}">
                                                @endif
                                            </td>
                                            <td><span class="text-success">Present</span></td>
                                            <td>
                                                <input type="text" name="result[]" placeholder="Enter Written Exam Mark"
                                                       class="form-control">

                                            </td>

                                        @else
                                            <td>

                                            </td>
                                            <td><span class="text-danger">Absent</span></td>
                                            <td>

                                                <input type="text" name="result[]" placeholder="Enter Written Exam Mark"
                                                       class="form-control">
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach
                            @endisset

                            <tr>
                                <td> <button type="submit" class="btn btn-primary">Submit</button> </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="justify-content-center d-flex">

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
                                `<option value="${item.id}">${item.diagram_question_subjects.question_no}</option>`
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
    </script>
@endsection
