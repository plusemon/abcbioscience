@extends('backend.layouts.app')
@section('title','Edit Sheet')
@section('content')



<div id="content" class="content">
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="panel panel-inverse" data-sortable-id="form-stuff-10">
                <div class="panel-heading">
                    <h4 class="panel-title">Edit Sheet</h4>
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
                    <form action="{{ route('sheet.update',$sheet->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                         <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="url">Sheet  No/Name</label>
                                    <input type="text" name="sheet_no" value="{{ $sheet->sheet_no }}" class="form-control" placeholder="Enter Sheet Name" />
                                    <div class="text-danger">{{ $errors->first('sheet_no') }}</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="class">Subject :</label>
                                    <select name="subject_id" id="subject_id" class="form-control" required>
                                        <option value="">Select Class</option>
                                        @foreach($subjects as $subject)
                                            <option {{ $sheet->subject_id == $subject->id ? 'selected' :'' }} value="{{ $subject->id }}"> {{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{ $errors->first('subject_id') }}</div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-3 col-md-3">
                                    <label for="Subject" class="col-md-12">Chapter :</label>
                                    <div class="col-md-12">

                                        <select name="chapter_id" id="chapter_id" class="form-control">
                                            <option value="">Select Chapter</option>

                                        </select>
                                        <div class="text-danger">{{ $errors->first('chapter_id') }}</div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <label for="class">Chapter Topic:</label>
                                        <input type="text" name="topic" value="{{ $sheet->topic }}"
                                            placeholder="Chapter topic" class="form-control">
                                        <div class="text-danger">{{ $errors->first('topic') }}</div>
                                    </div>
                                </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="class">Class :</label>
                                    <select name="class_id" id="class_id" class="form-control" required>
                                        <option value="">Select Class</option>
                                        @foreach($classes as $class)
                                            <option {{ $sheet->class_id == $class->id ? 'selected' :'' }} value="{{ $class->id }}"> {{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{ $errors->first('class_id') }}</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Session">Session :</label>
                                    <select name="session_id" id="session_id" class="form-control" required>
                                        <option value="">Select Session</option>
                                        @foreach($sessiones as $session)
                                            <option {{ $sheet->session_id == $session->id ? 'selected' :'' }} value="{{ $session->id }}"> {{ $session->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{ $errors->first('session_id') }}</div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Sheet file (PDF or DOC or IMAGE)</label>
                                    <input type="file" name="sheet_file" value="{{ old('sheet_file') }}" class="form-control" placeholder="Enter sheet_file"  accept=".jpg,.jpeg,.png,.pdf,.docx,.doc" />
                                    <div class="text-danger">{{ $errors->first('sheet_file') }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Sheet Thumbnail</label>
                                    <input type="file" name="thumbnail" value="{{ old('thumbnail') }}" class="form-control" placeholder="Enter thumbnail"  accept=".jpg,.jpeg,.png" />
                                    <div class="text-danger">{{ $errors->first('thumbnail') }}</div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" class="form-control summernote" placeholder="Enter Sheet description">{{  $sheet->description }}</textarea>
                                    <div class="text-danger">{{ $errors->first('description') }}</div>
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="" > select status</option>
                                        <option {{ old('status') == 1 ? 'selected' : 'selected'  }} value="1"> Active</option>
                                        <option {{ old('status') == 2 ? 'selected' : ''  }} value="0"> Inactive</option>
                                    </select>
                                    <div class="text-danger">{{ $errors->first('status') }}</div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary m-r-5">Submit</button>
                        <a class="btn btn-sm btn-danger" href="{{ route('sheet.index') }}">Back</a>


                    </form>
                </div>

            </div>
        </div>

    </div>
</div>

@section('customjs')

    <script>
        $(document).ready( function () {
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

         $('#sessiones_id').on('change', function () {

              var classes_id    = $('#classes_id').val();
              var sessiones_id  = $('#sessiones_id').val();


                $.ajax({
                    type: "get",
                    url: "{{ route('get.batch.setting') }}",
                    data: {classes_id:classes_id,sessiones_id:sessiones_id},
                    success: function (data) {
                         $("#batch_setting_id").html(data);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });


               $(document).on('change', '#subject_id', function() {

            var subject_id = $('#subject_id').val();

            $.ajax({
                type: "get",
                url: "{{ route('getchapter') }}",
                data: {
                    subject_id: subject_id
                },
                success: function(data) {
                    if (data.status == true) {
                        $("#chapter_id").html(data);
                    } else {
                        $("#chapter_id").html(data);
                    }
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });
        });
    </script>


@endsection
@endsection
