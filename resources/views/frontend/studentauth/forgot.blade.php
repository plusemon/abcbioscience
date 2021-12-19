@extends('frontend.layouts.app')
@section('title','Forgot Password')
@section('content')

<section class="registation-section py-5">
		<div class="container">
			<div class="row">
                <div class="col-md-12">
                    <div class="registrationtitle text-center">
                        <h3>Reset Student Login Password </h3>
                    </div>
			   </div>
				<div class="col-12">
					<div class="registation">
						<form action="{{ route('student.password.forgot.send') }}" method="post">
							@csrf
							<div class="form-group">
								<label for="Roll">Mobile Number : </label>
								<input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control" id="Roll" placeholder="Mobile Number 017xxxxxxxx">
								<div class="text-danger">
									 {{ $errors->first('mobile') }}
								</div>
							</div>
 							 <button type="submit" class="btn btn-custom"><i class="fa fa-sign-in"></i> Reset</button>
 
							<p class="pt-3">Have account? <a class=" " href="{{ route('student.register') }}">Login</a></p>
						</form>
					</div>
				</div>
			</div>
		</div>
</section>

@endsection