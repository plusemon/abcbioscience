@extends('frontend.layouts.app')
@section('title',$blog->title)
@section('content')


<section class="brdc-section py-1">
		<div class="container section-box">
			<div class="row">
				<div class="col-12">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('blogs') }}">Blogs</a></li>
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
				<div class="col-12 col-lg-8" style="border: 1px solid #ccc">
					<div class="blog-main">
						<div class="row section-box ml-1 pt-3">
							<div class="col-12">
								<div class="blog-title wow animate__animated animate__fadeInUp">
                                    <h4 class="p-2"> {{ $blog->title }} 	</h4>
									<p class="px-2 mb-3"> <i class="fa fa-user"> </i> {{ $blog->user?$blog->user->name:'' }} <i class="fa fa-calendar"></i> {{date('d-m-Y',strtotime( $blog->created_at)) }} </p>
									<img src="{{ asset($blog->image) }}" alt="blog-photo" style="max-width: 100%"">

									<a href="#">{{ $blog->category?$blog->category->name:'' }}</a>
								</div>
							</div>
							<div class="col-12">
								<div class="blog-details-txt mt-3">
									  {!! $blog->description !!}
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-4">
					<div class="section-box">
						{{--  <div class="card">
							<div class="card-header wow animate__animated animate__fadeInUp mb-3">
								<h4>Categories</h4>
							</div>
							<div class="card-body wow animate__animated animate__fadeInUp">
								@foreach($categories as $category)
								<a href="#"><i class="fa fa-check"></i>{{ $category->name }}</a>
								@endforeach

							</div>
						</div>  --}}

						<div class="card">
							<div class="card-header">
								<h4>latest Blogs</h4>
							</div>
                            <div class="card-body">
                                @foreach($blogs as $blog)
                                <div class="media py-3">
                                    <a href="{{ route('blog.detail',$blog->slug) }}">
                                        <img src="{{ asset($blog->image) }}" alt="blog-photo" class="card-img-top">
                                    </a>
                                    <div class="media-body mt-3">
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
		</div>
	</section>
	<!--	blog details end-->




@endsection
