@extends('frontend.layouts.app')
@section('title','Notice Board')

@section('content')

   
 	<!--	brdc-section-->
	<section class="brdc-section pt-3 pb-1 bgg">
		<div class="container section-box">
			<div class="row">
				<div class="col-12">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb wow animate__animated animate__fadeInUp">
							<li class="breadcrumb-item"><a href="index.html">Home</a></li>
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
							<div class="card-header"> Notice Board </div>
							<div class="card-body">
							 
								<table class="table table-bordered table-hovered">
									<thead>
										<tr>
											<th style="width:5%">Serial</th>
											<th style="width:12%">Publish Date</th>
											<th style="width:60%">Title</th>
											<th style="width:18%">Attachment</th>
											 
										</tr>
									</thead>
									<tbody>

										@foreach($notices as $notice)
										<tr>
											<td>{{ $loop->iteration }}</td>
											<td>{{ Date('M d,Y',strtotime($notice->publish_date)) }}</td>
											<td>{{ $notice->title }}</td>
											<td><a href="{{ asset($notice->noticesfile) }}" title="{{ $notice->title }}" download=""> <i class="fa fa-download"></i> Download</a>
										    <a href="{{ route('notice.detail',$notice->slug) }}" title="{{ $notice->title }}"> <i class="fa fa-eye"></i> View</a>
											</td>
											 
										</tr>
										@endforeach
										
									</tbody>
								</table>
								{{ $notices->links() }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--	notic-section end-->



@endsection