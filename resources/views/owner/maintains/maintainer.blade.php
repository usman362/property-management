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
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"
                                                title="Dashboard">{{ __('Dashboard') }}</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Information Page Area row Start -->
                    <div class="row">
                        <!-- Property Top Search Bar Start -->
                        <h4 class="mb-20">{{ __('All Maintenance') }}</h4>
                        @can('add-maintenance')
                            <div class="property-top-search-bar">
                                <div class="property-search-inner-bg bg-off-white theme-border radius-4 p-25 pb-0 mb-25">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <div class="property-top-search-bar-left">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="property-top-search-bar-right text-end">
                                                <button type="button" class="theme-btn mb-25 add"
                                                    title="{{ __('Add Maintainer') }}">{{ __('Add Maintainer') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan
                        <!-- Property Top Search Bar End -->

                        <!-- All Maintainer Table Area Start -->
                        <div class="all-maintainer-table-area">
                            <!-- datatable Start -->
                            <div class="bg-off-white theme-border radius-4 p-25">
                                <table id="allMaintainerDataTable"
                                    class="table bg-off-white aaa theme-border dt-responsive">
                                    <thead>
                                        <tr>
                                            <th>{{ __('SL') }}</th>
                                            <th>{{ __('Building Name') }}</th>
                                            <th>{{ __('Apartment Number') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Maintenance Type') }}</th>
                                            <th>{{ __('Date') }}</th>
                                            <th>{{ __('Repair Fees') }}</th>
                                            <th>{{ __('Utensils Fees') }}</th>
                                            <th>{{ __('Monthly Fees') }}</th>
                                            <th>{{ __('Services') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- datatable End -->
                        </div>
                        <!-- All Maintainer Table Area End -->
                    </div>
                    <!-- Information Page Area row End -->
                </div>
                <!-- Page Content Wrapper End -->
            </div>
        </div>
        <!-- End Page-content -->
    </div>

    @can('add-maintenance')
        <!-- Add Information Modal Start -->
        <div class="modal fade" id="addMaintainerModal" tabindex="-1" aria-labelledby="addMaintainerModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form class="ajax" action="{{ route('maintainer.store') }}" method="POST" enctype="multipart/form-data"
                        data-handler="getShowMessage">
                        <input type="hidden" id="id" name="repair_id" value="">
                        <div class="modal-header">
                            <h4 class="modal-title" id="addMaintainerModalLabel">{{ __('Add Maintainer') }}</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                                    class="iconify" data-icon="akar-icons:cross"></span></button>
                        </div>
                        <div class="modal-body">
                            <!-- Modal Inner Form Box Start -->
                            <div class="modal-inner-form-box">
                                <div class="row">
                                    <div class="col-md-6 mb-25">
                                        <label
                                            class="label-text-title color-heading font-medium mb-2">{{ __('Building Name') }}</label>
                                        <select name="building_id" class="form-control" id="building_id">
                                            <option value="">Select Building</option>
                                            @foreach ($buildings as $bldg)
                                                <option value="{{ $bldg->id }}">
                                                    {{ $bldg->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-25">
                                        <label
                                            class="label-text-title color-heading font-medium mb-2">{{ __('Apartment Number') }}</label>
                                        <select name="apartment_id" class="form-control" id="apartment_id">
                                            <option value="">Select Apartment</option>
                                            @foreach ($apartments as $apartment)
                                                <option value="{{ $apartment->id }}">
                                                    {{ $apartment->apartment_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-25">
                                        <label
                                            class="label-text-title color-heading font-medium mb-2">{{ __('Status') }}</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="Checked In">{{ __('Checked In') }}</option>
                                            <option value="Checked Out">{{ __('Checked Out') }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-25">
                                        <label
                                            class="label-text-title color-heading font-medium mb-2">{{ __('Maintenance Type') }}</label>
                                        <select name="maintenance_type" id="maintenance_type" class="form-control">
                                            <option value="Plumber">{{ __('Plumber') }}</option>
                                            <option value="Electric">{{ __('Electric') }}</option>
                                            <option value="Structure">{{ __('Structure') }}</option>
                                            <option value="Other">{{ __('Other') }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-25">
                                        <label
                                            class="label-text-title color-heading font-medium mb-2">{{ __('Date') }}</label>
                                        <input type="date" name="date" id="date" class="form-control"
                                            placeholder="{{ __('Date') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-25">
                                        <label
                                            class="label-text-title color-heading font-medium mb-2">{{ __('Repair Fees') }}</label>
                                        <input type="number" step="0.01" name="repair_fees" id="repair_fees"
                                            class="form-control" placeholder="{{ __('Repair Fees') }}">
                                    </div>
                                    <div class="col-md-6 mb-25">
                                        <label
                                            class="label-text-title color-heading font-medium mb-2">{{ __('Utensils Fees') }}</label>
                                        <input type="number" step="0.01" name="utensils_fees" id="utensils_fees"
                                            class="form-control" placeholder="{{ __('Utensils Fees') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-25">
                                        <label
                                            class="label-text-title color-heading font-medium mb-2">{{ __('Details of Repair') }}</label>
                                        <textarea name="repair_details" id="repair_details" class="form-control" rows="3"
                                            placeholder="{{ __('Details of Repair') }}"></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-25">
                                        <label
                                            class="label-text-title color-heading font-medium mb-2">{{ __('Monthly Maintenance Fees') }}</label>
                                        <input type="number" step="0.01" name="monthly_maintenance_fees"
                                            id="monthly_maintenance_fees" class="form-control"
                                            placeholder="{{ __('Monthly Maintenance Fees') }}">
                                    </div>
                                    <div class="col-md-6 mb-25">
                                        <label
                                            class="label-text-title color-heading font-medium mb-2">{{ __('Services Included') }}</label>
                                        <select name="services_included" class="form-control" id="services_included">
                                            <option value="Included">{{ __('Included') }}</option>
                                            <option value="Not Included">{{ __('Not Included') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Inner Form Box End -->
                        </div>

                        <div class="modal-footer justify-content-start">
                            <button type="button" class="theme-btn-back me-3" data-bs-dismiss="modal"
                                title="{{ __('Back') }}">{{ __('Back') }}</button>
                            <button type="submit" class="theme-btn me-3"
                                title="{{ __('Submit') }}">{{ __('Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
    <!-- Add Information Modal End -->
    <input type="hidden" id="getInfoRoute" value="{{ route('maintainer.get.info') }}">
    <input type="hidden" id="route" value="{{ route('maintainer.index') }}">
@endsection
@push('style')
    @include('common.layouts.datatable-style')
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.css') }}">
@endpush

@push('script')
    @include('common.layouts.datatable-script')
    <script src="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/maintainer-profile-photo.init.js') }}"></script>
    <script src="{{ asset('assets/js/custom/maintainer.js') }}"></script>
@endpush
