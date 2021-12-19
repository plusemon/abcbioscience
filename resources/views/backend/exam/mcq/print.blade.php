<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>
    <link href="{{ asset('public/backend') }}/assets/css/default/app.min.css" rel="stylesheet" />
    <style media="print">
        #printBtn,
        #closeBtn {
            display: none;
        }

    </style>
    <style>
        #closeBtn {
            position: absolute;
            right: 40px;
            top: 25px;
        }

        #printBtn {
            position: absolute;
            right: 25px;
            top: 75px;
        }

    </style>
</head>

<body>
    @if ($exam)
        <div class="bg-light border py-2 text-center" style="position: relative;">
            <button onclick="window.print()" class="btn btn-info" id="printBtn">Print Result</button>
            <button onclick="window.close()" class="btn btn-danger" id="closeBtn">Close</button>
            <h1>{{ optional($exam->mcqQuestionSubjects)->question_no }}</h1>
            <h4>Session: {{ optional($exam->sessiones)->name }}</h4>
            <h4>Class: {{ optional($exam->classes)->name }}</h4>
            <h4>Batch: {{ optional($exam->batchsetting)->batch_name }}</h4>
            <h4>Total Mark: {{ $exam->mcqQuestionSubjects->mcqQuestions->count() }}</h4>
        </div>
    @endif
    <table class="table table-hovered table-bordered table-td-valign-middle">
        <thead>
            <tr>
                <th class="text-nowrap">Sl No</th>
                <th class="text-nowrap">Student ID</th>
                <th class="text-nowrap">Student Name</th>
                <th class="text-nowrap">Result</th>
            </tr>
        </thead>
        <tbody>
            @isset($students)
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $student->user->useruid ?? '' }}</td>
                        <td>{{ $student->user->name ?? '' }}</td>
                        @if ($student->resultId)
                            <td>{{ is_numeric($student->result) ? $student->result : 'Pending' }}</td>
                        @else
                            <td>Absent</td>
                        @endif
                    </tr>
                @endforeach
            @endisset

        </tbody>
    </table>

    <script>
        (function() {
            window.print()
        })();
    </script>
</body>

</html>
