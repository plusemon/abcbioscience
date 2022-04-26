@extends('frontend.layouts.app')
@section('title','Courses Details')

@section('content')

 <!-- breadgarm-section -->


<div class="breadgarm-section small-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadgam">
                    <ul>
                        <li><a href="#"><i class="fa fa-home"></i></a></li>
                        <li>/</li>
                        <li> <a href="#">Bangladesh</a></li>
                        <li>/</li>
                        <li>{{ $news_detail->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- breadgarm-section -->

<!-- top-category-section -->

<div class="news-details-section">
    <div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="newsdetails">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="details-title">
                            <h1>{{ $news_detail->title }}</h1>
                            <a href="#">
                                <img src="{{ asset($news_detail->image) }}" alt="img">
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="publish-info text-center">
                            <ul>
                                <li><a href="#">Bangladesh</a></li>
                                <li>Desk Report</li>
                                <li>Published: 28 Jan 2021, 11:01 am </li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-print"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="publish-content">
                            {!! $news_detail->details !!}
                        </div>
                    </div>
                </div>

            </div>

        </div>

         <div class="col-md-4">
             <div class="popularlist categorylatest">
                <h2>Latest <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i></a></h2>
                    <ul>

                    @foreach($news as $new)
                        <li>
                            <a href="{{ route('detail',$new->slug) }}">
                            <img src="{{ asset($new->image) }}" alt="img">
                            <h3>{{ $new->title }}</h3>
                            </a>
                        </li>
                    @endforeach
                       
                    </ul>
                    <div class="allbutton">
                       <a href="#">All News</a>
                    </div>
                </div>

             <div class="popularlist categorylatest" style="margin-top: 15px;">
                <h2>More From Bangladesh <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i></a></h2>
                    <ul>
                        @foreach($news as $new)
                            <li>
                                <a href="{{ route('detail',$new->slug) }}">
                                <img src="{{ asset($new->image) }}" alt="img">
                                <h3>{{ $new->title }}</h3>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                   
                </div>
         </div>


    </div>
    </div>
</div>


<!-- top-category-section -->


<!-- comments-section -->


<div class="comments-section">
    <div class="container">
        <div class="offset-md-1 col-md-10">
            <div class="accordion" id="accordionExample">
                <div class="card">
                  <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                      <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      <i class="fa fa-plus"></i>  Comments 
                      </button>
                    </h2>
                  </div>

                  <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                      <div class="comments-form">
                          <h3>0 Comments</h3>
                          <textarea class="form-control" cols="30" rows="10" placeholder="Add a Comments"></textarea>

                          <button class="btn btn-danger btn-sm mt-2">Submit</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- comments-section -->


<!-- related-news -->

<div class="related-news small-padding">
    <div class="container">
        <div class="row">
            <div class="offset-md-1 col-md-10">
               <div class="related-allnews">
                   <h3>Related</h3>

                   <div class="relatedbox">
                       <div class="row">

                          @foreach($news as $new)
                           <div class="col-sm-6 col-md-3">
                                <div class="single-categorynews">
                                     <a href="{{ route('detail',$new->slug) }}">
                                         <img src="{{ asset($new->image) }}" alt="img">
                                        <h4>{{ $new->title }}</h4>
                                    </a>
                                </div>
                            </div>

                         @endforeach
                           
                       </div>
                   </div>
               </div> 
            </div>
        </div>
    </div>
</div>


<!-- related-news -->



@endsection