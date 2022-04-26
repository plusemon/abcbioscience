@extends('frontend.layouts.app')
@section('title','Student Login')
@section('content')

<section class="registation-section py-5">
		<div class="container">
			<div class="row">
                <div class="col-md-12">
                    <div class="registrationtitle text-center">
                        <h3>User Login</h3>
                    </div>
			   </div>
				<div class="col-12">
					<div class="registation">
						<form action="{{ route('student.login') }}" method="post">
							@csrf
							<div class="form-group">
								<label for="Roll">Mobile Number : </label>
								<input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control" id="Roll" placeholder="Mobile Number 017xxxxxxxx">
								<div class="text-danger">
									{{ $errors->first('mobile') }}
								</div>
							</div>

							<div class="form-group py-4">
								<label for="password">Password : </label>
								<input type="password" name="password" value="{{ old('password') }}" class="form-control" id="password" placeholder="Password">
								<div class="text-danger">
									{{ $errors->first('password') }}
								</div>
							</div>
							<button type="submit" class="btn btn-primary mt-4"><i class="fa fa-sign-in"></i> login</button>

							<span class="pull-right pt-4">Forgot Password? <a href="{{ route('student.password.forgot') }}" class="btn btn-primary btn-sm">click here</a></span>	

							<p class="pt-3">Haven’t an account? Please click the  <a class="btn btn-info btn-sm text-white" href="{{ route('student.register') }}">Registration</a></p>
						</form>
					</div>
				</div>
			</div>
		</div>
</section>

@endsection