@extends('frontend.layouts.app')
@section('title', 'Written exam history')
@section('content')

    <!--USER DASHBOARD-->
    <section class="user-dashboard py-4">
        <div class="container">
            <div class="dashboard-area d-flex bd-highlight">



                @include('frontend.studentdashboard.dashboardmenu')


                <div class="dashboard-main w-100 bd-highlight py-3">
                    <div class="dr-head dashboard-header">
                        <div class="ud-mobile">
                            <i class="fa fa-bars" id="ud-mobile-btn"></i>Profile Menu
                        </div>
                        <h6>Written exam histroy </h6>

                    </div>
                    <div class="hr-body">


                        <div class="table-responsive">
                            <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
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
    </section>
    <!--END USER DASHBOARD-->



    @include('frontend.studentdashboard.mobilemenu')


@endsection
