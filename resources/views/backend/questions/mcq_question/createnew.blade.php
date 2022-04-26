@extends('backend.layouts.app')
@section('title', 'Add New Question')
@push('css')
<style>
    .text-danger {
        padding-left: 3%;
    }
</style>
@endpush
@section('content')



<div id="content" class="content">
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="form-stuff-10">
                <div class="panel-heading">
                    <h4 class="panel-title">Add Question</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand">
                            <i class="fa fa-expand"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                            data-click="panel-reload">
                            <i class="fa fa-redo"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse">
                            <i class="fa fa-minus"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                            data-click="panel-remove">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ route('admin.mcq.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row" style="margin-bottom:25px;">
                            <div class="col-md-6">
                                <label for="" class="col-md-12">Question No/Name/Others <small>(Unique)</small></label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="question_no"
                                        value="{{ old('question_no') }}" placeholder="Question No/Name/Others">
                                </div>
                                <div class="text-danger">{!! $errors->first('question_no') !!}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-12">Subject Name</label>
                                <div class="col-md-12">
                                    <select name="subject_id" id="subject_id" class="form-control" required>
                                        <option value="">Select One</option>
                                        @foreach ($subjects as $subject)
                                        <option {{ old('subject_id') == $subject->id ? 'selected' : '' }}
                                            value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{ $errors->first('subject_id') }}</div>
                                </div>
                            </div>


                        </div>



                        <div class="form-group row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <label for="Subject" class="col-md-12">Chapter :</label>
                                <div class="col-md-12">

                                    <select name="chapter_id" id="chapter_id" class="form-control">
                                        <option value="">Select Chapter</option>

                                    </select>
                                    <div class="text-danger">{{ $errors->first('chapter_id') }}</div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="class">Chapter Topic:</label>
                                    <input type="text" name="topic" value="{{ old('topic') }}"
                                        placeholder="Chapter topic" class="form-control">
                                    <div class="text-danger">{{ $errors->first('topic') }}</div>
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
                                        <option {{ old('class_id') == $class->id ? 'selected' : '' }}
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
                                        <option {{ old('session_id') == $session->id ? 'selected' : '' }}
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
                                        <option {{ old('examination_type_id') == $examtype->id ? 'selected' : '' }}
                                            value="{{ $examtype->id }}">{{ $examtype->name }}</option>
                                        @endforeach subjects
                                    </select>
                                    <div class="text-danger">{{ $errors->first('examination_type_id') }}</div>
                                </div>
                            </div>
                        </div>



                        <hr />
                        <br>
                        <br>




                        <div class="row" style="margin-bottom:5%;">
                            <input type="hidden" value="0" class="questionIndex" />
                            <div class="col-md-1"></div>
                            <div class="col-md-10"
                                style="border: 1px dashed #e2d1d1;padding-top:20px;padding-bottom:20px;margin-left:-5%;">
                                <div class="row">
                                    <div class="col-md-12">

                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif




                                        <div style="margin-bottom:10px;">
                                            <div class="row">


                                                <div class="col-md-12 mb-2">
                                                    <textarea name="describe[]" class="form-control"
                                                        placeholder="leave empty if have not" rows="2"></textarea>
                                                </div>
 

                                                <div class="col-md-1 mt-3">
                                                    <br><br><br>
                                                    <h5>#1)</h5> 
                                                </div>
                                                <div class="col-md-11">
                                                    <div class="form-group">
                                                        <img class="mb-2" alt="" style="max-width: 200px">
                                                        <input type="file" name="image[]" class="form-control-file"
                                                            accept="image/*">
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea name="question[]" type="text" class="form-control" placeholder="write your question here"
                                                            required></textarea>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div style="border-bottom: 1px dashed #efeaea;margin-bottom:15px;"></div>
                                        <div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="">Pattern</label>
                                                    <select name="0_pattern[]" class="form-control">
                                                        <option value="ক">ক</option>
                                                    </select>

                                                </div>
                                                <div class="col-md-7">
                                                    <label for="">Option</label>
                                                    <input name="0_option[]" type="text" class="form-control"
                                                        style="margin-bottom:1%;">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">Answer</label>
                                                    <select name="0_answer[]" class="form-control"
                                                        style="margin-bottom:1%;">
                                                        <option value="0">False</option>
                                                        <option value="1">Correct</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-1">
                                                    <label for="">&nbsp;</label>
                                                    <button type="button" data-appendid="0"
                                                        class="appendPatternOptionDiv btn btn-sm btn-primary"
                                                        style="margin-top: 25px;margin-left: -4px">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <select name="0_pattern[]" class="form-control">
                                                        <option value="খ">খ</option>
                                                    </select>

                                                </div>
                                                <div class="col-md-7">
                                                    <input name="0_option[]" type="text" class="form-control"
                                                        style="margin-bottom:1%;">
                                                </div>
                                                <div class="col-md-2">
                                                    <select name="0_answer[]" class="form-control"
                                                        style="margin-bottom:1%;">
                                                        <option value="0">False</option>
                                                        <option value="1">Correct</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <select name="0_pattern[]" class="form-control">
                                                        <option value="গ">গ</option>
                                                    </select>

                                                </div>
                                                <div class="col-md-7">
                                                    <input name="0_option[]" type="text" class="form-control"
                                                        style="margin-bottom:1%;">
                                                </div>
                                                <div class="col-md-2">
                                                    <select name="0_answer[]" class="form-control"
                                                        style="margin-bottom:1%;">
                                                        <option value="0">False</option>
                                                        <option value="1">Correct</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <select name="0_pattern[]" class="form-control">
                                                        <option value="ঘ">ঘ</option>
                                                    </select>

                                                </div>
                                                <div class="col-md-7">
                                                    <input name="0_option[]" type="text" class="form-control"
                                                        style="margin-bottom:1%;">
                                                </div>
                                                <div class="col-md-2">
                                                    <select name="0_answer[]" class="form-control"
                                                        style="margin-bottom:1%;">
                                                        <option value="0">False</option>
                                                        <option value="1">Correct</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="patternOptionDiv_0"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1" style="margin-right:-5%;">
                                <div style="position: absolute;bottom: 0;">
                                    <button data-appendWholeDiv="1" data-appendid="1" type="button"
                                        class="appendWholeQuestionDiv btn btn-sm btn-primary" style="margin-top: 25px;">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>


                        <div id="appendNewQuestion_1" class="wholeQNewAppendDiv">

                        </div>

                        <div class="row justify-content-around">
                            <a class="btn btn-danger" href="{{ route('admin.mcq.index') }}">Cancel</a>
                            <button type="submit" class="btn btn-primary">Submit</button>

                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection


