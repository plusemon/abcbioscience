@extends('frontend.layouts.app')
@section('title', 'Student Profile')
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
                        <h6> Student Profile </h6>
                     
                    </div>
                    <div class="hr-body">
                         


                    	<form action="{{ route('student.setting.update') }}" method="POST" enctype="multipart/form-data">
		                        @csrf
		                             
		                        <div class="form-group">
		                            <label for="url">Old Password</label>
		                            <input type="password" name="current_password" value="{{ old('current_password') }}" class="form-control" placeholder="Enter New Password" />
		                            <div class="text-danger">{{ $errors->first('current_password') }}</div>
		                        </div>
		                           
		                        <div class="form-group">
		                            <label for="details">New Password</label>
		                            <input type="password" name="new_password" value="{{ old('new_password') }}" class="form-control" placeholder="Enter New Password" />
		                            <div class="text-danger">{{ $errors->first('new_password') }}</div>
		                        </div>
		                           
		                        <div class="form-group">
		                            <label for="name">Confirm Password</label>
		                            <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control" placeholder="Enter Confirm Password" />
		                            <div class="text-danger">{{ $errors->first('password_confirmation') }}</div>
		                        </div>
		                           
		                        
		 
		                        <button type="submit" class="btn btn-sm btn-primary m-r-5">Update Password</button>
		                        <a class="btn  btn-info btn-sm" href="{{ route('student.profile') }}">Back Profile</a>

		                    </form>


                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--END USER DASHBOARD-->



    @include('frontend.studentdashboard.mobilemenu')


@endsection
