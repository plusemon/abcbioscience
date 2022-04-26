@extends('backend.layouts.app')
@section('title','Add New Extra Exam')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Add New Extra Exam </h4>
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

                <form action="{{ route('extraexam.store') }}" method="post">
                    @CSRF
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="exam_name" id="exam_name" class="form-control" placeholder="Exam Name">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">MCQ Mark</label>
                        <input type="text" name="mcq_mark" class="form-control">
                        @error('mcq_mark')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Written Mark</label>
                        <input type="text" name="written_mark" class="form-control">
                        @error('written_mark')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="name">Exam Date</label>
                        <input type="date" name="exam_date" class="form-control">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-primary mt-3">Submit</button>

                </form>
            </div>







        </div>
    </div>

@endsection
