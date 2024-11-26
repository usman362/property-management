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
                                                title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <!-- All tenants Area row Start -->
                    <div class="row">
                        <!-- Tenants Top Bar Start -->
                        <div class="tenants-top-bar">
                            <div class="property-search-inner-bg bg-off-white theme-border radius-4 p-25 pb-0 mb-25">
                                <div class="row">
                                    <div class="col-xl-12 col-xxl-6 tenants-top-bar-left">

                                    </div>

                                    <div class="col-xl-12 col-xxl-6 tenants-top-bar-right">
                                        <div class="row justify-content-end">
                                            <div class="col-auto mb-25">
                                                <a href="{{ route('tenant.create') }}" class="theme-btn w-auto"
                                                    title="{{ __('Add New Tenant') }}">{{ __('Add New Tenant') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Tenants Top Bar End -->

                        <!-- Tenants Item Wrap Start -->
                        <div class="properties-item-wrap">
                            <div class="row">
                                @forelse ($tenants as $tenant)
                                    <div class="single-tenant col-md-6 col-lg-6 col-xl-6 col-xxl-3 d-none">
                                        <div class="property-item tenants-item bg-off-white theme-border radius-10 mb-25">
                                            <div class="property-item-content tenants-item-content p-20">
                                                <div
                                                    class="property-item-address tenants-img-info-box d-flex align-items-center mb-20">
                                                    <div class="flex-grow-1 ms-3">
                                                        <h4 class="mb-1">{{ $tenant->first_name }}
                                                            {{ $tenant->last_name }}</h4>
                                                        <p class="font-13 text-break">{{ $tenant->email }}</p>
                                                    </div>
                                                    <a href="{{ route('tenant.edit', $tenant->id) }}"
                                                        class="p-1 tbl-action-btn" title="{{ __('Edit') }}"><span
                                                            class="iconify"
                                                            data-icon="material-symbols:edit-square-outline"></span></a>
                                                    <a href="{{ route('tenant.delete', $tenant->id) }}"
                                                        class="p-1 tbl-action-btn" title="{{ __('Delete') }}"><span
                                                            class="iconify"
                                                            data-icon="material-symbols:delete-outline"></span></a>
                                                </div>
                                                <div class="tenants-item-info bg-white radius-4 theme-border">
                                                    <div class="border-bottom tenants-item-info-box">
                                                        <div class="row align-items-center">
                                                            <div class="col-md-5">
                                                                <div class="tenants-info-left font-13 color-heading">
                                                                    {{ __('Contact No.') }}</div>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <div class="tenants-info-right font-13 text-end"><i
                                                                        class="ri-phone-fill me-2"></i><a
                                                                        href="tel:{{ $tenant->phone_number }}">{{ $tenant->phone_number }}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="border-bottom tenants-item-info-box">
                                                        <div class="row align-items-center">
                                                            <div class="col-md-5">
                                                                <div class="tenants-info-left font-13 color-heading">
                                                                    {{ __('Building Name') }}</div>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <div class="tenants-info-right font-13 text-end">
                                                                    {{ $tenant->building->name ?? '' }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="border-bottom tenants-item-info-box">
                                                        <div class="row align-items-center">
                                                            <div class="col-md-5">
                                                                <div class="tenants-info-left font-13 color-heading">
                                                                    {{ __('Apartment Number') }}</div>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <div class="tenants-info-right font-13 text-end">
                                                                    {{ $tenant->apartment->apartment_name ?? '' }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="border-bottom tenants-item-info-box">
                                                        <div class="row align-items-center">
                                                            <div class="col-md-5">
                                                                <div class="tenants-info-left font-13 color-heading">
                                                                    {{ __('Contract Date') }}</div>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <div class="tenants-info-right font-13 text-end">
                                                                    {{ $tenant->contract_date }}</div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <a href="{{ route('tenant.details', [$tenant->id]) }}"
                                                    class="theme-btn mt-20 w-100"
                                                    title="{{ __('View Details') }}">{{ __('View Details') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <!-- Empty Properties row -->
                                    <div class="row justify-content-center">
                                        <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                                            <div class="empty-properties-box text-center">
                                                <img src="{{ asset('assets/images/empty-img.png') }}" alt=""
                                                    class="img-fluid">
                                                <h3 class="mt-25">{{ __('Empty') }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Empty Properties row -->
                                @endforelse
                            </div>
                        </div>
                        <!-- Tenants Item Wrap End -->
                    </div>
                    <!-- All tenants Area row End -->
                </div>
                <!-- Page Content Wrapper End -->
            </div>
        </div>
        <!-- End Page-content -->
    </div>
@endsection
@if (getOption('app_card_data_show', 1) != 1)
    @push('style')
        @include('common.layouts.datatable-style')
    @endpush
    @push('script')
        @include('common.layouts.datatable-script')
        <script src="{{ asset('assets/js/custom/tenant-datatable.js') }}"></script>
    @endpush
@endif
@push('script')
    <script src="{{ asset('assets/js/custom/tenant-list.js') }}"></script>
@endpush
