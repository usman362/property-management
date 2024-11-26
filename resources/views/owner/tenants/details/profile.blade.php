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
                                        <li class="breadcrumb-item"><a href="{{ route('tenant.index') }}"
                                                title="{{ __('Tenants') }}">{{ __('Tenants') }}</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Tenants Details Layout Wrap Area row Start -->
                    <div class="tenants-details-layout-wrap position-relative">
                        <div class="row">

                            <!-- Account settings Area Right Side Start-->
                            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                <div class="account-settings-rightside bg-off-white theme-border radius-4 p-25">

                                    <!-- Tenants Profile Information Start -->
                                    <div class="tenants-profile-information">


                                        <!-- Account Settings Content Box Start -->
                                        <div class="account-settings-content-box bg-white theme-border radius-4 mb-25 p-20">

                                            <div class="account-settings-title border-bottom mb-20 pb-20">
                                                <div class="row align-items-center">
                                                    <div class="col-md-6">
                                                        <h4>{{ __('Personal Information') }}</h4>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="property-details-right text-end">
                                                            <a href="{{ route('tenant.edit', $tenant->id) }}"
                                                                class="edit-btn"
                                                                title="{{ __('Edit Info') }}">{{ __('Edit Info') }}<i
                                                                    class="ri-arrow-right-line ms-2"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="account-settings-info-box">
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Name') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->first_name }} {{ $tenant->last_name }}</p>
                                                    </div>
                                                </div>
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Partner Name') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->partner_first_name }} {{ $tenant->partner_last_name }}</p>
                                                    </div>
                                                </div>
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Contact Number') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->phone_number }}</p>
                                                    </div>
                                                </div>
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Address') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->address }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Account Settings Content Box End -->

                                        <!-- Account Settings Content Box Start -->
                                        <div class="account-settings-content-box bg-white theme-border radius-4 mb-25 p-20">

                                            <div class="account-settings-title border-bottom mb-20 pb-20">
                                                <div class="row align-items-center">
                                                    <div class="col-md-6">
                                                        <h4>{{ __('Workplace Information') }}</h4>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="account-settings-info-box">
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Workplace Name') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->working_place_name }}</p>
                                                    </div>
                                                </div>
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Workplace Address') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->working_place_address }}</p>
                                                    </div>
                                                </div>
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Workplace Contact') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->working_place_contact }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Workplace Email') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->working_place_email }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Account Settings Content Box End -->

                                        <!-- Account Settings Content Box Start -->
                                        <div class="account-settings-content-box bg-white theme-border radius-4 p-20">
                                            <div class="account-settings-title border-bottom mb-20 pb-20">
                                                <div class="row align-items-center">
                                                    <div class="col-md-6">
                                                        <h4>{{ __('Guarantor Information') }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="account-settings-info-box">
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Guarantor Name') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->guarantor_first_name }} {{$tenant->guarantor_last_name}}</p>
                                                    </div>
                                                </div>
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Address') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->guarantor_address }}</p>
                                                    </div>
                                                </div>
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Phone Number') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->guarantor_phone_number }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Cellphone Number') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->guarantor_cellphone_number }}</p>
                                                    </div>
                                                </div>
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Workplace Name') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->guarantor_working_place_name }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Workplace Address') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->guarantor_working_place_address }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Workplace Contact') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->guarantor_working_place_contact }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Workplace Email') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->guarantor_working_place_email }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Account Settings Content Box End -->


                                        <!-- Account Settings Content Box Start -->
                                        <div class="account-settings-content-box bg-white theme-border radius-4 p-20">
                                            <div class="account-settings-title border-bottom mb-20 pb-20">
                                                <div class="row align-items-center">
                                                    <div class="col-md-6">
                                                        <h4>{{ __('Additional Information') }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="account-settings-info-box">
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Building Name') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->building->name ?? '' }}</p>
                                                    </div>
                                                </div>
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Apartment Number') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->apartment->apartment_name ?? '' }}</p>
                                                    </div>
                                                </div>
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Check-In Date') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->check_in_date }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Check-Out Date') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->check_out_date }}</p>
                                                    </div>
                                                </div>
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Contract Date') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->contract_date }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Monthly Fees') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->monthly_fees }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Deposit Amount') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->deposit_amount }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Payment Type') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->deposit_type }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Monthly Due Date') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->monthly_due_date }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Late Fees') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->late_fees }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row account-settings-info-item">
                                                    <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2">
                                                        <p class="color-heading">{{ __('Date') }}:</p>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8 col-xl-8 col-xxl-10">
                                                        <p>{{ $tenant->date }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Account Settings Content Box End -->

                                    </div>
                                    <!-- Tenants Profile Information End -->
                                </div>
                            </div>
                            <!-- Account settings Area Right Side End-->
                        </div>
                    </div>
                    <!-- Tenants Details Layout Wrap Area row End -->
                </div>
                <!-- Page Content Wrapper End -->
            </div>
        </div>
        <!-- End Page-content -->
    </div>

    <!-- Add Currency Modal End -->
    <input type="hidden" id="tenantListRoute" value="{{ route('tenant.index') }}">
@endsection
@push('script')
    <script src="{{ asset('assets/js/custom/tenant.js') }}"></script>
@endpush
