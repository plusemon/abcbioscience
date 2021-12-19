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

                <a href="{{ route('quizquestion.create') }}" class="btn btn-primary btn-sm float-right mb-1" id="create-new-class"><i class="fa fa-plus"></i> Add MCQ Question</a>

                <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
                    <thead>
                    <tr>
                        <th class="text-nowrap">Serial No</th>
                        <th class="text-nowrap">Question Name</th>
                        <th class="text-nowrap">Quiz</th>
                        <th class="text-nowrap">Date</th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($quizquestiones as $quizquestion)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{ $quizquestion->question_name }}</td>
                            <td>{{ $quizquestion->quiz?$quizquestion->quiz->quiz_name:''  }} </td>
                            <td>{{ $quizquestion->created_at->format('d-M-Y') }}</td>
                             
                          
                            <td>
                                
                                <a href="{{route('quizquestion.edit',$quizquestion->id)}}" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> Edit</a>
                                <a href="{{route('quizquestion.destroy',$quizquestion->id)}}" id="delete" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> Delate</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>





        </div>
    </div>

@endsection
