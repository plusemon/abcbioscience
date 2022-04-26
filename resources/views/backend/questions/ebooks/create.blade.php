@extends('backend.layouts.app')
@section('title','Add New Ebook')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Add New Ebook  </h4>
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
                <form action="{{ route('ebooks.store') }}" method="post" enctype="multipart/form-data">
                    @CSRF
                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="class">Class :</label>
                            <select name="class_id" id="class_id" class="form-control" required>
                                <option value="">Select Class</option>
                                @foreach($classes as $class)
                                    <option {{ old('class_id') == $class->id ? 'selected' :'' }} value="{{ $class->id }}"> {{ $class->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger">{{ $errors->first('class_id') }}</div>
                        </div>
                    </div>

                     <div class="col-md-6">
                                <div class="form-group">
                                    <label for="class">Subject :</label>
                                    <select name="old_subject_id" id="old_subject_id" class="form-control" required>
                                        <option value="">Select Class</option>
                                        @foreach($subjects as $subject)
                                            <option {{ old('old_subject_id') == $subject->id ? 'selected' :'' }} value="{{ $subject->id }}"> {{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{ $errors->first('old_subject_id') }}</div>
                                </div>
                            </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Ebook file (PDF or DOC or IMAGE)</label>
                            <input type="file" name="ebook_file" value="{{ old('ebook_file') }}" class="form-control" placeholder="Enter ebook_file"  accept=".jpg,.jpeg,.png,.pdf,.docx,.doc" />
                            <div class="text-danger">{{ $errors->first('ebook_file') }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Ebook Thumbnail</label>
                            <input type="file" name="thumbnail" value="{{ old('thumbnail') }}" class="form-control" placeholder="Enter thumbnail"  accept=".jpg,.jpeg,.png" />
                            <div class="text-danger">{{ $errors->first('thumbnail') }}</div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
         </div>
    </div>












@endsection
