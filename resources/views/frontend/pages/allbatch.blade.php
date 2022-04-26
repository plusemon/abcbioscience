@extends('frontend.layouts.app')
@section('title','All Courses')
@section('content')


 	<!--	brdc-section-->
	<section class="brdc-section py-3 bgg">
		<div class="container section-box">
			<div class="row">
				<div class="col-12">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb wow animate__animated animate__fadeInUp">
							<li class="breadcrumb-item"><a href="index.html">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">All Courses</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!--	brdc-section end -->
	<!--	notic-section-->
	<section class="notic-section py-5 bgw">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="notic-area">
						<div class="card">
							<div class="card-header">All Courses </div>
							<div class="card-body">
								
								<div class="table-responsive">
								    <table class="table table-bordered table-hovered">
		                                <thead>
		                                    <tr>
		                                        <th>SL</th>
		                                        <th>Batch Name</th>
		                                        <th>Class</th>
		                                        <th>Session</th>
		                                        <th>Number of classes in a week</th>
		                                        <th>Batch Type</th>
		                                        <th>Status</th>
		                                    </tr>
		                                </thead>
		                                <tbody>
		                                	  @if(Auth::check())
		                                    @foreach($BatchSettings as $schedule)
		                                    <tr>
		                                        <td>{{ $loop->iteration }}</td>
		                                        <td>{{ $schedule->batch_name }}</td>
		                                        <td>{{ $schedule->classes?$schedule->classes->name:"" }}</td>
		                                        <td>{{ $schedule->sessiones?$schedule->sessiones->name:'' }}</td>
		                                        <td>{{ $schedule->dayandtime->count() }} days/Week</td>
		                                        
		                                        <td>
		                                            <p class="btn btn-primary btn-sm">{{ $schedule->classtype?$schedule->classtype->name:'' }}</p>
		                                        </td>
		                                        <td> <a href="{{ route('batch.enroll',$schedule->id) }}" class="btn btn-success btn-sm">Enroll Now</a> </td>
		                                    </tr>
		                                    @endforeach
		                                    @else

		                                    <tr>
		                                        <td colspan="7">Need to login first!  <a href="{{ route('student.login') }}" title="">login</a>	</td>
		                                    </tr>
		                                    @endif
		                                    
		                                </tbody>
		                            </table>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--	notic-section end-->



@endsection