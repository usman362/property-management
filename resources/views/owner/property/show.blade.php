@extends('owner.layouts.app')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- Page Content Wrapper Start -->
                <div class="page-content-wrapper bg-white p-30 radius-20">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div
                                class="page-title-box d-sm-flex align-items-center justify-content-between border-bottom mb-20">
                                <div class="page-title-left">
                                    <h3 class="mb-sm-0">{{ $pageTitle }}</h3>
                                </div>
                                <div class="page-title-right">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('owner.dashboard') }}"
                                                title="Dashboard">{{ __('Dashboard') }}</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('owner.property.allProperty') }}"
                                                title="{{ __('Apartments') }}">{{ __('Apartments') }}</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Property Details Area row Start -->
                    <div class="row">
                        <!-- Property Details Top Bar Start -->
                        <div class="property-top-search-bar property-details-top-bar mb-25">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>{{ $apartment->apartment_name ?? 'Null' }}</h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="property-details-right text-end">
                                        <a href="{{ route('owner.property.edit', $apartment->id) }}" class="edit-btn"
                                            title="{{ __('Edit Info') }}">{{ __('Edit Info') }}<i
                                                class="ri-arrow-right-line ms-2"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Property Details Top Bar End -->

                        <!-- Property Details Wrap Start -->
                        <div class="property-details-area">

                            <!-- Property details table -->
                            <div class="property-details-table bg-off-white mb-25 p-25 radius-4">
                                <div class="property-details-table-title border-bottom mb-25 pb-25">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <h4>{{ __('Apartment Details') }}</h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table theme-border bg-off-white p-20">
                                            <tbody>
                                                <tr>
                                                    <th>{{ __('Apartment Name') }}</th>
                                                    <td class="text-end">{{ $apartment->apartment_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Building Name') }}</th>
                                                    <td class="text-end">{{ $apartment->building->name ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Floor') }}</th>
                                                    <td class="text-end">{{ $apartment->floor }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Monthly Rental Price') }}</th>
                                                    <td class="text-end">{{ $apartment->monthly_rental_price }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Balcony Area') }}</th>
                                                    <td class="text-end">{{ $apartment->balcony_area }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Living Room Area') }}</th>
                                                    <td class="text-end">{{ $apartment->living_room_area }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Dining Room Area') }}</th>
                                                    <td class="text-end">{{ $apartment->dining_room_area }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Kitchen Area') }}</th>
                                                    <td class="text-end">{{ $apartment->kitchen_area }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Alley Area') }}</th>
                                                    <td class="text-end">{{ $apartment->alley_area }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Main Bedroom Area') }}</th>
                                                    <td class="text-end">{{ $apartment->main_bedroom_area }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Second Bedroom Area') }}</th>
                                                    <td class="text-end">{{ $apartment->second_bedroom_area }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Third Bedroom Area') }}</th>
                                                    <td class="text-end">{{ $apartment->third_bedroom_area }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Bathroom Area') }}</th>
                                                    <td class="text-end">{{ $apartment->bathroom_area }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Public Area') }}</th>
                                                    <td class="text-end">{{ $apartment->public_area }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Property details gallery -->
                            <div class="property-details-gallery mb-25">
                                <div class="col-12">
                                    <h4 class="mb-3">{{ __('Image Gallery') }}</h4>
                                    <div class="gallery-slider-carousel owl-carousel owl-theme">
                                        @forelse (@$apartment->images as $apartmentImage)
                                            <div class="gallery-item radius-4">
                                                <div class="gallery-img">
                                                    <a href="{{ asset('/storage/'.@$apartmentImage->media) }}"
                                                        class="venobox" data-gall="gallery01">
                                                        <img src="{{ asset('/storage/'.@$apartmentImage->media) }}"
                                                            alt="" style="height: 140px" class="img-fluid">
                                                    </a>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="gallery-item radius-4">
                                                <div class="gallery-img">
                                                    <a href="{{ asset('assets/images/users/empty-user.jpg') }}" class="venobox" data-gall="gallery01">
                                                        <img src="{{ asset('assets/images/users/empty-user.jpg') }}"
                                                            alt="" class="img-fluid">
                                                    </a>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>

                                </div>
                            </div>


                            <!-- Property details gallery -->
                            <div class="property-details-gallery mb-25">
                                <div class="col-12">
                                    <h4 class="mb-3">{{ __('Video Gallery') }}</h4>
                                    <div class="gallery-slider-carousel owl-carousel owl-theme">
                                        @forelse (@$apartment->videos as $apartmentImage)
                                            <div class="gallery-item radius-4">
                                                <div class="gallery-img">
                                                    <video src="{{ asset('/storage/'.@$apartmentImage->media) }}" style="height: 140px" class="img-fluid" controls></video>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="gallery-item radius-4">
                                                <div class="gallery-img">
                                                    <a href="{{ asset('assets/images/users/empty-user.jpg') }}" class="venobox" data-gall="gallery01">
                                                        <img src="{{ asset('assets/images/users/empty-user.jpg') }}"
                                                            alt="" class="img-fluid">
                                                    </a>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- Property Details Wrap End -->
                    </div>
                    <!-- Property Details Area row End -->
                </div>
                <!-- Page Content Wrapper End -->
            </div>
        </div>
        <!-- End Page-content -->
    </div>
@endsection
