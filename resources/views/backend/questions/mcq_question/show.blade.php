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
                        <input type="text" disabled value="{{  $question->subjects?$question->subjects->name:NULL}}"
                            class="form-control" />
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="" class="col-md-12">Question No/Name/Others</label>
                    <div class="col-md-12">
                        <input type="text" disabled value="{{  $question->question_no}}" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="" class="col-md-12">Class</label>
                    <div class="col-md-12">
                        <input type="text" disabled value="{{  $question->classes?$question->classes->name:''}}"
                            class="form-control" />
                    </div>
                </div>

                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="form-group">
                        <label for="Subject">Chapter : </label>
                        <input type="text" disabled value="{{   $question->chapter?$question->chapter->name:'' }}"
                            class="form-control">
                        <div class="text-danger">{{ $errors->first('chapter_id') }}</div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="form-group">
                        <label for="class">Chapter Topic:</label>
                        <input type="text" disabled name="topic" value="{{ $question->topic }}"
                            placeholder="Chapter topic" class="form-control">
                        <div class="text-danger">{{ $errors->first('topic') }}</div>
                    </div>
                </div>


                <div class="col-md-4">
                    <label for="" class="col-md-12">Session</label>
                    <div class="col-md-12">
                        <input type="text" disabled value="{{  $question->sessiones?$question->sessiones->name:''  }}"
                            class="form-control" />
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="" class="col-md-12">Examinaiton Type</label>
                    <div class="col-md-12">
                        <input type="text" disabled value="{{  $question->examtypies?$question->examtypies->name:''}}"
                            class="form-control" />
                    </div>
                </div>
            </div>

            <br />
            <hr />

            @foreach($question->mcqQuestions?$question->mcqQuestions:NULL as $mcqQes)

            <div class="row" style="margin-bottom:5%;margin-top:5%;margin-left:5%;">
                <div class="col-md-10"
                    style="border: 1px dashed #e2d1d1;padding-top:20px;padding-bottom:20px;margin-left:-5%;">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="margin-bottom:10px;">
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <div>
                                            {{ $mcqQes->describe }}
                                        </div>
                                        @if ($mcqQes->image)
                                        <img src="{{ url($mcqQes->image) }}" alt="Image"
                                            style="width: 200px;padding: 20px">
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                       <b> #{{$loop->iteration}}) {!! $mcqQes?$mcqQes->question: NULL !!}</b>

                                    </div>
                                </div>
                            </div>
                            <div style="border-bottom: 1px dashed #efeaea;margin-bottom:15px;"></div>
                            @foreach($mcqQes?$mcqQes->options?$mcqQes->options : NULL : NULL as $optio)
                            <div class="row">
                                <div class="col-md-12 my-2">
                                   ({{$optio?$optio->pattern:NULL}}) {{$optio?$optio->option:NULL}}
                                    @if(($optio?$optio->answer:NULL) == 1)
                                    (<span class="text-success">Correct  <i class="fa fa-check-circle"></i> </span>)
                                    @endif
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