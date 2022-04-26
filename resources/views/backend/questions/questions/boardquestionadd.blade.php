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
                                <option {{ old('board_question_type_id') == $board_question->id ? 'selected' : '' }}  value="{{ $board_question->id }}"> {{ $board_question->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="year_id">Year :</label>
                        <select name="year_id" id="year_id" class="form-control">
                            <option value="">Select Year</option>
                            @foreach($years as $year)
                                <option {{ old('year_id') == $year->id ? 'selected' : '' }} value="{{ $year->id }}"> {{ $year->name }}</option>
                            @endforeach
                        </select>
                    </div>



                   
                    <div class="form-group">
                        <label for="">Board :</label>
                        <select name="board_name_id" id="board_name_id" class="form-control">
                            @foreach($boardnames as $board)
                                <option {{ old('board_name_id') == $board->id ? 'selected' : '' }} value="{{ $board->id }}"> {{ $board->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subject :</label>
                        <select name="subject_id" id="subject_id" class="form-control">
                            @foreach($subjects as $subject)
                                <option {{ old('subject_id') == $subject->id ? 'selected' : '' }} value="{{ $subject->id }}"> {{ $subject->name }}</option>
                            @endforeach
                        </select>
                        @error('subject')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
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
                            <option {{ old('status') == 1 ? 'selected' : '' }} value="1">Active</option>
                            <option {{ old('status') == 2 ? 'selected' : '' }} value="2">Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>

                </form>
            </div>









        </div>
    </div>

@endsection
