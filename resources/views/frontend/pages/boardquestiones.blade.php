@extends('frontend.layouts.app')
@section('title','Board Questions')
@section('content')

  

 <section class="question-section py-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <div class="col-12">
                            <div class="section-title">
                                <h4 class="after-dot">Board Questions</h4>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 py-5">


                <form class="form-inline" method="get" action="">
                  <div class="form-group mb-2 mr-2">
                  
                    <select name="type_id" id="subject_code" class="form-control">
                            <option value="">Select Exam</option>
                            @foreach($board_questions as $board_question)
                                <option @if(isset($type_id)) {{ $type_id == $board_question->id ? 'selected' : '' }}  @endif value="{{ $board_question->id }}"> {{ $board_question->name }}</option>
                            @endforeach
                    </select>
                  </div> 

                  <div class="form-group mb-2 mr-2">
                  
                    <select name="year_id" id="year_id" class="form-control">
                            <option value="">Select Year</option>
                            @foreach($years as $year)
                                <option  @if(isset($year_id)) {{ $year_id == $year->id ? 'selected' : '' }}  @endif value="{{ $year->id }}"> {{ $year->name }}</option>
                            @endforeach
                    </select>
                  </div>


                    <div class="form-group mb-2 mr-2">
                        
                        <select name="subject_id" id="subject_code" class="form-control">
                             <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                                <option @if(isset($subject_id)) {{ $subject_id == $subject->id ? 'selected' : '' }}  @endif value="{{ $subject->id }}"> {{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div> 


                  <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i> Search</button>
                </form>



                <div class="table-responsive">
                     <table id="" class="table table-striped table-bordered table-td-valign-middle">
                        <thead>
                        <tr>
                            <th class="text-nowrap">SL</th>
                            <th class="text-nowrap">Board </th>
                            <th class="text-nowrap">Board Question</th>
                            <th class="text-nowrap">Year</th>
                            <th class="text-nowrap">Subject</th>
                            
                            <th class="text-nowrap">Question File</th>
                            
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($boardquestiones as $old_qus)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{ $old_qus->boardname?$old_qus->boardname->name:''}}</td>
                                <td>{{ $old_qus->boardquestiontype?$old_qus->boardquestiontype->name:''}}</td>
                                <td>{{ $old_qus->year?$old_qus->year->name:''  }} </td>
                                <td>{{ $old_qus->subject_id}}</td>
                                 
                                <td>
                                    <a href="{{asset($old_qus->questionfile)}}" download="" class="btn btn-primary btn-sm"> <i class="fa fa-download"></i> Download
                                    </a> 
                                    <a href="{{ asset($old_qus->questionfile) }}" title="" class="btn btn-info btn-sm"> <i class="fa fa-eye"></i> Preview</a>
                                </td>

                                 
                                 
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                   </div>   
                {{ $boardquestiones->links() }}
                </div>
            </div>
        </div>
    </section>


@endsection