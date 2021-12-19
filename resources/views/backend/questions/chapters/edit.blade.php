@extends('backend.layouts.app')
@section('title','Edit Subject Chapter')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Edit Subject Chapter  </h4>
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
                <form action="{{ route('chapter.update',$chapter->id) }}" method="post">
                    @CSRF



                <div class="form-group">
                    <label for="Subject">Subject :</label>
                    <select name="subject_id" id="subject_id" class="form-control" >
                        <option value="">Select Subject</option>
                        @foreach($subjects as $subject)
                            <option {{ $chapter->subject_id == $subject->id ? 'selected' :'' }} value="{{ $subject->id }}"> {{ $subject->name }}</option>
                        @endforeach
                    </select>
                     <div class="text-danger">{{ $errors->first('subject_id') }}</div>
                </div>

 



                <div class="form-group">
                    <label for="name">Chapter</label>
                    <input type="text" class="form-control" id="name" name="name"  value="{{ $chapter->name }}" placeholder="Enter chapter name" >
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
