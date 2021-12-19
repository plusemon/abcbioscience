@extends('backend.layouts.app')
@section('title', 'MCQ Questions View')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Question No : {{ $question->question_no }} </h4>
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

                  <form action="{{ route('admin.mcq.question.update',$question->id) }}" method="post">
                    @csrf
                <div class="form-group row" style="margin-bottom:25px;">

                    <div class="col-md-6">
                        <label for="" class="col-md-12">Question No/Name/Others</label>
                        <div class="col-md-12">
                            <input type="text" name="question_no" value="{{ $question->question_no }}" class="form-control" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="col-md-12">Subject Name</label>
                        <div class="col-md-12">
                            <select name="subject_id" id="subject_id" class="form-control" required>
                                <option value="">Select One</option>
                                @foreach ($subjects as $subject)
                                <option {{ $question->subjects->id == $subject->id ? 'selected' : '' }}
                                    value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger">{{ $errors->first('subject_id') }}</div>
                        </div>
                    </div>
                </div>


                <div class="form-group row" style="margin-bottom:25px;">
                    <div class="col-md-6">
                        <label class="col-md-12">Chapter</label>
                        <div class="col-md-12">
                            <input type="text"
                                value="{{ $question->chapter ? $question->chapter->name : null }}"
                                class="form-control" />
                        </div>
                    </div>
                     <div class="col-md-6">
                        <label for="" class="col-md-12">Topic</label>
                        <div class="col-md-12">
                            <input type="text"  name="topic" value="{{ $question->topic }}" class="form-control" />
                        </div>
                    </div>

                </div>


                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="" class="col-md-12">Class</label>
                        <div class="col-md-12">
                            <select name="class_id" id="" class="form-control" required>
                                <option value="">Select Class</option>
                                @foreach ($classes as $class)
                                <option {{ $question->class_id == $class->id ? 'selected' : '' }}
                                    value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger">{{ $errors->first('class_id') }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="" class="col-md-12">Session</label>
                        <div class="col-md-12">
                            <select name="session_id" id="" class="form-control" required>
                                <option value="">Select Session</option>
                                @foreach ($sessiones as $session)
                                <option {{  $question->session_id == $session->id ? 'selected' : '' }}
                                    value="{{ $session->id }}">{{ $session->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger">{{ $errors->first('session_id') }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="" class="col-md-12">Examinaiton Type</label>
                        <div class="col-md-12">
                            <select name="examination_type_id" id="" class="form-control" required>
                                <option value="">Select One</option>
                                @foreach ($examTypies as $examtype)
                                <option {{ $question->examination_type_id == $examtype->id ? 'selected' : '' }}
                                    value="{{ $examtype->id }}">{{ $examtype->name }}</option>
                                @endforeach subjects
                            </select>
                            <div class="text-danger">{{ $errors->first('examination_type_id') }}</div>
                        </div>
                    </div>
                </div>
                 <div class="col-md-4">
                     <button type="submit" class="btn btn-primary">Update Question</button>
                </div>
               
                </form>

                <br />
                <hr />

                <div class="text-right"> <button data-toggle="modal" data-target="#addQuestionModal"
                        class="btn btn-primary">Add New Question</button> </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                @foreach ($question->mcqQuestions ? $question->mcqQuestions : null as $mcqQes)
                    <form action="{{ route('admin.mcq.update', $mcqQes->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="row" style="margin-bottom:5%;margin-top:5%;margin-left:5%;">
                            <input type="hidden" value="0" class="questionIndex" />
                            <div class="col-md-1">
                                <span class="badge badge-primary">
                                    {{ $loop->iteration }}
                                </span>
                            </div>
                            <div class="col-md-10"
                                style="border: 1px dashed #e2d1d1;padding-top:20px;padding-bottom:20px;margin-left:-5%;">
                                <div class="row">
                                    <div class="col-md-12 question">
                                        <div style="margin-bottom:10px;">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <textarea name="describe"  class="form-control mb-3" placeholder="leave empty if have not" rows="2">{{ $mcqQes->describe }}</textarea>
                                                </div>
                                                <div class="col-md-2">
                                                    <h5 style="text-align: right;">
                                                        Question :
                                                    </h5>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="form-group">
                                                         <textarea name="question" id="" class="form-control" required>{{ $mcqQes ? $mcqQes->question : null }}</textarea>
                                                    </div>

                                                    {{-- preview --}}
                                                    <img style="max-width:500px" id="image_preview_{{ $mcqQes->id }}">
                                                    @if ($mcqQes->image)
                                                        <img style="max-width:500px" src="{{ url($mcqQes->image) }}"
                                                            alt="Image">
                                                        <a href="{{ route('admin.mcq.question.image.destroy', $mcqQes->id) }}"
                                                            class="btn btn-outline-danger"><i class="fa fa-trash"></i>
                                                            Remove</a>
                                                    @else
                                                        <div class="form-group">
                                                            <input type="file" name="image" accept="image/*"
                                                                class="form-control-file"
                                                                onchange="upload(this,{{ $mcqQes->id }});">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div style="border-bottom: 1px dashed #efeaea;margin-bottom:15px;"></div>
                                        <div class="optionRows">
                                            @foreach ($mcqQes ? ($mcqQes->options ? $mcqQes->options : null) : null as $optio)

                                                <div class="row">
                                                    {{-- <input type="hidden" name="existing_ids[]" value="{{ $optio->id }}"> --}}
                                                    <div class="col-md-2">
                                                        <label for="">Pattern</label>
                                                        <input required name="pattern[]"
                                                            value="{{ $optio ? $optio->pattern : null }}" type="text"
                                                            type="text" class="form-control" style="margin-bottom:1%;">
                                                    </div>
                                                    <div class="col-md-7">
                                                        <label for="">Option</label>
                                                        <input required name="option[]"
                                                            value="{{ $optio ? $optio->option : null }}" type="text"
                                                            type="text" class="form-control" style="margin-bottom:1%;">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="">Answer</label>
                                                        <select name="answer[]" class="form-control"
                                                            style="margin-bottom:1%;">
                                                            <option value="0">False</option>
                                                            <option value="1"
                                                                {{ $optio->answer == 1 ? 'selected' : '' }}>
                                                                Correct</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-1 mt-4">
                                                        <a class="removeOption btn btn-outline-danger">X</a>
                                                    </div>
                                                </div>

                                            @endforeach
                                        </div>
                                        <div class="d-flex justify-content-between  mt-3">
                                            <a class="addOption btn btn-secondary"><i class="fa fa-plus"></i> Add Option</a>

                                            <button type="submit" class="btn btn-primary">Save Question</button>

                                            <a href="{{ route('admin.mcq.question.delete', $mcqQes->id) }}"
                                                onclick=" return confirm('Are you sure want to delete this question?')"
                                                class="btn btn-danger"><i class="fa fa-trash"></i> Delete Question</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addQuestionModal" tabindex="-1" role="dialog" aria-labelledby="addQuestionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addQuestionModalLabel">Add New Question</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.mcq.option.create', $question) }}" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                                <textarea name="describe" class="form-control mb-3" placeholder="leave empty if have not"
                                    rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Question</label>
                            <textarea name="question" class="form-control" required></textarea>
                        </div>

                        <div class="text-right">
                                <a class="addModalOption btn btn-secondary"><i class="fa fa-plus"></i></a>
                            </div>

                        <div class="optionRows">
                            
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Pattern</label>
                                    <select name="pattern[]" class="form-control" required>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="E">E</option>
                                            <option value="F">F</option>
                                    </select>
                                </div>
                                <div class="col-md-7">
                                    <input required="" name="option[]" type="text" class="form-control"
                                        style="margin-bottom:1%;">
                                </div>
                                <div class="col-md-2">
                                    <label>Answer</label>
                                    <select name="answer[]" class="form-control" style="margin-bottom:1%;">
                                        <option value="0">False</option>
                                        <option value="1">Correct</option>
                                    </select>
                                </div>
                                <div class="col-md-1 mt-4">
                                    <a class="removeOption btn btn-outline-danger">X</a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <img style="max-width:500px" id="image_preview_add_option">
                            <div class="form-group">
                                <input type="file" name="image" accept="image/*" class="form-control-file" onchange="upload(this,'add_option');">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@section('customjs')

    <script>
        var optionRow = `<div class="row">
                            <div class="col-md-2">
                                <select name="pattern[]" class="form-control" required>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="E">E</option>
                                            <option value="F">F</option>
                                    </select>
                            </div>
                            <div class="col-md-7">
                                <input required name="option[]" type="text" class="form-control" style="margin-bottom:1%;">
                            </div>
                            <div class="col-md-2">
                                <select name="answer[]" class="form-control" style="margin-bottom:1%;">
                                    <option value="0">False</option>
                                    <option value="1">Correct</option>
                                </select>
                            </div>
                            <div class="col-md-1 mt-4">
                                <a class="removeOption btn btn-outline-danger">X</a>
                            </div>
                        </div>`;

        // ADD NEW QUESTION OPTION
        $('.question').on('click', '.addOption', function() {
            let options = $(this).parent().siblings().closest('.optionRows');
            options.append(optionRow);
        });

        // ADD NEW QUESTION MODAL OPTION
        $('form').on('click', '.addModalOption', function() {
            console.log($(this).parent().siblings().closest('.optionRows'));
            let options = $(this).parent().siblings().closest('.optionRows');
            options.append(optionRow);
        });

        // REMOVE QUESTION OPTION
        $('.optionRows').on('click', '.removeOption', function() {
            let optionsCount = $(this).parent().parent().parent().children().length;
            if (optionsCount > 1) {
                $(this).parent().parent().remove();
            } else(
                toastr.info('At least one option need for a question')
            )
        });
    </script>



    <script>
        function upload(e, id) {
            console.log(e, id);
            var reader = new FileReader();
            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                document.getElementById("image_preview_" + id).src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(e.files[0]);
        }
    </script>
@endsection
