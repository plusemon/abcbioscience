@extends('backend.layouts.app')
@section('title','MCQ Question Payment Details')
@section('content')

    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Mcq Questions List </h4>
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

                <table class="table">
                    <thead>
                        <tr>
                            <th>Menu</th>
                            <th>Informatnion</th>  

                            <th>Menu</th>
                            <th>Informatnion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Class</th>
                            <td>{{ $mcqexamsetting->classes?$mcqexamsetting->classes->name:'' }}</td>

                            <th>Session</th>
                            <td>{{ $mcqexamsetting->sessiones?$mcqexamsetting->sessiones->name:'' }}</td>
                        </tr>

                        <tr>
                            <th>Batch Name</th>
                            <td>{{ $mcqexamsetting->batchsetting?$mcqexamsetting->batchsetting->batch_name:'' }}</td>

                            <th>Batch Name</th>
                            <td>{{ $mcqexamsetting->batchTypies?$mcqexamsetting->batchTypies->name:'' }}</td>
                        </tr>  


                        <tr>
                            <th>Subject </th>
                            <td>{{ $mcqexamsetting->subjects?$mcqexamsetting->subjects->name:'' }}</td>

                            <th>Batch Name</th>
                            <td>{{ $mcqexamsetting->examtypies?$mcqexamsetting->examtypies->name:'' }}</td>
                        </tr>

                         <tr>
                             <th>Start Time</th>
                             <td>{{ $mcqexamsetting->exam_start_date_time }}</td>
                        
                             <th>End Time</th>
                             <td>{{ $mcqexamsetting->exam_end_date_time }}</td>
                         </tr>
                         <tr>
                             <th>Total Time</th>
                             <td>{{ $mcqexamsetting->duration }}</td>
                          
                             <th>Exam Date</th>
                             <td>{{ $mcqexamsetting->exam_start_date_time }}</td>
                         </tr> 


                         <tr>
                             <th>Amount</th>
                             <td>{{ $mcqexamamount->amount }}</td>
                         </tr>

                    </tbody>
                </table>
 
            </div>

        </div>
    </div>

@endsection
