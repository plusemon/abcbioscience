@extends('frontend.layouts.app')
@section('title','Password Reset')
@section('content')

 <section class="registation-section py-5">
		<div class="container">
			<div class="row">
			<div class="col-md-12">
			    <div class="registrationtitle text-center">
			        <h3>Password Reset</h3>
			    </div>
			   </div>
				<div class="col-12">
					<div class="registation">
						<form action="{{ route('student.register.store') }}" method="post" enctype="multipart/form-data">
							@csrf
							   <div class="form-group">
								<label for="password">New Password : </label>
								<input type="password" name="password" value="{{ old('password') }}" class="form-control" id="password" placeholder="Password">
								<div class="text-danger"> {{ $errors->first('password') }} </div>	
							</div>

							<div class="form-group">
								<label for="Confirm">Confirm Password : </label>
								<input type="password" name="com_password" value="{{ old('com_password') }}" class="form-control" id="Confirm" placeholder="Confirm Password ">
								<div class="text-danger"> {{ $errors->first('com_password') }} </div>	
							</div>
							 

							<button type="submit" class="btn btn-custom"><i class="fa fa-sign-in"></i> Submit</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection