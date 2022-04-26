@extends('backend.layouts.app')
@section('title','Add New College Old Question')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Add New College Question  </h4>
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
                <form action="{{ route('old_question.college.store') }}" method="post" enctype="multipart/form-data">
                    @CSRF
                   
                    <div class="form-group">
                        <label for="school">College Name :</label>
                        <select name="school_id" id="school_id" class="form-control">
                            <option value="">Select College</option>
                            @foreach($colleges as $college)
                                <option value="{{ $college->id }}"> {{ $college->name }}</option>
                            @endforeach
                        </select>
                        @error('schoolname')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
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
                        <label for="class">Class :</label>
                        <select name="class_id" id="class" class="form-control">
                            <option value="">Select Class</option>
                            @foreach($classs as $class)
                                <option value="{{ $class->id }}"> {{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="class">Exam Type</label>

                        <select name="exam_type_id" id="class" class="form-control">
                            <option value="">Select Exam Type</option>
                            @foreach($exams as $exam)
                                <option value="{{ $exam->id }}"> {{ $exam->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Subject :</label>
                        <select name="subject_id" id="subject_id" class="form-control">
                            <option value="">Select Subject</option>
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
                    <a href="{{ route('old_question.college.index') }}" class="btn btn-info mt-3" title="">Back</a>

                </form>
            </div>









        </div>
    </div>

@endsection
