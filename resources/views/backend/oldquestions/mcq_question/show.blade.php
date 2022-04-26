@extends('backend.layouts.app')
@section('title','MCQ Questions View')
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
                        <label class="col-md-12">Subject Name</label>
                        <div class="col-md-12">
                            <input type="text" disabled value="{{  $question->subjects?$question->subjects->name:NULL}}" class="form-control"  />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="" class="col-md-12">Question No/Name/Others</label>
                        <div class="col-md-12">
                            <input type="text" disabled value="{{  $question->question_no}}" class="form-control"  />
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="" class="col-md-12">Class</label>
                        <div class="col-md-12">
                           <input type="text" disabled value="{{  $question->classes?$question->classes->name:''}}" class="form-control"  />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="" class="col-md-12">Session</label>
                        <div class="col-md-12">
                            <input type="text" disabled value="{{  $question->sessiones?$question->sessiones->name:''  }}" class="form-control"  />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="" class="col-md-12">Examinaiton Type</label>
                        <div class="col-md-12">
                            <input type="text" disabled value="{{  $question->examtypies?$question->examtypies->name:''}}" class="form-control"  />
                        </div>
                    </div>
                </div>
                
                <br/>
                <hr/>
                
                @foreach($question->mcqQuestions?$question->mcqQuestions:NULL as $mcqQes)

                <div class="row" style="margin-bottom:5%;margin-top:5%;margin-left:5%;">
                    <input type="hidden" value="0" class="questionIndex" />
                    <div class="col-md-1">
                        <span class="badge badge-primary">
                            {{$loop->iteration}}
                        </span>
                    </div>
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
                                            <input value="{{$mcqQes?$mcqQes->question: NULL}}" disabled type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div  style="border-bottom: 1px dashed #efeaea;margin-bottom:15px;"></div>
                                @foreach($mcqQes?$mcqQes->options?$mcqQes->options : NULL : NULL as $optio)
                                <div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="">Pattern</label>
                                            <input value="{{$optio?$optio->pattern:NULL}}" disabled type="text"   type="text" class="form-control" style="margin-bottom:1%;">
                                        </div>
                                        <div class="col-md-7">
                                            <label for="">Option</label>
                                            <input value="{{$optio?$optio->option:NULL}}" disabled type="text"   type="text" class="form-control" style="margin-bottom:1%;">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="">Answer</label>
                                            @if(($optio?$optio->answer:NULL) == 1)
                                            <input value="{{ ($optio?$optio->answer:NULL) == 1 ? 'Correct' : "False" }}" disabled type="text"   type="text" class="form-control" style="margin-bottom:1%;background-color:green;color:white;font-weight:700;">
                                            @else
                                            <input value="{{ ($optio?$optio->answer:NULL) == 1 ? 'Correct' : "False" }}" disabled type="text"   type="text" class="form-control" style="margin-bottom:1%;background-color:red;color:white;font-weight:700;">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="patternOptionDiv_0"></div>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach

            </div>
        </div>
    </div>

@endsection
