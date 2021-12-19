@extends('frontend.layouts.app')
@section('title', 'Written Question list')
@section('content')

    <!--USER DASHBOARD-->
    <section class="user-dashboard py-4">
        <div class="container">
            <div class="dashboard-area d-flex bd-highlight">
                @include('frontend.studentdashboard.dashboardmenu')

                <div class="dashboard-main w-100 bd-highlight py-3">
                    <div class="dr-head dashboard-header">
                        <div class="ud-mobile">
                            <i class="fa fa-bars" id="ud-mobile-btn"></i> Profile Menu
                        </div>
                        <h6>Available written exams </h6>

                    </div>
                    <div class="hr-body">

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
                                                        class="btn btn-custom">View Exam</a>
                                                @elseif($now < $start)
                                                
                                                <p class="text-success font-weight-bold">  Comming Soon .... </p>
                                                
                                                @elseif($now > $end) <p class="text-danger">Time out </p>
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
    </section>
    <!--END USER DASHBOARD-->

    @include('frontend.studentdashboard.mobilemenu')
@endsection
