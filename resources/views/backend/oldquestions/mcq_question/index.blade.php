@extends('backend.layouts.app')
@section('title','Mcq Questions List')
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

                <a href="{{ route('admin.mcq.create') }}" class="btn btn-primary btn-sm float-right mb-1" id="create-new-class"><i class="fa fa-plus"></i> Add Question</a>

                <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
                    <thead>
                    <tr>
                        <th class="text-nowrap">Sl No</th>
                        <th class="text-nowrap">Subject Name</th>
                        <th class="text-nowrap">Question No/Name</th>
                        <th class="text-nowrap">Year</th>
                        <th class="text-nowrap">Class</th>
                        <th class="text-nowrap">Exam Type</th>
                        <th class="text-nowrap">Status</th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($questions as $question)
                        <tr>
                            <td>{{ $loop->index+1}}</td>
                            <td>{{ $question->subjects?$question->subjects->name:NULL}}</td>
                            <td>{{ $question->question_no}}</td>
                            <td>{{ $question->sessiones?$question->sessiones->name:''  }} </td>
                            <td>{{ $question->classes?$question->classes->name:''}}</td>
                            <td>{{ $question->examtypies?$question->examtypies->name:''}}</td>
                            <td>
                                @if($question->status==1)
                                    <span class="btn btn-primary btn-sm">Active</span>
                                @elseif($question->status==2)
                                    <span class="btn btn-danger btn-sm">inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('admin.mcq.show',$question->id)}}" class="btn btn-success btn-sm ">View</a>
                                <a href="{{route('admin.mcq.exam',$question->id)}}" class="btn btn-primary btn-sm ">Exam</a>
                                <a href="{{route('admin.mcq-setting.create','qid='.$question->id)}}" class="btn btn-primary btn-sm ">Setting</a>
                                {{--  <a href="{{route('old_question.destroy',$question->id)}}" id="delete" class=" btn-sm btn btn-danger">Delate</a>  --}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
