@extends('backend.layouts.app')
@section('title', 'Add New Question')
@push('css')
    <style>
        .text-danger{
            padding-left:3%;
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
                                    <div class="text-danger">{{ $errors->first('question_no') }}</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-md-12">Subject Name</label>
                                    <div class="col-md-12">
                                        <select name="subject_id" id="" class="form-control" required>
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
                            {{--  <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="" class="col-md-12">Batch</label>
                                    <div class="col-md-12">
                                        <select name="batch_id" id="" class="form-control" required>
                                            <option value="">Select Batch</option>
                                            @foreach ($batches as $batch)
                                                <option {{ old('batch_id') == $batch->id ? 'selected' : '' }}
                                                    value="{{ $batch->id }}">{{ $batch->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>  --}}

                            {{--   <div style="border:0.5px solid #d5e6e6;margin-left:1%;margin-right:2%">
                                <div style="margin-top:2%;margin-bottom:2%;">
                                </div>
                            </div>  --}}

                            <hr/>
                            <br>
                            <br>


                                <div class="row" style="margin-bottom:5%;">
                                    <input type="hidden" value="0" class="questionIndex" />
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10" style="border: 1px dashed #e2d1d1;padding-top:20px;padding-bottom:20px;margin-left:-5%;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div style="margin-bottom:10px;">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <h5 style="text-align: right;">
                                                                Question :
                                                            </h5>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <input name="question[]" type="text" class="form-control">
                                                            <div class="text-danger">{{ $errors->first('question') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div  style="border-bottom: 1px dashed #efeaea;margin-bottom:15px;"></div>
                                                <div >
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <label for="">Pattern</label>
                                                            <input name="0_pattern[]"  type="text" class="form-control" style="margin-bottom:1%;">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="">Option</label>
                                                            <input name="0_option[]"  type="text" class="form-control" style="margin-bottom:1%;">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label for="">Answer</label>
                                                            <select  name="0_answer[]"  class="form-control" style="margin-bottom:1%;">
                                                                <option value="0">False</option>
                                                                <option value="1">Correct</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label for="">&nbsp;</label>
                                                            <button type="button" data-appendid="0" class="appendPatternOptionDiv btn btn-sm btn-primary" style="margin-top: 25px;margin-left: -4px">
                                                                <i class="fa fa-plus" ></i>
                                                            </button>
                                                            <button type="button" data-removeId="0" class="btn btn-sm btn-danger" style="margin-top: 25px;">
                                                                <i class="fa fa-times" ></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="patternOptionDiv_0"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1" style="margin-right:-5%;">
                                        <div  style="position: absolute;bottom: 0;">
                                            <button data-appendWholeDiv="1" data-appendid="1" type="button" class="appendWholeQuestionDiv btn btn-sm btn-primary" style="margin-top: 25px;">
                                            <i class="fa fa-plus" ></i>
                                            </button>
                                            {{-- <button type="button" class="btn btn-sm btn-danger" style="margin-top: 25px; ">
                                                <i class="fa fa-times" ></i>
                                            </button> --}}
                                        </div>
                                    </div>
                                </div>


                                <div id="appendNewQuestion_1" class="wholeQNewAppendDiv">

                                </div>


                            <br><br><br>




                            <button type="submit" class="btn btn-sm btn-primary m-r-5 pull-right">Submit</button>
                            <a class="btn btn-sm btn-danger pull-right" href="{{ route('admin.mcq.index') }}">Cancel</a>

                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>













@section('customjs')


    <script>
        var qOptionIndex = 0;
        $(document).on('click','.appendPatternOptionDiv',function(e){
            e.preventDefault();
            qOptionIndex =  $(this).data('appendid');

            $('.patternOptionDiv_'+qOptionIndex).append(`
            <div id="${qOptionIndex}_option_div">
                <div class="row">
                    <div class="col-md-2">
                        <input name="${qOptionIndex}_pattern[]"  type="text" class="form-control" style="margin-bottom:1%;">
                    </div>
                    <div class="col-md-6">
                        <input name="${qOptionIndex}_option[]"  type="text" class="form-control" style="margin-bottom:1%;">
                    </div>
                    <div class="col-md-2">
                        <select  name="${qOptionIndex}_answer[]"  class="form-control" style="margin-bottom:1%;">
                            <option value="0">False</option>
                            <option value="1">Correct</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="button" data-appendid="${qOptionIndex}" class="appendPatternOptionDiv btn btn-sm btn-primary" >
                            <i class="fa fa-plus" ></i>
                        </button>
                        <button type="button" data-removeid="${qOptionIndex}"  class="removePatternOptionDiv count_${qOptionIndex} btn btn-sm btn-danger" >
                            <i class="fa fa-times" ></i>
                        </button>
                    </div>
                </div>
            </div>
            `);
        });
        $(document).on('click','.removePatternOptionDiv',function(e){
            e.preventDefault();
            var removeId = $(this).data('removeid');
            var len = ($('.count_'+removeId).length);
            if(removeId != 0 && len > 1)
            {
                $('#'+removeId+'_option_div').remove();
                qOptionIndex--;
            }
            else if(removeId == 0)
            {
                $('#'+removeId+'_option_div').remove();
                qOptionIndex--;
            }
        });


        var questionIndex = $('.questionIndex').val();
        var wqNex= 2;
        $(document).on('click','.appendWholeQuestionDiv',function(e){
            e.preventDefault();
            questionIndex++;
            var wq = $(this).data('appendwholediv');
            console.log('wq '+ wq);

            $('#appendNewQuestion_'+wq).append(`
                <div class="row" style="margin-bottom:5%;">
                    <div class="col-md-1"></div>
                    <div class="col-md-10" style="border: 1px dashed #e2d1d1;padding-top:20px;padding-bottom:20px;margin-left:-5%;">
                        <div class="row">
                            <div class="col-md-12">
                                <div style="margin-bottom:10px;">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <h5 style="text-align: right;">
                                                Question :
                                            </h5>
                                        </div>
                                        <div class="col-md-10">
                                            <input name="question[]" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div  style="border-bottom: 1px dashed #efeaea;margin-bottom:15px;"></div>
                                <div id="${questionIndex}_option_div">
                                    <input type="hidden" value="${questionIndex}" class="questionIndex">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <input name="${questionIndex}_pattern[]"  type="text" class="form-control" style="margin-bottom:1%;">
                                        </div>
                                        <div class="col-md-6">
                                            <input name="${questionIndex}_option[]"  type="text" class="form-control" style="margin-bottom:1%;">
                                        </div>
                                        <div class="col-md-2">
                                            <select  name="${questionIndex}_answer[]"  class="form-control" style="margin-bottom:1%;">
                                                <option value="0">False</option>
                                                <option value="1">Correct</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" data-appendid="${questionIndex}" class="appendPatternOptionDiv btn btn-sm btn-primary" >
                                                <i class="fa fa-plus" ></i>
                                            </button>
                                            <button type="button"  data-removeid="" disabled  class="btn btn-sm btn-danger" >
                                                <i class="fa fa-times" ></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="patternOptionDiv_${questionIndex}"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1" style="margin-right:-5%;">
                        <div  style="position: absolute;bottom: 0;">
                            <button data-appendWholeDiv="${wqNex}" data-appendid="2" type="button" class="appendWholeQuestionDiv btn btn-sm btn-primary" style="margin-top: 25px;">
                            <i class="fa fa-plus" ></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="wholeQNewAppendDiv" id="appendNewQuestion_${wqNex}"></div>
            `);
            wqNex++;
        });

        $(document).on('click','.removeWholeQuestionDiv',function(e){
            e.preventDefault();
            var removeWholeId = $(this).data('removewholequestion');
            console.log('current  '+removeWholeId);
            //var len = ($('.count_'+removeWholeId).length);

            $('#appendNewQuestion_'+removeWholeId).remove();

            wqNex--;
            console.log('lase nex '+ wqNex +'previous '+ removeWholeId);
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
@endsection
@endsection

{{-- -
        <button data-removeWholeQuestion="${wqNex-1}" type="button" class="removeWholeQuestionDiv btn btn-sm btn-danger" style="margin-top: 25px; ">
                                <i class="fa fa-times" ></i>
                            </button>
    --}}
