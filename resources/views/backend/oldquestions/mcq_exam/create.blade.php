@extends('backend.layouts.app')
@section('title','MCQ Questions View')
@push('css')
    <style>
        *					{ margin: 0; padding: 0; }
        body				{ font: 14px Georgia, serif; }

        #page-wrap		    { width: 500px; margin: 0 auto; }

        h1                  { margin: 25px 0; font: 14px Georgia, Serif; text-transform: uppercase; letter-spacing: 3px; }

        #quiz input {
            vertical-align: middle;
        }
        #quiz ol {
            margin: 0 0 10px 20px;
        }
        
        #quiz ol li {
            margin: 0 0 20px 0;
        }
        
        #quiz ol li div {
            padding: 4px 0;
        }
        
        #quiz h3 {
            font-size: 17px; margin: 0 0 1px 0; color: #666;
        }
        
        #results {
            font: 44px Georgia, Serif;
        }
        .radio-clickable{
            cursor:pointer;
        }
    </style>
@endpush
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
                            <input type="text" disabled value="{{ $question->subjects?$question->subjects->name:NULL}}" class="form-control"  />
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
                    Time : <div class="countdown">  </div>
                
                <div id="page-wrap">

                    <h1>
                        Final Quiz for Test 
                        <span style="margin-left:20px;" class="minute"></span>
                    </h1>
                    
                    <form action="{{route('admin.exam.question.store')}}" method="post"  name="submitForm">
                        @csrf

                        <input type="hidden" name="student_id" value="1" />
                        <input type="hidden" name="batch_setting_id" value="1" />
                        <input type="hidden" name="class_id" value="1" />
                        <input type="hidden" name="session_id" value="1" />
                        <input type="hidden" name="examination_type_id" value="1" />
                        <input type="hidden" name="mcq_exam_setting_id" value="1" />
                        <input type="hidden" name="mcq_question_subject_id" value="1" />
                        <input type="hidden" name="subject_id" value="1" />

                        <ol>
                            @foreach($question->mcqQuestions?$question->mcqQuestions:NULL  as $key=> $mcqQes)
                            <li>
                                <h3>
                                    {{$mcqQes?$mcqQes->question: NULL}}
                                    <input type="hidden" value="{{$mcqQes?$mcqQes->id: NULL}}" name="question_no_{{$key}}" />
                                    <input type="hidden" value="{{$mcqQes?$mcqQes->id: NULL}}" name="questions[]" />
                                </h3>
                                
                                @foreach($mcqQes?$mcqQes->options?$mcqQes->options : NULL : NULL as $optio)
                                <div style="width:100%;">
                                    <input type="radio" name="question_option_{{$key}}" value="{{$optio?$optio->id:NULL}}" class="radio-clickable" />
                                    <label style="padding-left:2%;">
                                        <span>{{$optio?$optio->pattern:NULL}})</span>&nbsp; &nbsp; <span> {{$optio?$optio->option:NULL}} </span>
                                    </label>
                                </div>
                                @if(($optio?$optio->answer:NULL) == 1)
                                    <input type="hidden" value="{{$optio?$optio->id:NULL}}" name="question_answer_{{$key}}" />
                                @endif
                                @endforeach
                            </li> <br/>
                            @endforeach
                        
                        </ol>
                        
                        <input type="submit" value="Sumit" />
                    
                    </form>
                
                </div>
                

            </div>
        </div>
    </div>


    <input type="hidden" id="expireTime" value="merchantLoginOptExpireTime_HS">
    <input type="hidden" id="remainingTime" value="{{$remaingTime}}">
    {{--  <script>
        function otpTimeExpire(action){
           
                var date = new Date();
                  
                var getMin = date.getMinutes();
                var getSec = date.getSeconds();

                //============================
              var expairTime =   parseInt($('#expireTime').val());
              var expairTimeType =  $('#expireTimeType').val();
              var  minuteToSecond = 1;
             
              if(expairTimeType == 'minutes')
              {
                 minuteToSecond += (expairTime * 60);
                
              } 
              if(expairTimeType == 'seconds')
              {
                 minuteToSecond += expairTime ;
              }
              
                //var countDownDate=   date.setMinutes(getMin+2.20);
                var countDownDate=   date.setSeconds(getSec+minuteToSecond);

             
            // Update the count down every 1 second
            var x = setInterval(function() {

              // Get today's date and time
              var now = new Date().getTime();
                
              // Find the distance between now and the count down date
              var distance = countDownDate - now;
                if(action != "start")
                {
                    distance = -1;
                }
              // Time calculations for days, hours, minutes and seconds
              /*var days = Math.floor(distance / (1000 * 60 * 60 * 24));
              var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));*/
              var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
              var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                
              // Output the result in an element with id="demo"
              // document.getElementById("demo").innerHTML = days + "d " + hours + "h "
              //+ minutes + "m " + seconds + "s ";
                
                if(distance > 0)
                {
                    document.getElementById("demo").innerHTML = minutes + " : " +seconds;
                }
              // If the count down is over, write some text 
              if (distance < 0) {
                
                stopInterval(x);
                clearInterval(x);
                
                    document.getElementById("demo").innerHTML = "";
                    $('#demo').val('Time Expired');
                    $('#otp').hide();
                    $('#login').hide();
                    $('#errorMessage').hide();
                    $('#sendOtp').attr('disabled','disabled');
              }
            }, 1000);
                
        }//function
          
            function stopInterval(myInterval) {
                clearInterval(myInterval);
            }      
    </script>


    <script>
            function Interval(fn, time) {
                var timer = false;
                this.start = function () {
                    if (!this.isRunning())
                        timer = setInterval(fn, time);
                };
                this.stop = function () {
                    clearInterval(timer);
                    timer = false;
                };
                this.isRunning = function () {
                    return timer !== false;
                };
            }

            var i = new Interval(fncName, 1000);
            i.start();

            if (i.isRunning())
                // ...
            i.stop();
    </script>  
    --}}

    {{---
        var timer2 = "5:01";
        var interval = setInterval(function() {


        var timer = timer2.split(':');
        //by parsing integer, I avoid all extra string processing
        var minutes = parseInt(timer[0], 10);
        var seconds = parseInt(timer[1], 10);
        --seconds;
        minutes = (seconds < 0) ? --minutes : minutes;
        if (minutes < 0) clearInterval(interval);
        seconds = (seconds < 0) ? 59 : seconds;
        seconds = (seconds < 10) ? '0' + seconds : seconds;
        //minutes = (minutes < 10) ?  minutes : minutes;
        $('.countdown').html(minutes + ':' + seconds);
        timer2 = minutes + ':' + seconds;
        }, 1000);
    --}}

    

    @section('customjs')
    <script>
        $(document).ready(function(){

                var timer2 = "00:20"//$('#remainingTime').val();//"00:10";

                var interval = setInterval(function() {
                    var timer = timer2.split(':');
                    //by parsing integer, I avoid all extra string processing
                    var minutes = parseInt(timer[0], 10);
                    var seconds = parseInt(timer[1], 10);
                    --seconds;
                    minutes = (seconds < 0) ? --minutes : minutes;
                    if (minutes < 0){
                        redirect();
                        clearInterval(interval);
                    } 
                    seconds = (seconds < 0) ? 59 : seconds;
                    seconds = (seconds < 10) ? '0' + seconds : seconds;
                    //minutes = (minutes < 10) ?  minutes : minutes;
                    //$('.countdown').html(minutes + ':' + seconds);
                    $('.countdown').text(minutes + ':' + seconds);
                    timer2 = minutes + ':' + seconds;
                }, 1000);
            function redirect() {
                document.submitForm.submit();
            }
        });
    </script>

        <script>
            $(document).ready(function(){


                window.onload=function(){ 
                    
                    var counter = 10;
                    var interval = setInterval(function() {
                        counter--;
                        $(".minute").text(counter);
                        if (counter == 0) {
                            //redirect();
                            clearInterval(interval);
                        }
                    }, 1000);


                    //window.setTimeout(function() {
                      //  redirect(); 
                    //}, 5000);
                };
                
                //function redirect() {
                    //document.submitForm.submit();
                //}
                
            });
        </script>
    @endsection
@endsection
