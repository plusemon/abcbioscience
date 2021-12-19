@extends('frontend.layouts.app')
@section('title',$websetting->homepage_title)

@section('content')

   
    <!--start slider area-->
    <section class="slider-section wow fadeInDown" data-wow-duration="1s">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">

                @foreach($sliders as $key => $slider)
                <div class="carousel-item  {{$key == 0 ? 'active' : '' }}"> <img class="d-block w-100" src="{{ asset($slider->image) }}" alt="slider">
                    <div class="carousel-caption">
                    </div>
                </div>
                @endforeach

 
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
            </div>
        </div>
    </section>
    <!--end slider area-->
    <!--    about-section-->
    <section class="about-section bgw py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title pt-3 wow animate__animated animate__fadeInUp">
                        <h2>World Class Facilities</h2>
                        <p>Ask The Question, Learn With Perfection, Lead With Conviction</p>
                    </div>
                </div>
            </div>
            <div class="row py-5">
                <div class="col-12 col-lg-6">
                    <div class="about-img wow animate__animated animate__fadeInUp"> <img src="{{ asset('public/frontend') }}/photos/about-1.png" alt="about-image"> </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="about-txt wow animate__animated animate__fadeInUp">
                        <h2 class="py-2">Ask whatever you want</h2>
                        <h5 class="py-3">Get your exam related doubts and questions answered by experienced and qualified faculty</h5>
                        <p><span><i class="fa fa-check"></i></span>Stuck with subject related queries?</p>
                        <p><span><i class="fa fa-check"></i></span>Confused among lots of career choices?</p>
                        <p><span><i class="fa fa-check"></i></span>Looking for expert guidance in studies?</p>
                        <p><span><i class="fa fa-check"></i></span>Want latest notification about exams?</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--    about-section end-->
    
    
    
    <!--    notic-section-->
    <section class="notic-section py-5 bgg">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 col-sm-8 col-lg-8 bg-white">
                    <div class="batch-list">
                        <div class="batch-heading">
                            <h3>Current Batch</h3> </div>
                        <div class="batch-body">
                            <div class="table-responsive">
                            <table class="table table-bordered table-hovered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Batch Name</th>
                                        <th>Class</th>
                                        <th>Session</th>
                                        <th>Day Of Class</th>
                                        
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
                                        <td>{{ $schedule->dayandtime->count() }}/Week</td>
                                       
                                        <td>
                                            <p class="btn btn-primary btn-sm">{{ $schedule->classtype?$schedule->classtype->name:'' }}</p>
                                        </td>
                                        <td> <a href="{{ route('batch.enroll',$schedule->id) }}" class="btn btn-success btn-sm">Enroll Now</a> </td>
                                    </tr>
                                    @endforeach
                                    @else

                                    <tr>
                                        <td colspan="7">Need to login first!  <a href="{{ route('student.login') }}" title="">login</a></td>
                                    </tr>
                                    @endif
                                    
                                </tbody>
                            </table>
                            </div>
                            <a href="{{ route('allbatch') }}" class="btn btn-primary btn-sm float-right">See More</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-ms-4 col-lg-4">
                    <div class="notic-area ">
                        <ul>
                            <li class="notic-head wow animate__animated animate__fadeInUp">
                                <h4>NoticeBoard</h4>
                            </li>
                            
                            @foreach($notices as $notice)
                            <li class="wow animate__animated animate__fadeInUp"> <span><i class="fa fa-calendar" aria-hidden="true"></i>{{ Date('d-M-Y',strtotime($notice->publish_date)) }}</span>
                                <a href="{{ route('notice.detail',$notice->slug) }}">
                                    <h6 class="nc-height">{{ $notice->title }}</h6> </a>
                            </li>
                            @endforeach
                             
                            <li class="wow animate__animated animate__fadeInUp"> <a href="{{ route('notices') }}" class="btn btn-custom btn-sm">See More</a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--    notic-section end-->



    <!--    latcure-section Start-->

    <div class="section lecuture-sheet-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h4 class="after-dot">lecture sheet</h4>
                    </div>
                </div>
            </div>
            <div class="lecture-sheet-content py-5">
                <div class="container">
                    <div class="row">
                   

                    @foreach($sheetsetting as $sheet)
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                        <div class="latcure-sheet-box">
                            <div class="latcure-sheet-photo">
                                <img src="{{ asset($sheet->sheets->thumbnail) }}" alt="latcure sheet photo">
                            </div>
                            <div class="latcure-sheet-text pt-2">
                                <h5>{{ $sheet->sheets->sheet_no }}</h5>
                                
                                <p class="ls-price">
                                   
                                   {{--  <span class="sell">৳ 350</span> --}}
                                </p>
                            </div>
                            <div class="latcure-box-overlay clearfix">
                                <a href="{{ route('lecture.sheet.detail',$sheet->id) }}">
                                    <div class="latcure-download">download <i class="fa fa-download ml-2"></i></div>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                  
                   
                </div>

                </div>
            </div>
            <div class="col-12">
                <div class="text-center pt-2"> <a href="{{ route('lecture.sheet') }}" class="btn btn-custom">More lecture sheet <i class="fa fa-arrow-right"></i></a> </div>
            </div>
        </div>
    </div>


