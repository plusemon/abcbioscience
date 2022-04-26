@extends('backend.layouts.app')
@section('title','Extra Exam')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Extra Exam</h4>
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
                
                  <form action="{{ route('extra.exam.csv.upload') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    
                   <input type="hidden" name="extra_exam_id" value="{{ $extraExam->id }}">

                    <div class="form-group">
                        <label for="">Student File</label>
                        <input type="file" name="exam_file" placeholder="exam_file" valu="{{ old('exam_file') }}" class="form-control">
                    </div>
                
                
                  <div class="form-group">

                        <button class="btn btn-primary">Upload</button>
                    </div>

                </form>

                
                
                
                
                <form action="{{ route('extraexamdetail.store') }}" method="post">
                    @csrf

                    <input type="hidden" name="extra_exam_id" value="{{ $extraExam->id }}">

                    <div class="form-group">
                        <label for="">Student Name</label>
                        <input type="text" name="name" placeholder="name" value="{{ old('name') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Mobile</label>
                        <input type="text" name="mobile" placeholder="mobile" value="{{ old('mobile') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Section</label>
                        <input type="text" name="section" placeholder="Example : A" value="{{ old('section') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Roll</label>
                        <input type="text" name="roll" placeholder="Example : 10" value="{{ old('roll') }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">MCQ Mark</label>
                        <input type="text" name="mcq_mark" placeholder="Example : 10" value="{{ old('mcq_mark') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Written Mark</label>
                        <input type="text" name="written_mark" placeholder="Example : 10" value="{{ old('written_mark') }}" class="form-control">
                    </div>

                    <div class="form-group">

                        <button class="btn btn-primary">Submit</button>
                    </div>

                </form>

                <br>
                <hr>

                <div class="table-responsive ">
                    <table class="table table-bordered table hovered">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Section</th>
                            <th>Roll</th>
                            <th>MCQ Mark</th>
                            <th>Written Mark</th>
                            <th>Action</th>
                        </tr>
                    @foreach($extraExamdetails as $examdetail)
                        <tr>
                            <td>{{  $loop->iteration  }}</td>
                            <td>{{ $examdetail->name }}</td>
                            <td>{{ $examdetail->mobile }}</td>
                            <td>{{ $examdetail->roll }}</td>
                            <td>{{ $examdetail->section }}</td>
                            <td>{{ $examdetail->mcq_mark }}</td>
                            <td>{{ $examdetail->written_mark }}</td>
                            <td>
                            <form action="{{ route('extraexamdetail.destroy',$examdetail->id) }}" method="post">
                                @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                
                                
                                                            <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal_{{  $examdetail->id }}">
                                  Edit 
                                </button>
                            
                            </td>
                            

                            <!-- The Modal -->
                            <div class="modal" id="myModal_{{  $examdetail->id }}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                               <form action="{{ route('extraexamdetail.update',$examdetail->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                    
                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                    <h4 class="modal-title">Exam Edit</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                            
                                  <!-- Modal body -->
                                  <div class="modal-body">
                                      
                                   
                        
                                            <input type="hidden" name="extra_exam_id" value="{{ $extraExam->id }}">
                        
                                            <div class="form-group">
                                                <label for="">Student Name</label>
                                                <input type="text" name="name" placeholder="name" value="{{ $examdetail->name }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Mobile</label>
                                                <input type="text" name="mobile" placeholder="mobile" value="{{ $examdetail->mobile }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Section</label>
                                                <input type="text" name="section" placeholder="Example : A" value="{{ $examdetail->section }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Roll</label>
                                                <input type="text" name="roll" placeholder="Example : 10" value="{{ $examdetail->roll }}" class="form-control">
                                            </div>
                        
                                            <div class="form-group">
                                                <label for="">MCQ Mark</label>
                                                <input type="text" name="mcq_mark" placeholder="Example : 10" value="{{ $examdetail->mcq_mark }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Written Mark</label>
                                                <input type="text" name="written_mark" placeholder="Example : 10" value="{{ $examdetail->written_mark }}" class="form-control">
                                            </div>
                        
                                         
                                          
                                      
                                      
                                  </div>
                            
                                  <!-- Modal footer -->
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                     <button type="submit" class="btn btn-primary">Submit</button>
                                  </div>
                                  
                                  

                                </form>
                            
                                </div>
                              </div>
                            </div>

                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                        </tr>
                        @endforeach

                    </table>
                </div>


            </div>
         </div>
    </div>
@endsection
