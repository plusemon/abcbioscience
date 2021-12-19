@extends('backend.layouts.app')
@section('title','Edit Board Question')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Edit Board Question  </h4>
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
                <form action="{{ route('boardquestion.update',$old_qus->id) }}" method="post" enctype="multipart/form-data">
                    @CSRF
                    
                   <div class="form-group">
                        <label for="board_question_type">Board Questin Type :</label>
                        <select name="board_question_type_id" id="subject_code" class="form-control">
                            @foreach($board_questions as $board_question)
                                <option  {{$old_qus->board_question_type_id == $board_question->id ? 'selected' : '' }} value="{{$board_question->id}}">{{$board_question->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="year_id">Year :</label>
                        <select name="year_id" id="year_id" class="form-control">
                            @foreach($years as $year)
                                <option  {{$old_qus->year_id == $year->id ? 'selected' : '' }} value="{{$year->id}}">{{$year->name}}</option>
                            @endforeach
                        </select>
                    </div>
                 
                    <div class="form-group">
                        <label for="subject_code">Subject :</label>
                        <select name="subject_id" id="subject_code" class="form-control">
                            @foreach($subjects as $subject)
                                <option  {{$old_qus->subject_id == $subject->id ? 'selected' : '' }} value="{{$subject->id}}">{{$subject->name}}</option>
                            @endforeach
                        </select>
                    </div>
                   
                    <div class="form-group">
                        <label for="description">Question File :</label>


                        <a href="{{asset($old_qus->questionfile)}}" download="" class="btn btn-primary btn-sm"> <i class="fa fa-download"></i> Download
                                </a> 
                        <a href="{{ asset($old_qus->questionfile) }}" title="" class="btn btn-info btn-sm"> <i class="fa fa-eye"></i> Preview</a>

                        <br>
                        <br>


                        <input type="file" class="form-control" name="questionfile">



                        @error('questionfile')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option  {{ $old_qus->status==1 ? 'selected' : ''}} value="1">Active</option>
                            <option  {{ $old_qus->status==2 ? 'selected' : '' }} value="2">Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>

                    <a href="{{ route('boardquestion.index') }}" title="" class="btn btn-info mt-3">Back</a>

                </form>
            </div>









        </div>
    </div>

@endsection
