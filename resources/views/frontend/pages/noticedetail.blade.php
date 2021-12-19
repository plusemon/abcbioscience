@extends('frontend.layouts.app')
@section('title',$notice->title)

@section('content')

   
 	<!--	brdc-section-->
	<section class="brdc-section pt-3 pb-1 bgg">
		<div class="container section-box">
			<div class="row">
				<div class="col-12">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb wow animate__animated animate__fadeIn	Up">
							<li class="breadcrumb-item"><a href="{{ route('frontend') }}">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Notice</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!--	brdc-section end -->
	<!--	notic-section-->
	<section class="notic-section py-2 bgw">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="notic-area">
						<div class="card">
							<div class="card-header"> Notice Title :  {{ $notice->title }} </div>
							<div class="card-body">
							 	
								 <?php 
			  
									   $path_parts = pathinfo($notice->noticesfile);

										   if($path_parts['extension']=='jpeg' || $path_parts['extension']=='png' || $path_parts['extension']=='jpg'){ ?>
										         <img src="{{ asset($notice->noticesfile) }}" alt="" width="100%"></td>

										 <?php  }else{   ?>
										 
										  
										<embed src="{{ asset($notice->noticesfile) }}" style="width:100%; height:800px;" frameborder="0">


										 <?php  }  ?>
						 
										<br>
						                <br>
										<a href="{{ asset($notice->noticesfile) }}" class="btn btn-primary btn-sm" download> <i class="fa fa-download"></i> Download</a>




							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--	notic-section end-->



@endsection