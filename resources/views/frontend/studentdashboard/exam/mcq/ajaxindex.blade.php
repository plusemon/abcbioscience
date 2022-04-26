<div class="table-responsive">
        <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
            <thead class="text-center">
                <tr>
                    <th class="text-nowrap">Question No/Name</th>
                    <th class="text-nowrap">Subject</th>
                    <th class="text-nowrap">Chapter</th>
                    <th class="text-nowrap">Topic</th>
                    <th class="text-nowrap">Batch</th>
                    <th class="text-nowrap">Start time</th>
                    <th class="text-nowrap">End time</th>
                    <th class="text-nowrap">Duration</th>
                    <th class="text-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($exams as $exam)
                    <tr>
                        <td> {{ optional($exam->mcqexam)->question_no }}
                        </td>
                        <td> {{ optional($exam->subjects)->name }}</td>
                         <td> {{ optional($exam->mcqexam->chapter)->name }}</td>
                        <td> {{ optional($exam->mcqexam)->topic }}</td>
                        <td> {{ optional($exam->batchsetting)->batch_name }}</td>
                       
                        <td> {{ $exam->exam_start_date_time->format('d-m-Y h:i A') }}</td>
                        <td>
                            {{ $exam->exam_end_date_time->format('d-m-Y h:i A') }}
                        </td>
                        <td>
                            {{$exam->duration }} Minutes
                        </td>
                        <td>
                            @php
                                $start = $exam->exam_start_date_time;
                                $end = $exam->exam_end_date_time;
                                $now = now();
                            @endphp
                            @if ($exam->is_mcq_exam_completed())
                            <button class="btn btn-success" disabled>Completed</button>
                            @else
                            <a href="{{ route('student.exam.mcq.create', ['exam_id' => $exam->id]) }}" class="btn btn-custom">Open Quiz</a>
                            @endif
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>