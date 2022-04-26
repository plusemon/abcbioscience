@extends('backend.layouts.app')
@section('title','blog')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Class  </h4>
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

                <a href="{{ route('old_question.create') }}" class="btn btn-primary btn-sm float-right mb-1" id="create-new-class"><i class="fa fa-plus"></i> Add Old Question</a>

                <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
                    <thead>
                    <tr>
                        <th class="text-nowrap">serial no</th>
                        <th class="text-nowrap">Question type</th>
                        <th class="text-nowrap">School Name</th>
                        <th class="text-nowrap">year</th>
                        <th class="text-nowrap">Class</th>
                        <th class="text-nowrap">Exam Type</th>
                        <th class="text-nowrap">Subject</th>
                        <th class="text-nowrap">Board Question</th>
                        <th class="text-nowrap">Question File</th>
                        <th class="text-nowrap">Status</th>
                        <th class="text-nowrap">user Id</th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($boardquestions as $old_qus)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{ $old_qus->questiontype?$old_qus->questiontype->name:''  }} </td>
                            <td>{{$old_qus->schoolname}}</td>


                            <td>{{ $old_qus->year?$old_qus->year->name:''  }} </td>
                            <td>{{ $old_qus->classes?$old_qus->classes->name:''}}</td>
                            <td>{{ $old_qus->examtype?$old_qus->examtype->name:''}}</td>
                            <td>{{ $old_qus->subject?$old_qus->subject->name:''}}</td>
                            <td>{{ $old_qus->boardquestiontype?$old_qus->boardquestiontype->name:''}}</td>
                            <td><a href="{{asset($old_qus->questionfile)}}" download="">Download</a> </td>
                            <td>
                                @if($old_qus->status==1)
                                    <p class="btn btn-primary">Active</p>
                                @elseif($old_qus->status==2)
                                    <p class="btn btn-danger">inactive</p>
                                @endif
                            </td>
                            <td>{{ $old_qus->user?$old_qus->user->name:'no user' }}</td>
                            <td>
                                <a href="{{route('old_question.show',$old_qus->id)}}" class="btn btn-success">view</a>
                                <a href="{{route('old_question.edit',$old_qus->id)}}" class="btn btn-primary">edit</a>
                                <a href="{{route('old_question.destroy',$old_qus->id)}}" id="delete" class="btn btn-danger">delate</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>





        </div>
    </div>

@endsection
