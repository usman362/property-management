@extends('owner.layouts.app')

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="page-content-wrapper bg-white p-30 radius-20">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <div class="page-title-left">
                                    <h2 class="mb-sm-0">{{ __('Dashboard') }}</h2>
                                    <p>{{ __('Welcome back') }}, {{ auth()->user()->name }} <span class="iconify font-24"
                                            data-icon="openmoji:waving-hand"></span></p>
                                </div>
                                @can('add-apartments')
                                    <div class="page-title-right">
                                        <a href="{{ route('property.add') }}" class="theme-btn"
                                            title="{{ __('Add Apartment') }}">{{ __('Add Apartment') }}</a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <div class="dashboard-feature-item bg-off-white theme-border radius-4 p-20 mb-25">
                                <div
                                    class="dashboard-feature-item-icon-wrap font-20 d-flex align-items-center justify-content-center bg-white radius-4">
                                    <span class="iconify orange-color" data-icon="bxs:home-circle"></span>
                                </div>
                                <p class="mt-2">{{ __('Total Apartments') }}</p>
                                <h2 class="mt-1">{{ $totalProperties }}</h2>

                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <div class="dashboard-feature-item bg-off-white theme-border radius-4 p-20 mb-25">
                                <div
                                    class="dashboard-feature-item-icon-wrap font-20 d-flex align-items-center justify-content-center bg-white radius-4">
                                    <span class="iconify primary-color" data-icon="material-symbols:garage-home"></span>
                                </div>
                                <p class="mt-2">{{ __('Total Buildings') }}</p>
                                <h2 class="mt-1">{{ $totalBuildings }}</h2>

                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <div class="dashboard-feature-item bg-off-white theme-border radius-4 p-20 mb-25">
                                <div
                                    class="dashboard-feature-item-icon-wrap font-20 d-flex align-items-center justify-content-center bg-white radius-4">
                                    <span class="iconify orange-color" data-icon="bi:bar-chart-line-fill"></span>
                                </div>
                                <p class="mt-2">{{ __('Total Tenants') }}</p>
                                <h2 class="mt-1">{{ $totalTenants }}</h2>

                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <div class="dashboard-feature-item bg-off-white theme-border radius-4 p-20 mb-25">
                                <div
                                    class="dashboard-feature-item-icon-wrap font-20 d-flex align-items-center justify-content-center bg-white radius-4">
                                    <span class="iconify green-color" data-icon="bi:bar-chart-line-fill"></span>
                                </div>
                                <p class="mt-2">{{ __('Total Maintainers') }}</p>
                                <h2 class="mt-1">{{ $totalMaintainers }}</h2>
                            </div>
                        </div>
                    </div>
                    <!-- dashboard-feature-item row -->

                    <div class="row">
                        @can('view-apartments')
                            <div class="col-lg-7">
                                <div class="dashboard-properties-table bg-off-white theme-border p-20 radius-4 mb-25">
                                    <div class="">
                                        <div class="row align-items-center">
                                            <div class="col-12">
                                                <div class="d-flex align-items-center justify-content-between mb-25">
                                                    <h4 class="mb-0">{{ __('Apartments') }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table theme-border p-20">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ __('Name') }}</th>
                                                                <th>{{ __('Building') }}</th>
                                                                <th>{{ __('Floor') }}</th>
                                                                <th>{{ __('Monthly Rental Price') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($properties as $property)
                                                                <tr>
                                                                    <td>
                                                                        <h6 class="theme-text-color">
                                                                            {{ $property->apartment_name }}</h6>
                                                                    </td>
                                                                    <td>{{ $property->building->name ?? '' }}</td>
                                                                    <td>{{ $property->floor }}</td>
                                                                    <td>{{ $property->monthly_rental_price }}</td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td class="text-center">{{ __('No data found') }}</td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>

                                                    <div>
                                                        <a class="theme-link font-14 font-medium d-flex align-items-center justify-content-center mt-20"
                                                            href="{{ route('property.allProperty') }}">
                                                            {{ __('View All') }}<i class="ri-arrow-right-line ms-2"></i>
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan
                        @can('view-applications')
                            <div class="col-lg-5">
                                <div class="dashboard-properties-table bg-off-white theme-border p-20 radius-4 mb-25">
                                    <div class="">
                                        <div class="row align-items-center">
                                            <div class="col-12">
                                                <div class="d-flex align-items-center justify-content-between mb-25">
                                                    <h4 class="mb-0">{{ __('Applications') }}</h4>
                                                    <div>
                                                        <a class="theme-link font-14 font-medium d-flex align-items-center justify-content-center"
                                                            href="{{ route('applications.index') }}">
                                                            {{ __('View All') }}<i class="ri-arrow-right-line ms-2"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table theme-border p-20">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ __('Name') }}</th>
                                                                <th>{{ __('Check IN') }}</th>
                                                                <th>{{ __('Check OUT') }}</th>
                                                                <th>{{ __('Status') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($applications as $application)
                                                                <tr>
                                                                    <td>
                                                                        <h6 class="theme-text-color">
                                                                            {{ $application->first_name }}</h6>
                                                                    </td>
                                                                    <td>{{ $application->check_in_date }}</td>
                                                                    <td>{{ $application->check_out_date }}</td>
                                                                    <td>{{ $application->status }}</td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td class="text-center">{{ __('No data found') }}</td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/index-charts.js') }}"></script>
@endpush
