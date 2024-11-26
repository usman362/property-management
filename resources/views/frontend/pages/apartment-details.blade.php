@extends('frontend.layouts.app')
@section('content')
    <!-- page header -->
    <div class="rts__section page__hero__height page__hero__bg"
        style="background-image: url({{ asset('f2/assets/images/pages/header__bg.webp') }});">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-12">
                    <div class="page__hero__content">
                        <h1 class="wow fadeInUp">{{ $apartment->apartment_name }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page header end -->
    <!-- room details two top -->
    <div class="rts__section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="room__details__top">
                        <span class="h2 price">{{ $apartment->monthly_rental_price }}$</span>
                        <h1>{{ $apartment->apartment_name }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- room details two top end -->

    <div class="container">
        <div class="row position-relative justify-content-center text-center mb-30 pt-120">
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
                    @foreach ($apartment->images as $image)
                        <!-- single gallery image -->
                        <div class="swiper-slide">
                            <div class="gallery__item">
                                <a href="{{ asset('storage/' . $image->media) }}">
                                    <img style="height: 150px; width:100%" src="{{ asset('storage/' . $image->media) }}"
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
                        @foreach ($apartment->videos as $image)
                            <div class="room__image__item">
                                <video id="video" class="rounded-2" src="{{ asset('storage/' . $image->media) }}"
                                    autoplay controls></video>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- room details area end -->

    @if ($apartment->status == 'empty')
        <div class="container pb-100">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10">
                    <div class="comment__form mt-40">
                        <h6 class="mb-3">Submit Application</h6>
                        <form action="{{ route('application.store') }}" class="comment__form__content" method="post">
                            @csrf
                            <input type="hidden" name="building_id" value="{{ $apartment->building_id }}">
                            <input type="hidden" name="apartment_id" value="{{ $apartment->id }}">
                            <div class="input-group">
                                <div class="form-group">
                                    <label>{{ __('First Name') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="first_name" value="{{ @$tenant->first_name }}"
                                        class="form-control" placeholder="{{ __('First Name') }}">
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Last Name') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="last_name" value="{{ @$tenant->last_name }}"
                                        class="form-control" placeholder="{{ __('Last Name') }}">
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="form-group">
                                    <label>{{ __('Address') }}</label>
                                    <input type="text" name="address" value="{{ @$tenant->address }}"
                                        class="form-control" placeholder="{{ __('Address') }}">
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Phone Number') }}</label>
                                    <input type="text" name="phone_number" value="{{ @$tenant->phone_number }}"
                                        class="form-control" placeholder="{{ __('Phone Number') }}">
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="form-group">
                                    <label>{{ __('Check-In Date') }}</label>
                                    <input type="date" name="check_in_date" value="" class="form-control"
                                        placeholder="{{ __('Check-In Date') }}">
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Check-Out Date') }}</label>
                                    <input type="date" name="check_out_date" value="" class="form-control"
                                        placeholder="{{ __('Check-Out Date') }}">
                                </div>
                            </div>
                            <button type="submit" class="theme-btn btn-style fill mt-4"><span>Submit</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <!-- blog -->
    <div class="rts__section pb-100">
        <div class="row position-relative justify-content-center text-center mb-4">
            <div class="col-lg-6 wow fadeInUp">
                <div class="section__topbar">
                    <span class="h6 subtitle__icon__three mx-auto">Comments</span>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10">
                    <div class="blog__details">
                        <div class="blog__details__content">
                            <div class="comment__list mb-4">
                                @foreach ($apartment->comments as $comment)
                                    <div class="comment__item">
                                        <div class="comment__item__author">
                                            <div class="author__img">
                                                <img class="rounded-1"
                                                    src="{{ asset('f2/assets/images/author/user-avatar.png') }}"
                                                    width="60" height="60" alt="">
                                            </div>
                                            <div class="author__info">
                                                <h6 class="font-20 mb-0">{{ $comment->name }}</h6>
                                                <span>{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        <div class="comment__text">
                                            <p class="font-sm">{{ $comment->comment }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- comment form -->
                            <div class="comment__form mt-40">
                                <h6 class="mb-3">Leave a Comment</h6>
                                <form action="{{ route('store.ApartmentComment', $apartment->id) }}"
                                    class="comment__form__content" method="post">
                                    @csrf
                                    <div class="input-group">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" id="name" name="name" class="form-control"
                                                placeholder="Your Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Your Email</label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                placeholder="Your Email" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="msg">Your Comment</label>
                                        <textarea id="msg" name="msg" class="form-control" placeholder="Your message" required></textarea>
                                    </div>
                                    <button type="submit" class="theme-btn btn-style fill mt-4"><span>Submit
                                            Comment</span></button>
                                </form>
                            </div>
                            <!-- comment form end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- blog end -->
@endsection

@push('scripts')
    <script>
        const player = new Plyr('#video', {
            controls: ['play', 'pause', 'volume', 'progress', 'fullscreen'], // Exclude download
        });
    </script>
@endpush