<!--    latcure-section end-->




    <!--    blog section-->
    <section class="p-blog-section py-5 bgw">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title pt-3">
                        <h2>Our Blogs</h2> 
                        <hr>
                    </div>
                </div>
            </div>
            <div class="row py-5">

                @foreach($blogs as $blog)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="p-blog-box wow animate__animated animate__fadeInUp">
                            <div class="card">
                                <div class="blog-img">
                                    <a href="{{ route('blog.detail',$blog->slug) }}"> <img src="{{ asset($blog->image) }}" class="card-img-top" alt="blog-photo"> </a>
                                </div>
                                <div class="card-body custom-card">
                                 <a href="{{ route('blog.detail',$blog->slug) }}">
                                        {{ $blog->title }}
                                    </a> <span>
                                        <i class="fa fa-user"></i> {{ $blog->user?$blog->user->name:'' }}
                                    </span> </div>
                            </div>
                        </div>
                    </div>
                @endforeach


                

                <div class="col-12">
                    <div class="text-center pt-2"> <a href="{{ route('blogs') }}" class="btn btn-custom">See More</a> </div>
                </div>
            </div>
        </div>
    </section>
    <!--    blog section end-->
   
    <!--    contect-section-->
    <section class="contect-section py-5 bgw">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title section-title-contect pt-3">
                        <h2>Send A Message </h2> </div>
                </div>
            </div>
            <div class="row py-3">
                <div class="col-12">
                    <div class="p-contect-form">
                        <form action="{{ route('contactstore') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="form-group wow animate__animated animate__fadeInUp">
                                        <label for="name">Name :</label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" placeholder="Enter your name"> 
                                        <div class="text-danger">{{ $errors->first('name') }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="form-group wow animate__animated animate__fadeInUp">
                                        <label for="phone">Mobile Number :</label>
                                        <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Enter your valid mobile number">
                                        <div class="text-danger">{{ $errors->first('mobile') }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group wow animate__animated animate__fadeInUp">
                                        <label for="subject">Email :</label>
                                        <input type="text" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="Enter your valid email address">
                                        <div class="text-danger">{{ $errors->first('email') }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="form-group wow animate__animated animate__fadeInUp">
                                        <label for="subject">Subject :</label>
                                        <input type="text" name="subject" value="{{ old('subject') }}" class="form-control" id="subject" placeholder="Enter your message Subject">
                                        <div class="text-danger">{{ $errors->first('subject') }}</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group wow animate__animated animate__fadeInUp">
                                        <label for="message">Message/comments :</label>
                                        <textarea class="form-control mb-2" name="message" placeholder="Enter Your message" spellcheck="false">{{ old('message') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-custom  my-3"><i class="fa fa-paper-plane-o pr-1 wow animate__animated animate__fadeInUp"></i>Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--    contect-section end-->



@endsection