@extends('frontend.layouts.app')
@section('title',$batchsetting->batch_name)
@section('content')

<section class="brdc-section py-3 bgg">
        <div class="container section-box">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                             <li class="breadcrumb-item" aria-current="page">Batch Detail</li>
                             <li class="breadcrumb-item active" aria-current="page"> {{ $batchsetting->batch_name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
 


<section class="notic-section py-5 bgw">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-7">
                    <div class="batch_detail_text p-3">
                        <h4>Description - {{ $batchsetting->batch_name }}</h4>
                        <hr>
                         {!! $batchsetting->description !!} 
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="batch_box">
                        <h5><span>Batch Admission Fees</span> <span class="float-right"> <i class="fa fa-money"></i> {{ $batch_fee->amount }}</span></h5>
                        <hr>
                        <h5>Class : <span>{{ $batchsetting->classes?$batchsetting->classes->name:'' }} <span class="float-right">Session : {{ $batchsetting->sessiones?$batchsetting->sessiones->name:'' }}</span></span></h5>
                        <hr>
                        <div class="batch_day">
                            <p>Day of Class <span class="float-right btn btn-sm btn-primary">{{ $batchsetting->classtype?$batchsetting->classtype->name:'' }}</span></p>
                              <table class="table table-hovered table-bordered">
                                    <thead>
                                        <tr>
                                        <th>SL</th>
                                        <th>Day</th>
                                        <th>Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($batchsetting->dayandtime as $schedule)
                                    <tr>
                                        <td>01</td>
                                        <td>{{ $schedule->day?$schedule->day->name:'' }}</td>
                                        <td> {{ date('h:i A',strtotime($schedule->start_time)) }} to {{ date('h:i A',strtotime($schedule->end_time)) }}</td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>

                            <form action="{{ route('student.batch.admission') }}" method="post">
                                @csrf

                                <input type="hidden" name="batch_setting_id" value="{{ $batchsetting->id }}">
                                <input type="hidden" name="amount" value="{{ $batch_fee->amount }}">
                                 
                               <button class="btn btn-primary btn-sm">Submit</button>
                            </form>
 
                             
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@section('customjs')

 
@endsection
@endsection