@section('customjs')

<script>
    var qOptionIndex = 0;
        $(document).on('click', '.appendPatternOptionDiv', function(e) {
            e.preventDefault();
            qOptionIndex = $(this).data('appendid');

            $('.patternOptionDiv_' + qOptionIndex).append(`
            <div id="${qOptionIndex}_option_div">
                <div class="row">
                    <div class="col-md-2">
                        <select name="${qOptionIndex}_pattern[]" class="form-control">
                            <option value="ঙ">ঙ</option>
                            <option value="চ">চ</option>
                        </select>
                    </div>
                    <div class="col-md-7">
                        <input name="${qOptionIndex}_option[]"  type="text" class="form-control" style="margin-bottom:1%;">
                    </div>
                    <div class="col-md-2">
                        <select  name="${qOptionIndex}_answer[]"  class="form-control" style="margin-bottom:1%;">
                            <option value="0">False</option>
                            <option value="1">Correct</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="button" onclick="remove_question(this)" class="btn btn-sm btn-danger" >
                            <i class="fa fa-times" ></i>
                        </button>
                    </div>
                </div>
            </div>
            `);
        });
        $(document).on('click', '.removePatternOptionDiv', function(e) {
            e.preventDefault();
            var removeId = $(this).data('removeid');
            var len = ($('.count_' + removeId).length);
            if (removeId != 0 && len > 1) {
                $('#' + removeId + '_option_div').remove();
                qOptionIndex--;
            } else if (removeId == 0) {
                $('#' + removeId + '_option_div').remove();
                qOptionIndex--;
            }
        });


        var questionIndex = $('.questionIndex').val();
        var wqNex = 2;
        $(document).on('click', '.appendWholeQuestionDiv', function(e) {
            e.preventDefault();
            questionIndex++;
            var wq = $(this).data('appendwholediv');
            // console.log('wq ' + wq);

            $('#appendNewQuestion_' + wq).append(`
                <div class="row" style="margin-bottom:5%;">
                    <div class="col-md-1"></div>
                    <div class="col-md-10" style="border: 1px dashed #e2d1d1;padding-top:20px;padding-bottom:20px;margin-left:-5%;">
                        <div class="row">
                            <div class="col-md-12">
                                <div style="margin-bottom:10px;">
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <textarea name="describe[]" class="form-control" placeholder="leave empty if have not" rows="2"></textarea>
                                        </div>
                                        <div class="col-md-1 mt-3">
                                            <br><br><br>
                                            <h5>#${questionIndex+1})</h5>
                                        </div>
                                        <div class="col-md-11">
                                            <div class="form-group">
                                                <img class="mb-2" alt="" style="max-width: 200px">
                                                <input type="file" name="image[]" class="form-control-file" accept="image/*">
                                            </div>
                                            <div class="form-group">
                                                <textarea name="question[]" type="text" class="form-control" placeholder="write your question here"
                                                    required></textarea>
                                            </div>
                                    
                                        </div>
                                    </div>
                                </div>
                                <div  style="border-bottom: 1px dashed #efeaea;margin-bottom:15px;"></div>
                                <div id="${questionIndex}_option_div">
                                    <input type="hidden" value="${questionIndex}" class="questionIndex">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="">Pattern</label>
                                            <select name="${questionIndex}_pattern[]" class="form-control">
                                                <option value="ক">ক</option>
                                            </select>
                                    
                                        </div>
                                        <div class="col-md-7">
                                            <label for="">Option</label>
                                            <input name="${questionIndex}_option[]" type="text" class="form-control" style="margin-bottom:1%;">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="">Answer</label>
                                            <select name="${questionIndex}_answer[]" class="form-control" style="margin-bottom:1%;">
                                                <option value="0">False</option>
                                                <option value="1">Correct</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <label for="">&nbsp;</label>
                                            <button type="button" data-appendid="${questionIndex}" class="appendPatternOptionDiv btn btn-sm btn-primary"
                                                style="margin-top: 25px;margin-left: -4px">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <select name="${questionIndex}_pattern[]" class="form-control">
                                                <option value="খ">খ</option>
                                            </select>
                                    
                                        </div>
                                        <div class="col-md-7">
                                            <input name="${questionIndex}_option[]" type="text" class="form-control" style="margin-bottom:1%;">
                                        </div>
                                        <div class="col-md-2">
                                            <select name="${questionIndex}_answer[]" class="form-control" style="margin-bottom:1%;">
                                                <option value="0">False</option>
                                                <option value="1">Correct</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <select name="${questionIndex}_pattern[]" class="form-control">
                                                <option value="গ">গ</option>
                                            </select>
                                    
                                        </div>
                                        <div class="col-md-7">
                                            <input name="${questionIndex}_option[]" type="text" class="form-control" style="margin-bottom:1%;">
                                        </div>
                                        <div class="col-md-2">
                                            <select name="${questionIndex}_answer[]" class="form-control" style="margin-bottom:1%;">
                                                <option value="0">False</option>
                                                <option value="1">Correct</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <select name="${questionIndex}_pattern[]" class="form-control">
                                                <option value="ঘ">ঘ</option>
                                            </select>
                                    
                                        </div>
                                        <div class="col-md-7">
                                            <input name="${questionIndex}_option[]" type="text" class="form-control" style="margin-bottom:1%;">
                                        </div>
                                        <div class="col-md-2">
                                            <select name="${questionIndex}_answer[]" class="form-control" style="margin-bottom:1%;">
                                                <option value="0">False</option>
                                                <option value="1">Correct</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="patternOptionDiv_${questionIndex}"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1" style="margin-right:-5%;">
                        <div  style="position: absolute;bottom: 0;">
                            <button data-appendWholeDiv="${wqNex}" data-appendid="${questionIndex}" type="button" class="appendWholeQuestionDiv btn btn-sm btn-primary" style="margin-top: 25px;">
                            <i class="fa fa-plus" ></i>
                            </button>
                            <button  onclick="remove_question(this)" type="button" class="btn btn-sm btn-danger " style="margin-top: 25px;">
                                    <i class="fa fa-times" ></i>
                            </button>
                        </div>
                       
                    </div>
                </div>
                <div class="wholeQNewAppendDiv" id="appendNewQuestion_${wqNex}"></div>
            `);
            wqNex++;
        });

        function remove_question(question) {
            $(question).parent().parent().parent().remove();
            questionIndex--;
        }



        $(document).on('click', '.removeWholeQuestionDiv', function(e) {
            e.preventDefault();
            var removeWholeId = $(this).data('removewholequestion');
            console.log('current  ' + removeWholeId);
            //var len = ($('.count_'+removeWholeId).length);

            $('#appendNewQuestion_' + removeWholeId).remove();

            wqNex--;
            console.log('lase nex ' + wqNex + 'previous ' + removeWholeId);
        });
