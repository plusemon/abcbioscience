@extends('frontend.layouts.app')

@section('title', $websetting->homepage_title)

@section('content')

    <!--    SLIDER SECTION   -->
    <section class="slider-section py-4">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 col-xl-8">
                    <div class="slider-carosel min-height">
                        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($sliders as $slider)
                                <div class="carousel-item {{ $loop->iteration == 1 ? 'active'  :'' }}">
                                    <img src="{{ asset($slider->image) }}" alt="slider-photo" width="100%">
                                    <div class="carosel-title">

                                    </div>
                                </div>
                                @endforeach

                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                                    data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                                    data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4 col-xl-4 mt-4 mt-lg-0">
                    <div class="right-notic min-height">
                        <div class="card min-height">
                            <div class="card-header">
                                <h5 class="text-center text-capitalize">notice board</h5>
                            </div>

                            <div class="card-body">
                                <marquee behavior="scroll" direction="up" scrollamount="2" onmouseover="stop()"
                                onmouseout="start()">


                                @foreach ($notices as $notice)
                                <div class="flex">
                                            <div class="icon">
                                                <i class="fa fa-share"></i>
                                            </div>
                                            <div class="txt">
                                                <a href="{{ route('notice.detail',$notice->slug)  }}">
                                                    {{ $notice->title }}
                                                </a>
                                            </div>
                                        </div>

                                @endforeach
                            </marquee>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--    SLIDER SECTION-->

    <!-- WELCOME SECTION -->
    <section class="bgc">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-7">
                    <div class="home-about-content">
                        <div class="home-about-head p-5">
                            <h2>  {!! $about->body_about_title !!}</h2>

                            {!! $about->body_about_description !!}
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="head-about-img py-5">
                        <img src="{{ asset($about->body_about_image) }}" alt="" class="img-responsive w-100">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- WELCOME SECTION -->


    <!-- lecture section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                        <div class="d-flex justify-content-between mb-4">
                            <h2>Leacture Sheets</h2>
                            <a href="#" class="see-all">Show All <i class="fa fa-angle-double-right"></i></a>
                        </div>
                        <hr>
                </div>
                <div class="col-12">
                    <div class="row">
                    @foreach ($sheetsetting as  $sheet)
                        <div class="col-12 col-sm-4 col-md-3 mb-4">
                            <a href="{{ route('lecture.sheet.detail',$sheet->id) }}" class="sheet-box">
                                <div class="sheet-image">
                                    <img src="{{ asset($sheet->sheets?$sheet->sheets->thumbnail:'')  }}" alt="">
                                </div>
                                <div class="sheet-head">
                                    <h4> {{$sheet->sheets?$sheet->sheets->sheet_no:'' }} </h4>
                                </div>
                                <div class="sheet-price">
                                    <p>
                                        <span class="sheet-price-name">Price :</span>
                                        @if($sheet->amounts?$sheet->amounts->pay_time_id:''==3)
                                        Free
                                        @else
                                        <span class="sheet-price">{{ $sheet->amounts?$sheet->amounts->amount:''}} taka</span>
                                        @endif
                                    </p>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- lecture section -->


    <!-- Old School Question -->
    <section class="py-5 bgc">
        <div class="container">
            <div class="card  bg-light border-primary">
                <div class="card-header">
                          Previous Schools Questions
                </div>
                <div class="card-body">
                    <div class="row">
                    @foreach ($schools as $school)
                    <div class="col-md-3">
                        <a href="{{ route('old.questions',['school_id' => $school->id]) }}" class="school-question box my-3 mx-1">
                            <span>{{ $school->sessions->count() }}</span>
                            <h4>{{ $school->institute }}</h4>
                        </a>
                    </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Old School Question -->


    <!-- Old College Question -->
    <section class="py-5 bgc">
        <div class="container">
            <div class="card  bg-light border-primary">
                <div class="card-header">
                          Previous College Questions
                </div>
                <div class="card-body">
                    <div class="row">
                    @foreach ($colleges as $school)
                    <div class="col-md-3">
                        <a href="{{ route('old.questions',['school_id' => $school->id]) }}" class="school-question box my-3 mx-1">
                            <span>{{ $school->sessions->count() }}</span>
                            <h4>{{ $school->institute }}</h4>
                        </a>
                    </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Old College Question -->

    <!-- Old Board Question -->
    <section class="py-5 bgc">
        <div class="container">
            <div class="card  bg-light border-primary">
                <div class="card-header card-primary">
                          Previous Board Questions
                </div>
                <div class="card-body">
                    <div class="row">
                    @foreach ($boards as $board)
                    <div class="col-md-3">
                        <a href="{{ route('old.questions',['board_id' => $board->id]) }}" class="school-question box my-3 mx-1">
                            <span>{{ $board->years->count() }}</span>
                            <h4>{{ $board->name }}</h4>
                        </a>
                    </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Old Board Question -->

    <section class="p-blog-section py-3">
        <div class="container py-4">
            <div class="row">
                <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <h2>Our latest Blogs</h2>
                            <a href="#" class="see-all">Show All <i class="fa fa-angle-double-right"></i></a>
                        </div>
                        <hr>
                </div>
            </div>
            <div class="details-box">
                <div class="row">
                    @foreach ($blogs as $blog)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="p-blog-box">
                            <div class="card">
                                <div class="blog-img">
                                    <a href="{{ route('blog.detail',$blog->slug) }}">
                                        <img src="{{ asset($blog->image) }}" class="card-img-top" alt="blog-photo">
                                    </a>
                                </div>
                                <div class="card-body custom-card">
                                    <a href="{{ route('blog.detail',$blog->slug) }}">  {{ $blog->title }} </a>
                                    <span>
                                        <i class="fa fa-user"></i> {{ $blog->user?$blog->user->name:'' }} <i class="fa fa-clock-o"></i> {{ date('d-M-Y',strtotime($blog->created_at)) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>



    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img src="{{ asset('public/frontend/photos/studying.svg')  }}" alt="" width="50%" >
                </div>
            </div>
        </div>
    </section>

@endsection
