@extends('backend.layouts.app')
@section('title','Add New Board Question')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Add New Board Question  </h4>
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
                <form action="{{ route('boardquestion.store') }}" method="post" enctype="multipart/form-data">
                    @CSRF
                    
                     <div class="form-group">
                        <label for="board_question_type">Board Questin Type :</label>
                        <select name="board_question_type_id" id="subject_code" class="form-control">
                            <option value="">Select Exam</option>
                            @foreach($board_questions as $board_question)
                                <option value="{{ $board_question->id }}"> {{ $board_question->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="year_id">Year :</label>
                        <select name="year_id" id="year_id" class="form-control">
                            <option value="">Select Year</option>
                            @foreach($years as $year)
                                <option value="{{ $year->id }}"> {{ $year->name }}</option>
                            @endforeach
                        </select>
                    </div>

                   
                    <div class="form-group">
                        <label for="subject_code">Subject :</label>
                        <select name="subject_id" id="subject_code" class="form-control">
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}"> {{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                   
                    <div class="form-group">
                        <label for="description">Question File :</label>
                        <input type="file" class="form-control" name="questionfile">
                        @error('questionfile')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>

                </form>
            </div>









        </div>
    </div>

@endsection
