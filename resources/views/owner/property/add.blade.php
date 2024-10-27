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
                                                title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('owner.property.allProperty') }}"
                                                title="{{ __('Properties') }}">{{ __('Properties') }}</a>
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
                                        <form class="ajax"
                                            action="http://127.0.0.1:3003/owner/property/property-information/store"
                                            method="post" data-handler="stepChange">
                                            <input type="hidden" name="_token"
                                                value="MEV36zeJn6nhYBLQFRpSv5G5F1xdRETHPIWE5Q7n"> <input type="text"
                                                name="property_id" class="d-none" value="">
                                            <input type="text" name="property_type" class="d-none" id="property_type"
                                                value="1">
                                            <div class="form-card add-property-box bg-off-white theme-border radius-4 p-20">
                                                <div class="add-property-title border-bottom pb-25 mb-25">
                                                    <h4>Property Information</h4>
                                                </div>

                                                <div class="add-property-inner-box bg-white theme-border radius-4 p-20">
                                                    <div class="tab-content" id="myTabContent">
                                                        <div class="tab-pane fade show active" id="own-property-tab-pane"
                                                            role="tabpanel" aria-labelledby="own-property-tab"
                                                            tabindex="0">
                                                            <div class="row">
                                                                <div class="col-md-6 mb-25">
                                                                    <label
                                                                        class="label-text-title color-heading font-medium mb-2">Property
                                                                        Name</label>
                                                                    <input type="text" class="form-control"
                                                                        name="own_property_name" placeholder="Property Name"
                                                                        value="">
                                                                </div>
                                                                <div class="col-md-6 mb-25">
                                                                    <label
                                                                        class="label-text-title color-heading font-medium mb-2">Number
                                                                        of Units</label>
                                                                    <input type="number" min="1"
                                                                        class="form-control" name="own_number_of_unit"
                                                                        value="" placeholder="Number of Units">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12 mb-25">
                                                                    <label
                                                                        class="label-text-title color-heading font-medium mb-2">Description</label>
                                                                    <textarea class="form-control" name="own_description" placeholder="Description"></textarea>
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

    <input type="hidden" id="property_id" value="{{ @$property->id }}">
    <input type="hidden" id="getStateListRoute" value="{{ route('owner.location.state.list') }}">
    <input type="hidden" id="getCityListRoute" value="{{ route('owner.location.city.list') }}">
    <input type="hidden" id="imageStoreRoute" value="{{ route('owner.property.image.store') }}">
    <input type="hidden" id="imageDoc" value="{{ route('owner.property.image.doc') }}">
    <input type="hidden" id="getPropertyInformationRoute" value="{{ route('owner.property.getPropertyInformation') }}">
    <input type="hidden" id="getLocationRoute" value="{{ route('owner.property.getLocation') }}">
    <input type="hidden" id="getUnitRoute" value="{{ route('owner.property.getUnitByPropertyId') }}">
    <input type="hidden" id="getRentChargeRoute" value="{{ route('owner.property.getRentCharge') }}">
@endsection

@push('script')
    <script src="{{ asset('assets/js/custom/property.js') }}"></script>
@endpush
