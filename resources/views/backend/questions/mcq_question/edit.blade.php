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

                <div class="form-group row" style="margin-bottom:25px;">

                    <div class="col-md-6">
                        <label for="" class="col-md-12">Question No/Name/Others</label>
                        <div class="col-md-12">
                            <input type="text" disabled value="{{ $question->question_no }}" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-md-12">Subject Name</label>
                        <div class="col-md-12">
                            <input type="text" disabled value="{{ $question->subjects ? $question->subjects->name : null }}"
                                   class="form-control" />
                        </div>
                    </div>

                </div>


                <div class="form-group row" style="margin-bottom:25px;">


                    <div class="col-md-6">
                        <label class="col-md-12">Chapter</label>
                        <div class="col-md-12">
                            <input type="text" disabled value="{{ $question->chapter ? $question->chapter->name : null }}"
                                   class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="col-md-12">Topic</label>
                        <div class="col-md-12">
                            <input type="text" disabled value="{{ $question->topic }}" class="form-control" />
                        </div>
                    </div>

                </div>



                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="" class="col-md-12">Class</label>
                        <div class="col-md-12">
                            <input type="text" disabled value="{{ $question->classes ? $question->classes->name : '' }}"
                                   class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="" class="col-md-12">Session</label>
                        <div class="col-md-12">
                            <input type="text" disabled value="{{ $question->sessiones ? $question->sessiones->name : '' }}"
                                   class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="" class="col-md-12">Examinaiton Type</label>
                        <div class="col-md-12">
                            <input type="text" disabled value="{{ $question->examtypies ? $question->examtypies->name : '' }}"
                                   class="form-control" />
                        </div>
                    </div>
                </div>

                <br />
                <hr />

                <div class="text-right"> <button data-toggle="modal" data-target="#addQuestionModal" class="btn btn-primary">Add
                        New Question</button> </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div id="question_list">

                </div>

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
                <form action="{{ route('admin.mcq.option.create', $question) }}" method="POST" enctype="multipart/form-data"
                      onsubmit="ajaxSave()">
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
                                        <option value="ক">ক</option>
                                        <option value="খ">খ</option>
                                        <option value="গ">গ</option>
                                        <option value="ঘ">ঘ</option>
                                    </select>
                                </div>
                                <div class="col-md-7">
                                    <input required="" name="option[]" type="text" class="form-control" style="margin-bottom:1%;">
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
                                <input type="file" name="image" accept="image/*" class="form-control-file"
                                       onchange="upload(this,'add_option');">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-secondary" type="reset">Reset</button>
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
                                            <option value="ক">ক</option>
                                            <option value="খ">খ</option>
                                            <option value="গ">গ</option>
                                            <option value="ঘ">ঘ</option>
                                            <option value="ঙ">ঙ</option>
                                            <option value="চ">চ</option>
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
        $(document).on('click', '.addOption', function() {
            let options = $(this).parent().siblings().closest('.optionRows');
            options.append(optionRow);
        });


        // get options ajax
        $(document).ready(function() {
            getQuestions();
        });

        function getQuestions() {
            let url = '{{ request()->url() }}';
            $.get(url).done(res => {
                // console.log(res);
                $('#question_list').html(res);
            });
        }

        // ADD NEW QUESTION MODAL OPTION
        $('form').on('click', '.addModalOption', function() {
            console.log($(this).parent().siblings().closest('.optionRows'));
            let options = $(this).parent().siblings().closest('.optionRows');
            options.append(optionRow);
        });

        // when form submit
        function ajaxSave() {

            // $('#addQuestionModal input ')
            let formData = $(this.event.target).serializeArray();

            $.post("{!! route('admin.mcq.option.create', $question) !!}", formData,
                function(data, textStatus, jqXHR) {
                    // console.log(data);

                    if (data.success) {
                        toastr.success(data.message);
                        $('#addQuestionModal').modal('hide');
                        getQuestions();
                        // location.reload()
                    } else {
                        toastr.error(data.message);
                    }
                },
                "json"
            );


            this.event.preventDefault();
        }

        // REMOVE QUESTION OPTION
        $(document).on('click', '.removeOption', function() {
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
