@extends('students.layouts.app')
@section('title', 'Student Personal Information Create')
@section('content')
    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Student Personal Information Create</h4>
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


                         <form action="{{ route('student.personal.information.store') }}" method="post" accept-charset="utf-8">
                          @csrf
                           <table class="table table-bordered table-hovered">
                             <thead>
                               <tr>
                                 <th width="25%">Menu</th>
                                 <th width="75%">Information</th>
                               </tr>
                             </thead>
                             <tbody>
                               <tr>
                                  <th>Father Name</th>
                                  <td>

                                    <input type="text" name="father" value="{{ old('father') }}" class="form-control" placeholder="Enter Your father name"> 

                                    <div class="text-danger">
                                        {{ $errors->first('father') }}
                                    </div>

                                  </td>
                               </tr>
                               <tr>
                                 <th>Mother</th>
                                 <td> 
                                     <input type="text" name="mother" value="{{ old('mother') }}" class="form-control" placeholder="Enter Your mother Name">


                                      <div class="text-danger">
                                          {{ $errors->first('mother') }}
                                      </div>

                                  </td>
                               </tr>
                               <tr>
                                  <th>Guardian Mobile Number</th>
                                  <td> 

                                    <input type="text" name="guardian_mobile" value="{{ old('guardian_mobile') }}" class="form-control" placeholder="Guardian Mobile Number">


                                    <div class="text-danger">
                                        {{ $errors->first('guardian_mobile') }}
                                    </div>


                                  </td>
                               </tr> 

                               <tr>
                                  <th>Self Mobile Number</th>
                                  <td> <input type="text" name="own_mobile" value="{{ old('own_mobile') }}" class="form-control" placeholder="Self Mobile Number">


                                    <div class="text-danger">
                                        {{ $errors->first('own_mobile') }}
                                    </div>


                                  </td>
                               </tr>
                               <tr>
                                  <th>Email</th>
                                  <td> <input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="Self Email">

                                    <div class="text-danger">
                                        {{ $errors->first('email') }}
                                    </div>

                                  </td>
                               </tr>

                               <tr>
                                  <th>Bkash Number</th>
                                  <td> <input type="text" name="bkash_number" value="{{ old('bkash_number') }}" class="form-control" placeholder="Enter your bkash Number">


                                    <div class="text-danger">
                                        {{ $errors->first('bkash_number') }}
                                    </div>


                                  </td>
                               </tr>
                                <tr>
                                  <th>Whats App Number</th>
                                  <td> <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number') }}" class="form-control" placeholder="Enter your Whatsapp Number">


                                    <div class="text-danger">
                                        {{ $errors->first('whatsapp_number') }}
                                    </div>


                                  </td>
                               </tr>

                                <tr>
                                  <th>Facebook ID Link</th>
                                  <td> <input type="text" name="facebook_id" value="{{ old('facebook_id') }}" class="form-control" placeholder="Enter Facebook ID Link ">


                                    <div class="text-danger">
                                        {{ $errors->first('facebook_id') }}
                                    </div>

                                  </td>
                               </tr>
                               <tr>
                                 <th>Address</th>
                                 <td> <input type="text" name="address" value="{{ old('address') }}" class="form-control" placeholder="Student Address">

                                  
                                    <div class="text-danger">
                                        {{ $errors->first('address') }}
                                    </div>
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
