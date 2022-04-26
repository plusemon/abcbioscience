@extends('frontend.layouts.app')
@section('title','EBook')
@section('content')


<!--	section-->
<section class="">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center pt-5">
                <div class="">
                    <h3>E-book</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!--	section end -->

<section class="py-5 bgc">
    <div class="container">
        @foreach ($classes as $class)
            <div class="card  bg-light border-info m-3">
                <div class="card-header card-primary">
                   Class:  {{ $class->name }}
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($class->ebook as $ebook)
                            <div class="col-xs-12 col-sm-3 col-md-2 my-2">
                                <div class="ebook text-center ebookbox  p-4">
                                        <div class="ebook-thumbnail">
                                            <img src="{{ asset($ebook->thumbnail) }}" alt="">
                                        </div>
                                        <div class="ebook-subject mt-3">
                                            {{ $ebook->subject->name }}
                                        </div>
                                        <a href="" class="btn btn-info text-white mt-4"><i class="fa fa-download"></i> Donwload </a>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    </div>


@endsection
