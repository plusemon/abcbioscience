@extends('frontend.layouts.app')
@section('title','School Questions')
@section('content')

  

 <section class="question-section py-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <div class="col-12">
                            <div class="section-title">
                                <h4 class="after-dot">School Questions</h4>
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
                        <select name="class_id" id="class" class="form-control">
                            <option value="">Select Class</option>
                            @foreach($classs as $class)
                                <option value="{{ $class->id }}"> {{ $class->name }}</option>
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

                    <div class="form-group mb-2 mr-2">
                        
                        <select name="exam_type_id" id="class" class="form-control">
                            <option value="">Select Exam Type</option>
                            @foreach($exams as $exam)
                                <option value="{{ $exam->id }}"> {{ $exam->name }}</option>
                            @endforeach
                        </select>
                    </div>


                  <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i> Search</button>
                </form>


                <div class="table-responsive">    
                     <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
                        <thead>
                        <tr>
                            <th class="text-nowrap">Serial No</th>
                            <th class="text-nowrap">School Name</th>
                            <th class="text-nowrap">Year</th>
                            <th class="text-nowrap">Class</th>
                            <th class="text-nowrap">Subject</th>
                            <th class="text-nowrap">Exam Type</th>
                            <th class="text-nowrap">Question File</th>
                            
                         
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($schoolquestiones as $old_qus)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$old_qus->schoolname}}</td>
                                <td>{{ $old_qus->year?$old_qus->year->name:''  }} </td>
                                <td>{{ $old_qus->classes?$old_qus->classes->name:''}}</td>
                                <td>{{ $old_qus->subject_id}}</td>
                                <td>{{ $old_qus->examtype?$old_qus->examtype->name:''}}</td>
                               
                            
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
                {{ $schoolquestiones->links() }}
                </div>
            </div>
        </div>
    </section>


@endsection