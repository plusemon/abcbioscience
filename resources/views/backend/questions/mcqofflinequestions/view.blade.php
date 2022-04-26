@extends('backend.layouts.app')
@section('title','MCQ Offline Exam Questions')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">MCQ Offline Exam Questions</h4>
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

                <a href="{{ route('mcqoffline.create') }}" class="btn btn-primary btn-sm float-right mb-1" id="create-new-class"><i class="fa fa-plus"></i> Add Mcq offline Question</a>



                 <form action="" method="get" class="form-inline mb-3">


                       

                    <select name="class_id" id="class_id" class="class_id form-control mr-3" >
                        <option value="">Select Class</option>
                        @foreach($classes as $class)
                            <option @if(isset($class_id)) {{ $class_id == $class->id ? 'selected' :'' }} @endif value="{{ $class->id }}"> {{ $class->name }}</option>
                        @endforeach
                    </select>

                    <select name="session_id" id="session_id" class="session_id form-control mr-3" >
                        <option value="">Select Session</option>
                        @foreach($sessiones as $session)
                            <option @if(isset($session_id)) {{ $session_id == $session->id ? 'selected' :'' }} @endif value="{{ $session->id }}"> {{ $session->name }}</option>
                        @endforeach
                    </select>

                     <select name="subject_id" id="subject_id" class="subject_id form-control mr-3" >
                        <option value="">Select Subject</option>
                        @foreach($subjects as $subject)
                            <option @if(isset($subject_id)) {{ $subject_id == $subject->id ? 'selected' :'' }} @endif value="{{ $subject->id }}"> {{ $subject->name }}</option>
                        @endforeach
                    </select>

                    
                      <select name="chapter_id" id="chapter_id" class="form-control chapter_id mr-3" >
                        <option value="">Select Chapter</option>
                       
                    </select>



                    <button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-search"></i>  Search</button>
                    
                </form>





                

                <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
                    <thead>
                    <tr>
                        <th class="text-nowrap">SL</th>
                        <th class="text-nowrap">Question No/Name</th>
                        <th class="text-nowrap">Subject Name</th>
                        <th class="text-nowrap">Chapter</th>
                        <th class="text-nowrap">Topic Name</th>
                        <th class="text-nowrap">Class</th>
                        <th class="text-nowrap">Examination Type</th>
                        <th class="text-nowrap">Total Mark</th>
                        <th class="text-nowrap">Status</th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($mcqofflinequestions as $question)

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $question->question_no }}</td>
                            <td>{{ $question->subject?$question->subject->name:'' }}</td>
                            <td>{{ $question->chapter?$question->chapter->name:'' }}</td>
                            <td>{{ $question->topic }}</td>
                            <td>{{ $question->classes?$question->classes->name:'' }}</td>
                            <td>{{ $question->ExamTypies?$question->ExamTypies->name:'' }}</td>
                            <td>{{ $question->total_mark }}</td>
                            <td>
                                 @if($question->status==1)
                                    <span class="btn btn-primary btn-sm">Active</span>
                                @elseif($question->status==2)
                                    <span class="btn btn-danger btn-sm">inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('mcqoffline.edit',$question->id) }}" class="btn btn-primary btn-sm"> Edit</a>
                                <a href="{{ route('admin.mcqoffline-setting.create','qid='.$question->id) }}" class="btn btn-primary btn-sm"> Setting</a>

                                <form action="{{ route('mcqoffline.destroy',$question->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                 
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$mcqofflinequestions->links()}}
            </div>





        </div>
    </div>



@section('customjs')

    <script>
        
 
      $(document).on('change','#subject_id', function () {

            var subject_id    = $('#subject_id').val();

              $.ajax({
                    type: "get",
                    url: "{{ route('getchapter') }}",
                    data: {subject_id:subject_id},
                    success: function (data) {
                        if(data.status == true)
                        {
                            $("#chapter_id").html(data);
                        }else{
                            $("#chapter_id").html(data);
                        }
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
        });
 
  
    </script>

  

    

@endsection
@endsection
