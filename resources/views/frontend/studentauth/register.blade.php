@extends('frontend.layouts.app')
@section('title','Student Login')
@section('content')

 <section class="registation-section py-5">
		<div class="container">
			<div class="row">
			<div class="col-md-12">
			    <div class="registrationtitle text-center">
			        <h3>Online Registration</h3>
			    </div>
			   </div>
				<div class="col-12">
					<div class="registation">
						<form action="{{ route('student.register.store') }}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label for="name"> Your Name :  <span class="text-danger">*</span> </label>
								<input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" placeholder="Your Name" required>
								<div class="text-danger"> {{ $errors->first('name') }} </div>	
							</div>
							<div class="form-group">
								<label for="number">Mobile No :   <span class="text-danger">*</span></label>
								<input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control" id="number" placeholder="Mobile No " required>
								<div class="text-danger"> {{ $errors->first('mobile') }} </div>	
							</div>
							 
				            <div class="form-group">
								<label for="password">New Password :   <span class="text-danger">*</span></label>
								<input type="password" name="password" value="{{ old('password') }}" class="form-control" id="password" placeholder="Password" required>
								<div class="text-danger"> {{ $errors->first('password') }} </div>	
							</div>
							<div class="form-group">
								<label for="Confirm">Confirm New Password :   <span class="text-danger">*</span></label>
								<input type="password" name="com_password" value="{{ old('com_password') }}" class="form-control" id="Confirm" placeholder="Confirm Password " required>
								<div class="text-danger"> {{ $errors->first('com_password') }} </div>	
							</div>
							<div class="form-group">
								<label for="Class">Class :   <span class="text-danger">*</span></label>
								 <select name="class_id" class="form-control" required>
								 	<option value="">Select Class</option>
								 	@foreach($classes as $cllist)
								 	<option value="{{ $cllist->id }}"> {{ $cllist->name }} </option>
								 	@endforeach
								 </select>
								<div class="text-danger"> {{ $errors->first('com_password') }} </div>	
							</div>
							
							
							<div class="form-group">
								<label for="Section">Section :</label>
								<input type="text" class="form-control" name="section_id" placeholder="Enter your section" />
								<div class="text-danger"> {{ $errors->first('section_id') }} </div>	
							</div>
							
							<div class="form-group">
								<label for="Section">Shift :</label>
								 <select name="shift_id" class="form-control">
								 	<option value="">Select Shift</option>
								 	@foreach($shifts as $shift)
								 	<option value="{{ $shift->id }}"> {{ $shift->name }} </option>
								 	@endforeach
								 </select>
								<div class="text-danger"> {{ $errors->first('shift_id') }} </div>	
							</div>
							
						
							
							<div class="form-group">
								<label for="Roll">Roll :   <span class="text-danger">*</span></label>
								<input type="text" name="roll" value="{{ old('roll') }}" class="form-control" id="roll" placeholder="Enter your Roll" required>
								<div class="text-danger"> {{ $errors->first('roll') }} </div>	
							</div>
							
							<div class="form-group">
								<label for="Confirm">School:   <span class="text-danger">*</span></label>
								<input type="text" name="school_name" value="{{ old('school_name') }}" class="form-control" id="Confirm" placeholder="Enter your school name" required>
								<div class="text-danger"> {{ $errors->first('school_name') }} </div>	
							</div>	
							
							
							<div class="form-group">
								<label for="Confirm">Address :   <span class="text-danger">*</span></label>
								<input type="text" name="address" value="{{ old('address') }}" class="form-control" id="Confirm" placeholder="Address" required>
								<div class="text-danger"> {{ $errors->first('address') }} </div>	
							</div>	
							
							<div class="form-group">
								<label for="Confirm">Student Photograph :  <span class="text-danger">*</span></label>
								<input type="file" name="photo" value="{{ old('photo') }}" class="form-control" id="photo" placeholder="photo" required>
								<div class="text-danger"> {{ $errors->first('photo') }} </div>	
							</div>
							
							
							
							
							<div class="form-group">
							    <input type="checkbox" name="agreed" required> I agreed terms and conditions
							    <div class="text-danger"> {{ $errors->first('agreed') }} </div>	
							</div>

							<button type="submit" class="btn btn-custom"><i class="fa fa-sign-in"></i> Registation</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection