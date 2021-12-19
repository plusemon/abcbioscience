@extends('frontend.layouts.app')
@section('title','Blog')

@section('content')

   
  	<!--	brdc-section-->
	<section class="brdc-section py-3">
		<div class="container section-box">
			<div class="row">
				<div class="col-12">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb  wow animate__animated animate__fadeInUp">
							<li class="breadcrumb-item"><a href="index.html">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Blog</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!--	brdc-section end -->

	<!--	blog section-->
	<section class="p-blog-section py-3">
		<div class="container section-box py-4">
			<div class="row">


				@foreach($blogs as $blog)
					<div class="col-12 col-sm-6 col-md-4 col-lg-3">
						<div class="p-blog-box wow animate__animated animate__fadeInUp">
							<div class="card">
								<div class="blog-img">
									<a href="{{ route('blog.detail',$blog->slug) }}">
										<img src="{{ asset($blog->image) }}" class="card-img-top" alt="blog-photo">
									</a>
								</div>
								<div class="card-body custom-card">
									<a href="{{ route('blog.detail',$blog->slug) }}">
										{{ $blog->title }}
									</a>
									<span>
										<i class="fa fa-user"></i>{{ $blog->user?$blog->user->name:'' }} 
										 <i class="fa fa-clock-o"></i> 
										 {{ $blog->created_at->format('M d, Y') }}
									</span>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			
				 
			</div>
		</div>
	</section>
	<!--	blog section end-->




@endsection