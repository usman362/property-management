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
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between border-bottom mb-20">
                            <div class="page-title-left">
                                <h3 class="mb-sm-0">{{ $pageTitle }}</h3>
                            </div>
                            <div class="page-title-right">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('property.allProperty') }}" title="{{ __('Apartments') }}">{{ __('Apartments') }}</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <!-- All Property Area row Start -->
                <div class="all-property-area">
                    <!-- Add Property Stepper Area Start -->
                    <div class="add-property-stepper-area">
                        <div class="row">
                            <!-- Stepper Start -->
                            <div class="col-12">
                                <div id="msform">
                                    <!-- Start:: fieldSets -->
                                    <form class="ajax" action="{{route('property.property-information.store')}}" method="post" data-handler="stepChange">
                                        @csrf
                                        <input type="hidden" name="apartment_id" value="{{ @$apartment->id }}">
                                        <div class="form-card add-property-box bg-off-white theme-border radius-4 p-20">
                                            <div class="add-property-title border-bottom pb-25 mb-25">
                                                <h4>Apartment Information</h4>
                                            </div>

                                            <div class="add-property-inner-box bg-white theme-border radius-4 p-20">
                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade show active" id="own-property-tab-pane" role="tabpanel" aria-labelledby="own-property-tab" tabindex="0">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-25">
                                                                <label class="label-text-title color-heading font-medium mb-2">Apartment
                                                                    Name</label>
                                                                <input type="text" class="form-control" name="apartment_name" placeholder="Apartment Name" value="{{@$apartment->apartment_name}}">
                                                            </div>

                                                            <div class="col-md-6 mb-25">
                                                                <label class="label-text-title color-heading font-medium mb-2">Building
                                                                    Name</label>
                                                                <select name="building_id" class="form-control" id="">
                                                                    <option value="">Select Building</option>
                                                                    @foreach ($buildings as $bldg)
                                                                    <option value="{{ $bldg->id }}" @selected(@$apartment->building_id == $bldg->id)>
                                                                        {{ $bldg->name }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-md-6 mb-25">
                                                                <label class="label-text-title color-heading font-medium mb-2">Floor</label>
                                                                <input type="text" class="form-control" name="floor" placeholder="Floor" value="{{@$apartment->floor}}">
                                                            </div>

                                                            <div class="col-md-6 mb-25">
                                                                <label class="label-text-title color-heading font-medium mb-2">Monthly
                                                                    Rental Price</label>
                                                                <input type="text" class="form-control" name="monthly_rental_price" placeholder="Monthly Rental Price" value="{{@$apartment->monthly_rental_price}}">
                                                            </div>

                                                            <div class="col-md-6 mb-25">
                                                                <label class="label-text-title color-heading font-medium mb-2">Status</label>
                                                                <select name="status" id="status" class="form-control">
                                                                    <option value="empty" @selected(@$apartment->status == 'empty')>Empty</option>
                                                                    <option value="occupied" @selected(@$apartment->status == 'occupied')>Occupied</option>
                                                                    <option value="vacant" @selected(@$apartment->status == 'vacant')>Vacant</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-6 mb-25">
                                                                <label class="label-text-title color-heading font-medium mb-2">Balcony
                                                                    Area</label>
                                                                <input type="text" class="form-control" name="balcony_area" placeholder="Balcony Area" value="{{@$apartment->balcony_area}}">
                                                            </div>

                                                            <div class="col-md-6 mb-25">
                                                                <label class="label-text-title color-heading font-medium mb-2">Living
                                                                    Room Area</label>
                                                                <input type="text" class="form-control" name="living_room_area" placeholder="Living Room Area" value="{{@$apartment->living_room_area}}">
                                                            </div>

                                                            <div class="col-md-6 mb-25">
                                                                <label class="label-text-title color-heading font-medium mb-2">Dining
                                                                    Room Area</label>
                                                                <input type="text" class="form-control" name="dining_room_area" placeholder="Dining Room Area" value="{{@$apartment->dining_room_area}}">
                                                            </div>

                                                            <div class="col-md-6 mb-25">
                                                                <label class="label-text-title color-heading font-medium mb-2">Kitchen
                                                                    Area</label>
                                                                <input type="text" class="form-control" name="kitchen_area" placeholder="Kitchen Area" value="{{@$apartment->kitchen_area}}">
                                                            </div>

                                                            <div class="col-md-6 mb-25">
                                                                <label class="label-text-title color-heading font-medium mb-2">Alley
                                                                    Area</label>
                                                                <input type="text" class="form-control" name="alley_area" placeholder="Alley Area" value="{{@$apartment->alley_area}}">
                                                            </div>

                                                            <div class="col-md-6 mb-25">
                                                                <label class="label-text-title color-heading font-medium mb-2">Main
                                                                    Bedroom Area</label>
                                                                <input type="text" class="form-control" name="main_bedroom_area" placeholder="Main Bedroom Area" value="{{@$apartment->main_bedroom_area}}">
                                                            </div>

                                                            <div class="col-md-6 mb-25">
                                                                <label class="label-text-title color-heading font-medium mb-2">Second
                                                                    Bedroom Area</label>
                                                                <input type="text" class="form-control" name="second_bedroom_area" placeholder="Second Bedroom Area" value="{{@$apartment->second_bedroom_area}}">
                                                            </div>

                                                            <div class="col-md-6 mb-25">
                                                                <label class="label-text-title color-heading font-medium mb-2">Third
                                                                    Bedroom Area</label>
                                                                <input type="text" class="form-control" name="third_bedroom_area" placeholder="Third Bedroom Area" value="{{@$apartment->third_bedroom_area}}">
                                                            </div>

                                                            <div class="col-md-6 mb-25">
                                                                <label class="label-text-title color-heading font-medium mb-2">Bathroom
                                                                    Area</label>
                                                                <input type="text" class="form-control" name="bathroom_area" placeholder="Bathroom Area" value="{{@$apartment->bathroom_area}}">
                                                            </div>

                                                            <div class="col-md-6 mb-25">
                                                                <label class="label-text-title color-heading font-medium mb-2">Public
                                                                    Area</label>
                                                                <input type="text" class="form-control" name="public_area" placeholder="Public Area" value="{{@$apartment->public_area}}">
                                                            </div>

                                                            <div class="col-md-6 mb-25">
                                                                <label class="label-text-title color-heading font-medium mb-2">Upload
                                                                    Images</label>
                                                                <input type="file" class="form-control" name="images[]" multiple>
                                                            </div>

                                                            <div class="col-md-6 mb-25">
                                                                <label class="label-text-title color-heading font-medium mb-2">Upload
                                                                    Videos</label>
                                                                <input type="file" class="form-control" name="videos[]" multiple>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Next/Previous Button Start -->
                                        <button type="submit" class="action-button theme-btn mt-25">Save &amp; Go to
                                            Next</button>
                                    </form>

                                    <!-- End:: fieldSets -->
                                </div>
                            </div>
                            <!-- Stepper End -->
                        </div>
                    </div>
                    <!-- Add Property Stepper Area End -->
                </div>
                <!-- All Property Area row End -->
            </div>
            <!-- Page Content Wrapper End -->
        </div>
    </div>
    <!-- End Page-content -->
</div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/custom/property.js') }}"></script>
@endpush
