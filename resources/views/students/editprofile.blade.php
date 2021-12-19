@extends('students.layouts.app')
@section('title', 'Edit Student Profile')
@section('content')
    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Edit Student Profile</h4>
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
                <div class="row">
                    <div class="col-md-12">

                         <form action="{{ route('student.profile.update') }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                          @csrf
                           <table class="table table-bordered table-hovered">
                             <thead>
                               <tr>
                                 <th>Menu</th>
                                 <th>Information</th>
                               </tr>
                             </thead>
                             <tbody>
                               <tr>
                                  <th>Name</th>
                                  <td> <input type="text" name="name" value="{{ $student->name }}" class="form-control" placeholder="Student name"> </td>
                               </tr>
                               <tr>
                                 <th>Email</th>
                                 <td> <input type="text" name="email" value="{{ $student->email }}" class="form-control" placeholder="Student Email"> </td>
                               </tr>
                               <tr>
                                  <th>Mobile</th>
                                  <td> <input type="text" name="mobile" value="{{ $student->mobile }}" class="form-control" placeholder="Student Mobile" ></td>
                               </tr>
                               <tr>
                                 <th>Address</th>
                                 <td> <input type="text" name="address" value=" {{ $student->address }}" class="form-control" placeholder="Student Address"></td>
                               </tr>  

                                <tr>
                                 <th>Class</th>
                                 <td> 
                                     <select name="class_id" class="form-control">
                                      <option value="">Select Class</option>
                                      @foreach($classes as $class)
                                         <option {{ $class->id == $student->class_id ? 'selected' : '' }}  value="{{ $class->id }}"> {{ $class->name }} </option>
                                      @endforeach

                                    </select>

                                 </td>
                               </tr> 
                                 
                                 
                                   <tr>
                                 <th>Section</th>
                                 <td> 
                                      <input type="text" name="section_id" value=" {{ $student->section_id }}" class="form-control" placeholder="Student Section">

                                 </td>
                               </tr> 
                              <tr>
                                 <th>Shift</th>
                                 <td> 
                                     <select name="shift_id" class="form-control">
    								 	<option value="">Select Shift</option>
    								 	@foreach($shifts as $shift)
    								 	<option {{ $shift->id == $student->shift_id ? 'selected' : '' }} value="{{ $shift->id }}"> {{ $shift->name }} </option>
    								 	@endforeach
    								 </select>

                                 </td>
                               </tr> 
                               
                                <tr>
                                 <th>Roll</th>
                                 <td> <input type="text" name="roll" value=" {{ $student->roll }}" class="form-control" placeholder="Student Roll"></td>
                               </tr> 
                                <tr>
                                 <th>School Name</th>
                                 <td> <input type="text" name="school_name" value=" {{ $student->school_name }}" class="form-control" placeholder="Enter School Name"></td>
                               </tr>  
                               <tr>
                                 <th>Photo</th>
                                 <td> 
                                     <img src="{{ asset($student->image) }}" class="img-responsive"/>
                                     
                                    <br>                                 
                                    <br>                                 
        							<input type="file" name="photo" value="{{ old('photo') }}" class="form-control" id="photo" placeholder="photo">
        							<div class="text-danger"> {{ $errors->first('photo') }} </div>	
                                 </td>
                               </tr>
                               
                               <tr>
                                 <th>Action</th>
                                 <td> <button type="submit" class="btn btn-primary">Submit</button></td>
                               </tr>

                             </tbody>
                           </table>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    


@endsection
