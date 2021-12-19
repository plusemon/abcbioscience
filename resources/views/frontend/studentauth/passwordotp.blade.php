@extends('frontend.layouts.app')
@section('title','Forgot Password')
@section('content')

<section class="registation-section py-5">
		<div class="container">
			<div class="row">
                <div class="col-md-12">
                    <div class="registrationtitle text-center">
                        <h3>One Time OTP </h3>
                    </div>
			   </div>
				<div class="col-12">
					<div class="registation">
						<form action="{{ route('student.login') }}" method="post">
							@csrf
							<div class="form-group">
								<label for="Roll"> OTP : </label>
								<input type="text" name="otp" value="{{ old('otp') }}" class="form-control" id="otp" placeholder="Enter 4 digit OTP code">
							</div>
 							 <button type="submit" class="btn btn-custom"><i class="fa fa-sign-in"></i> Submit</button>

						 
						</form>
					</div>
				</div>
			</div>
		</div>
</section>

@endsection