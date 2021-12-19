@extends('frontend.layouts.app')
@section('title', 'Update Personal Information')
@section('content')

    <!--USER DASHBOARD-->
    <section class="user-dashboard py-4">
        <div class="container">
            <div class="dashboard-area d-flex bd-highlight">
                

          
            @include('frontend.studentdashboard.dashboardmenu')
         

              <div class="dashboard-main w-100 bd-highlight py-3">
                  <div class="dr-head dashboard-header">
                      <div class="ud-mobile">
                            <i class="fa fa-bars" id="ud-mobile-btn"></i> Menu
                        </div>
                        <h6>Update Personal Information </h6>
                       
                    </div>
                    <div class="hr-body">
                         <form action="{{ route('student.personal.information.update') }}" method="post" accept-charset="utf-8">
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

                                    <input type="text" name="father" value="{{ $student->father }}" class="form-control" placeholder="Enter Your father name"> 

                                    <div class="text-danger">
                                        {{ $errors->first('father') }}
                                    </div>

                                  </td>
                               </tr>
                               <tr>
                                 <th>Mother</th>
                                 <td> 
                                     <input type="text" name="mother" value="{{ $student->mother }}" class="form-control" placeholder="Enter Your mother Name">


                                      <div class="text-danger">
                                          {{ $errors->first('mother') }}
                                      </div>

                                  </td>
                               </tr>
                               <tr>
                                  <th>Guardian Mobile Number</th>
                                  <td> 

                                    <input type="text" name="guardian_mobile" value="{{ $student->guardian_mobile }}" class="form-control" placeholder="Guardian Mobile Number">


                                    <div class="text-danger">
                                        {{ $errors->first('guardian_mobile') }}
                                    </div>


                                  </td>
                               </tr> 

                               <tr>
                                  <th>Self Mobile Number</th>
                                  <td> <input type="text" name="own_mobile" value="{{ $student->own_mobile }}" class="form-control" placeholder="Self Mobile Number">


                                    <div class="text-danger">
                                        {{ $errors->first('own_mobile') }}
                                    </div>


                                  </td>
                               </tr>
                               <tr>
                                  <th>Email</th>
                                  <td> <input type="text" name="email" value="{{ $student->email }}" class="form-control" placeholder="Self Email">

                                    <div class="text-danger">
                                        {{ $errors->first('email') }}
                                    </div>

                                  </td>
                               </tr>

                               <tr>
                                  <th>Bkash Number</th>
                                  <td> <input type="text" name="bkash_number" value="{{ $student->bkash_number }}" class="form-control" placeholder="Enter your bkash Number">


                                    <div class="text-danger">
                                        {{ $errors->first('bkash_number') }}
                                    </div>


                                  </td>
                               </tr>
                                <tr>
                                  <th>Whats App Number</th>
                                  <td> <input type="text" name="whatsapp_number" value="{{ $student->whatsapp_number }}" class="form-control" placeholder="Enter your Whatsapp Number">


                                    <div class="text-danger">
                                        {{ $errors->first('whatsapp_number') }}
                                    </div>


                                  </td>
                               </tr>

                                <tr>
                                  <th>Facebook ID Link</th>
                                  <td> <input type="text" name="facebook_id" value="{{  $student->facebook_id }}" class="form-control" placeholder="Enter Facebook ID Link ">


                                    <div class="text-danger">
                                        {{ $errors->first('facebook_id') }}
                                    </div>

                                  </td>
                               </tr>
                               <tr>
                                 <th>Address</th>
                                 <td> <input type="text" name="address" value="{{  $student->address }}" class="form-control" placeholder="Student Address">

                                  
                                    <div class="text-danger">
                                        {{ $errors->first('address') }}
                                    </div>
                                 </td>
                               </tr>
                               <tr>
                                 <th>Action</th>
                                 <td> <button type="submit" class="btn btn-primary">Update</button></td>
                               </tr>

                             </tbody>
                           </table>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--END USER DASHBOARD-->



    @include('frontend.studentdashboard.mobilemenu')


@endsection