</script>


<script>
    $(document).on('keyup', '.type', function() {
            var id = $(this).data('id');
            var amount = nanCheck($('#checked_amount_id_' + id).val());
            if (amount) {
                $('#checked_id_' + id).prop('checked', true);
                $('#checked_id_' + id).val(id);
                $('#checked_id_' + id).show();
                $('#ids_' + id).val(id);
            } else {
                $('#checked_id_' + id).prop('checked', false);
                $('#checked_id_' + id).val('NULL');
                $('#checked_id_' + id).hide();
                $('#ids_' + id).val('');
            }
        })

        $(document).on('click', '.check_class', function() {
            var check_id = $(this).data('check_id');
            var checkValue = $('#checked_amount_id_' + check_id).val();

            if ($(this).is(':checked')) {
                $('#checked_id_' + check_id).val(check_id);
                $('#checked_amount_id_' + check_id).val(checkValue);
                $('#ids_' + check_id).val(check_id);
            } else {
                $('#checked_id_' + check_id).val('NULL');
                $('#checked_amount_id_' + check_id).val('');
                $('#checked_id_' + check_id).hide();
                $('#ids_' + check_id).val('');
            }

        });


        function nanCheck(val) {
            var total = val;
            if (isNaN(val)) {
                var total = 0;
            }
            return total;
        }
</script>


<script>
    $('form').on('change', 'input[type="file"]', function(e) {

            var img = e.target.previousElementSibling;
            var reader = new FileReader();
            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                img.src = e.target.result
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
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
</script>


@endsection

