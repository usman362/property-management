@extends('frontend.layouts.app')
@section('content')
    <!-- page header -->
    <div class="rts__section page__hero__height page__hero__bg"
        style="background-image: url({{ asset('f2/assets/images/pages/header__bg.webp') }});">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-12">
                    <div class="page__hero__content">
                        <h1 class="wow fadeInUp">{{ $building->name }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page header end -->

    <!-- similar room area -->
    <div class="rts__section pb-120 pt-120 ">
        <div class="container">
            <div class="row justify-content-center text-center mb-40">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="section__topbar">
                        <span class="h6 subtitle__icon__three mx-auto">Apartments</span>
                        <h2 class="section__title">Apartments</h2>
                    </div>
                </div>
            </div>
            <div class="row g-30">
                @foreach ($apartments as $apartment)
                    <div class="col-lg-6 col-xl-4 col-md-6">
                        <div class="room__card">
                            <div class="room__card__top">
                                <div class="room__card__image">
                                    <a href="{{ route('apartment.details', $apartment->id) }}">
                                        <img src="{{ asset((isset($apartment->images[0]) ? $apartment->images[0]->media : '')) }}" width="420" height="310"
                                            alt="room card">
                                    </a>
                                </div>
                            </div>
                            <div class="room__card__meta">
                                <a href="{{ route('apartment.details', $apartment->id) }}" class="room__card__title h5">{{$apartment->apartment_name}}</a>
                                <div class="room__price__tag">
                                    <span class="h6 d-block">{{$apartment->monthly_rental_price}}$</span>
                                </div>
                                <a href="{{ route('apartment.details', $apartment->id) }}" class="room__card__link">Discover More</a>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- similar room area end -->

    <div class="container">
        <div class="row position-relative justify-content-center text-center mb-30">
            <div class="col-lg-6 wow fadeInUp">
                <div class="section__topbar">
                    <span class="h6 subtitle__icon__three mx-auto">Gallery</span>
                    <h2 class="section__title">Our Gallery</h2>
                </div>
            </div>
        </div>
        <div class="row m-4">
            <div class="gallery__slider overflow-hidden">
                <div class="swiper-wrapper gallery">
                    @foreach ($building->images as $image)
                        <!-- single gallery image -->
                        <div class="swiper-slide">
                            <div class="gallery__item">
                                <a href="{{ asset($image->media) }}">
                                    <img style="height: 150px; width:100%" src="{{ asset($image->media) }}"
                                        alt="">
                                </a>
                            </div>
                        </div>
                        <!-- single gallery image end -->
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <!-- room details area -->

    <div class="rts__section section__padding">
        <div class="row position-relative justify-content-center text-center">
            <div class="col-lg-6 wow fadeInUp">
                <div class="section__topbar">
                    <span class="h6 subtitle__icon__three mx-auto">Videos</span>
                    <h2 class="section__title">Our Videos</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row g-5 sticky-wrap">
                <div class="room__details">
                    <div class="room__image__group row row-cols-md-2 row-cols-sm-1 mt-30 mb-50 gap-4 gap-md-0">
                        @foreach ($building->videos as $image)
                            <div class="room__image__item">
                                <video id="video" class="rounded-2" src="{{ asset($image->media) }}"
                                    autoplay controls></video>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- room details area end -->
@endsection

@push('scripts')
    <script>
        const player = new Plyr('#video', {
            controls: ['play', 'pause', 'volume', 'progress', 'fullscreen'], // Exclude download
        });
    </script>
@endpush
