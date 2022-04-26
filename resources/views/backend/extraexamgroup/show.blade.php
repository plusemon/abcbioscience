@extends('backend.layouts.app')
@section('title','Extra Exam Group Student')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Extra Exam Group Student</h4>
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
                 
                <form action="{{ route('extraexamgroupstore') }}" method="post">
                    @csrf

                  <input type="hidden" name="group_id" value="{{ $extraExam->id }}">

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Student Name</label>
                            <input type="text" name="name[]" placeholder="name" value="{{ old('name') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Mobile</label>
                            <input type="text" name="mobile[]" placeholder="mobile" value="{{ old('mobile') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Section</label>
                            <input type="text" name="section[]" placeholder="Example : A" value="{{ old('section') }}" class="form-control">
                        </div>
                    </div>                    
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Roll</label>
                            <input type="text" name="roll[]" placeholder="Example : 10" value="{{ old('roll') }}" class="form-control">
                        </div> 
                    </div>
                    <div class="col-md-1">
                        <div class="form-group mt-4">
                            <span class="btn btn-primary add-student-input"><i class="fa fa-plus"></i> </span>
                         </div> 
                    </div>
                     
                </div>
                <div class="showmoreform"></div>
                    
                    
                <div class="row">
                     <div class="col-md-1">
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-ok"></i> Submit</button>
                         </div> 
                    </div> 
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
                            <th>Action</th>
                        </tr>
                    @foreach($extraExamdetails as $examdetail)
                        <tr>
                            <td>{{  $loop->iteration  }}</td>
                            <td>{{ $examdetail->name }}</td>
                            <td>{{ $examdetail->mobile }}</td>
                            <td>{{ $examdetail->roll }}</td>
                            <td>{{ $examdetail->section }}</td>
                             
                            <td>
                             
                                
                                <a href="{{ route('extraexamgroupdelete',$examdetail->id) }}" class="btn btn-danger btn-sm">Delete </a>
                                                            <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal_{{  $examdetail->id }}">
                                  Edit 
                                </button>
                            
                            </td>
                            

                            <!-- The Modal -->
                            <div class="modal" id="myModal_{{  $examdetail->id }}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                               <form action="{{ route('extraexamgroupupdate',$examdetail->id) }}" method="post">
                                    @csrf
                                  
                    
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
    
    
    
@section('customjs')
<script>
    $(document).ready(function() {

      // Gallery js start

        var galleryAddButton = $('.add-student-input');
        var gallery_wrapper = $('.showmoreform');
        var galleryFieldHTML = `<div class="row parent_remove">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Student Name</label>
                            <input type="text" name="name[]" placeholder="name" value="{{ old('name') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Mobile</label>
                            <input type="text" name="mobile[]" placeholder="mobile" value="{{ old('mobile') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Section</label>
                            <input type="text" name="section[]" placeholder="Example : A" value="{{ old('section') }}" class="form-control">
                        </div>
                    </div>                    
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Roll</label>
                            <input type="text" name="roll[]" placeholder="Example : 10" value="{{ old('roll') }}" class="form-control">
                        </div> 
                    </div>
                    <div class="col-md-1">
                        <div class="form-group mt-4">
                            <span class="btn btn-danger remove_btn"><i class="fa fa-close"></i> </span>
                         </div> 
                    </div>
                     
                </div>`;
                
                
        $(galleryAddButton).click(function() {
            $(gallery_wrapper).append(galleryFieldHTML);
        });
        $(gallery_wrapper).on('click', '.remove_btn', function(e) {
            e.preventDefault();
            $(this).closest('.parent_remove').remove();
        });
        // Gallery js end
    });

</script>

@endsection
@endsection
