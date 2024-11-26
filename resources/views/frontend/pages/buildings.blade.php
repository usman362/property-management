@extends('frontend.layouts.app')
@section('content')
    <!-- page header -->
    <div class="rts__section page__hero__height page__hero__bg"
        style="background-image: url({{ asset('f2/assets/images/pages/header__bg.webp') }});">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-12">
                    <div class="page__hero__content">
                        <h1 class="wow fadeInUp">Buildings</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page header end -->

    <!-- advance search -->
    {{-- <div class="rts__section advance__search__section is__page has__border pt-120 pb-60">
        <div class="container">
            <div class="row">
                <form action="https://html.themewant.com/moonlit/room-two.html" method="post" class="advance__search">
                    <div class="advance__search__wrapper wow fadeInUp">
                        <!-- single input -->
                        <div class="query__input">
                            <label for="check__in" class="query__label">Check In</label>
                            <input type="text" id="check__in" name="check__in" placeholder="15 Jun 2024" required>
                            <div class="query__input__icon">
                                <i class="flaticon-calendar"></i>
                            </div>
                        </div>
                        <!-- single input end -->

                        <!-- single input -->
                        <div class="query__input">
                            <label for="check__out" class="query__label">Check Out</label>
                            <input type="text" id="check__out" name="check__out" placeholder="15 May 2024" required>
                            <div class="query__input__icon">
                                <i class="flaticon-calendar"></i>
                            </div>
                        </div>
                        <!-- single input end -->

                        <!-- single input -->
                        <div class="query__input">
                            <label for="adult" class="query__label ">Adult</label>
                            <select name="adult" id="adult" class="form-select">
                                <option value="1">1 Person</option>
                                <option value="2">2 Person</option>
                                <option value="3">3 Person</option>
                                <option value="4">4 Person</option>
                                <option value="5">5 Person</option>
                                <option value="6">6 Person</option>
                                <option value="7">7 Person</option>
                                <option value="8">8 Person</option>
                                <option value="9">9 Person</option>
                            </select>
                            <div class="query__input__icon">
                                <i class="flaticon-user"></i>
                            </div>
                        </div>
                        <!-- single input end -->

                        <!-- single input -->
                        <div class="query__input">
                            <label for="child" class="query__label ">Child</label>
                            <select name="child" id="child" class="form-select">
                                <option value="1">1 Child</option>
                                <option value="2">2 Child</option>
                                <option value="3">3 Child</option>
                                <option value="4">4 Child</option>
                                <option value="5">5 Child</option>
                                <option value="6">6 Child</option>
                                <option value="7">7 Child</option>
                                <option value="8">8 Child</option>
                                <option value="9">9 Child</option>
                            </select>
                            <div class="query__input__icon">
                                <i class="flaticon-user"></i>
                            </div>
                        </div>
                        <!-- single input end -->

                        <!-- submit button -->
                        <button class="theme-btn btn-style fill no-border search__btn">
                            <span>Check Now</span>
                        </button>
                        <!-- submit button end -->
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

    <!-- advance search end -->

    <!-- single rooms -->
    <div class="rts__section pb-120 mt-4">
        <div class="container">
            <div class="row g-30">
                @foreach ($buildings as $building)
                    <!-- single room -->
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="room__card">
                            <div class="room__card__top">
                                <div class="room__card__image">
                                    <a href="{{ route('building.show', $building->id) }}">
                                        <img src="{{ asset('storage/' . (isset($building->images[0]) ? $building->images[0]->media : '')) }}"
                                            width="420" height="310" alt="room card">
                                    </a>
                                </div>
                            </div>
                            <div class="room__card__meta">
                                <a href="{{ route('building.show', $building->id) }}"
                                    class="room__card__title h5">{{ $building->apartment_name }}</a>
                                <a href="{{ route('building.show', $building->id) }}" class="room__card__link">Discover
                                    More</a>
                            </div>
                        </div>
                    </div>
                    <!-- single room end -->
                @endforeach
            </div>
        </div>
    </div>
    <!-- single rooms end -->
@endsection
