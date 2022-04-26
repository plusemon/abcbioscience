@extends('backend.layouts.app')
@section('title','MCQ Questions')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">MCQ Questions  </h4>
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

                <a href="{{ route('quiz.create') }}" class="btn btn-primary btn-sm float-right mb-1" id="create-new-class"><i class="fa fa-plus"></i> Add MCQ Quiz</a>

                <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
                    <thead>
                    <tr>
                        <th class="text-nowrap">Serial No</th>
                        <th class="text-nowrap">Class</th>
                        <th class="text-nowrap">Session</th>
                        <th class="text-nowrap">Batch</th>
                        <th class="text-nowrap">Subject</th>
                        <th class="text-nowrap">Quiz Name</th>
                        <th class="text-nowrap">Quiz Time</th>
                        <th class="text-nowrap">Status</th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($quizzes as $quiz)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{ $quiz->classes?$quiz->classes->name:''}}</td>
                            <td>{{ $quiz->sessiones?$quiz->sessiones->name:''  }} </td>
                            <td>{{ $quiz->batchsetting?$quiz->batchsetting->batch_name:''  }} </td>
                            <td>{{ $quiz->subject?$quiz->subject->name:''  }} </td>
                            <td>{{ $quiz->quiz_name }}</td>
                            <td>{{ $quiz->quiz_time }}</td>
                           
                            
                            <td>
                                @if($quiz->status==1)
                                    <p class="btn btn-primary btn-sm">Active</p>
                                @elseif($quiz->status==2)
                                    <p class="btn btn-danger btn-sm">inactive</p>
                                @endif
                            </td>
                          
                            <td>

                                <a href="{{ route('quiz.show',$quiz->id) }}"class="btn btn-dark  btn-sm"> <i class="fa fa-eye"> </i> View Question </a>
                                
                                <a href="{{route('quiz.edit',$quiz->id)}}" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> Edit</a>
                                <a href="{{route('quiz.destroy',$quiz->id)}}" id="delete" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> Delate</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>





        </div>
    </div>

@endsection
