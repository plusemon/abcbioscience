@extends('frontend.layouts.app')
@section('title','detail')

@section('content')

   
<section class="brdc-section py-1">
		<div class="container section-box">
			<div class="row">
				<div class="col-12">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('blogs') }}">Blog</a></li>
							<li class="breadcrumb-item active" aria-current="page">{{ $blog->title }}</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</section>

	<!--	blog details-->
	<section class="p-blog-section py-1">
		<div class="container py-4 section-box">
			<div class="row">
				<div class="col-12 col-lg-8 ">
					<div class="blog-main">
						<div class="row section-box ml-1 pt-3">
							<div class="col-12">
								<div class="blog-title wow animate__animated animate__fadeInUp">
									<img src="{{ asset($blog->image) }}" alt="blog-photo">
									<h4 class="wow animate__animated animate__fadeInUp pt-4"> {{ $blog->title }}
									</h4>
									<p class="pt-1"> <i class="fa fa-user"> </i> {{ $blog->user?$blog->user->name:'' }} <i class="fa fa-calendar"></i> {{ $blog->created_at }} </p>
									<a href="#">{{ $blog->category?$blog->category->name:'' }}</a>
								</div>
							</div>
							<div class="col-12 wow animate__animated animate__fadeInUp">
								<div class="blog-details-txt">
									  {!! $blog->description !!}
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-4">
					<div class="section-box p-3">
						<div class="p-letest-post ">
							<div class="latest-head wow animate__animated animate__fadeInUp mb-3">
								<h4>categerys</h4>
							</div>
							<div class="category wow animate__animated animate__fadeInUp">
								@foreach($categories as $category)
								<a href="#"><i class="fa fa-check"></i>{{ $category->name }}</a>
								@endforeach
								 
							</div>
						</div>
						<div class="p-letest-post mt-3">
							<div class="latest-head wow animate__animated animate__fadeInUp">
								<h4>latest posts</h4>
							</div>
							@foreach($blogs as $blog)
							<div class="media wow animate__animated animate__fadeInUp">
								<a href="{{ route('blog.detail',$blog->slug) }}">
									<img src="{{ asset($blog->image) }}" alt="blog-photo">
								</a>
								<div class="media-body">
									<h6>{{ $blog->title }}</h6>
									<span>
										<i class="fa fa-user mr-2"></i>
										{{ $blog->user?$blog->user->name:'' }} <i class="fa fa-clock-o"></i>  {{ $blog->created_at->format('M d, Y') }}
									</span>
								</div>
							</div>
							@endforeach
 
							 
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>
	<!--	blog details end-->




@endsection