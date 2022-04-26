@extends('backend.layouts.app')
@section('title','School Questions')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">School Questions  </h4>
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

                <a href="{{ route('old_question.create') }}" class="btn btn-primary btn-sm float-right mb-1" id="create-new-class"><i class="fa fa-plus"></i> Add School Question</a>

                <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
                    <thead>
                    <tr>
                        <th class="text-nowrap">Serial No</th>
                        <th class="text-nowrap">School Name</th>
                        <th class="text-nowrap">Year</th>
                        <th class="text-nowrap">Class</th>
                        <th class="text-nowrap">Exam Type</th>
                        <th class="text-nowrap">Subject</th>
                        <th class="text-nowrap">Question File</th>
                        <th class="text-nowrap">Created Date</th>
                        <th class="text-nowrap">Status</th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($old_quss as $old_qus)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$old_qus->schoolname}}</td>
                            <td>{{ $old_qus->year?$old_qus->year->name:''  }} </td>
                            <td>{{ $old_qus->classes?$old_qus->classes->name:''}}</td>
                            <td>{{ $old_qus->examtype?$old_qus->examtype->name:''}}</td>
                            <td>{{ $old_qus->subject?$old_qus->subject->name:''}}</td>
                            <td>{{ $old_qus->created_at->format('d-m-Y') }}</td>
                        
                           <td>
                                <a href="{{asset($old_qus->questionfile)}}" download="" class="btn btn-primary btn-sm"> <i class="fa fa-download"></i> Download
                                </a> 
                                <a href="{{ asset($old_qus->questionfile) }}" title="" class="btn btn-info btn-sm"> <i class="fa fa-eye"></i> Preview</a>
                            </td>

                            <td>
                                @if($old_qus->status==1)
                                    <p class="btn btn-primary btn-sm">Active</p>
                                @elseif($old_qus->status==2)
                                    <p class="btn btn-danger btn-sm">Inactive</p>
                                @endif
                            </td>
                          
                            <td>
                                <a href="{{route('old_question.edit',$old_qus->id)}}" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> Edit</a>
                                <a href="{{route('old_question.destroy',$old_qus->id)}}" id="delete" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> Delate</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>





        </div>
    </div>

@endsection
