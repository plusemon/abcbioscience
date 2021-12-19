@extends('frontend.layouts.app')
@section('title','OTP Verification')
@section('content')

<section class="registation-section py-5">
		<div class="container">
			<div class="row">
                <div class="col-md-12">
                    <div class="registrationtitle text-center">
                        <h3>OTP Verification</h3>
                    </div>
			   </div>
				<div class="col-12">
					<div class="registation">
						<form action="{{ route('student.otp.verify') }}" method="post">
							@csrf

							<input type="hidden" name="remmber_token" value="{{  Request::segment(3) }}">
							<div class="form-group">
								<label for="Roll">OTP : </label>
								<input type="text" name="otp" value="{{ old('otp') }}" class="form-control" id="otp" placeholder="OTP Code">
							</div>
 						   <button type="submit" class="btn btn-custom"><i class="fa fa-sign-in"></i> Verify</button>	 
						</form>
					</div>
				</div>
			</div>
		</div>
</section>

@endsection