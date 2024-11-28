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
                                    @can('add-roles')
                                        <div class="col-xl-12 col-xxl-6 tenants-top-bar-right">
                                            <div class="row justify-content-end">
                                                <div class="col-auto mb-25">
                                                    <a href="{{ route('roles-permissions.create') }}" class="theme-btn w-auto"
                                                        title="{{ __('Add New Role') }}">{{ __('Add New Role') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <!-- Tenants Top Bar End -->

                        <!-- Tenants Item Wrap Start -->
                        <div class="properties-item-wrap">
                            <div class="row">
                                @forelse ($roles as $role)
                                    <div class="single-tenant col-md-6 col-lg-6 col-xl-6 col-xxl-3 d-none">
                                        <div class="property-item tenants-item bg-off-white theme-border radius-10 mb-25">
                                            <div class="property-item-content tenants-item-content p-20">
                                                <div
                                                    class="property-item-address tenants-img-info-box d-flex align-items-center mb-20">
                                                    <div class="flex-grow-1 ms-3">
                                                        <h4 class="mb-1">{{ $role->name }}</h4>
                                                    </div>
                                                    @can('edit-roles')
                                                        <a href="{{ route('roles-permissions.edit', $role->id) }}"
                                                            class="p-1 tbl-action-btn" title="{{ __('Edit') }}"><span
                                                                class="iconify"
                                                                data-icon="material-symbols:edit-square-outline"></span></a>
                                                    @endcan
                                                    @can('delete-roles')
                                                        <a href="{{ route('roles-permissions.delete', $role->id) }}"
                                                            class="p-1 tbl-action-btn" title="{{ __('Delete') }}"><span
                                                                class="iconify"
                                                                data-icon="material-symbols:delete-outline"></span></a>
                                                    @endcan
                                                </div>
                                                @can('view-permissions')
                                                    <div class="tenants-item-info bg-white radius-4 theme-border"
                                                        style="height: 300px;overflow-y: scroll;">
                                                        <div class="tenants-item-info-box">
                                                            <div class="row align-items-center">
                                                                <div class="col-md-12">
                                                                    <div class="tenants-info-left font-13 color-heading">
                                                                        {{ __('Permissions') }}</div>
                                                                    <hr>
                                                                    @forelse ($role->permissions as $permission)
                                                                        <div
                                                                            class="tenants-info-left font-12 color-heading mb-2">
                                                                            {{ $permission->name }}</div>
                                                                    @empty
                                                                        <div
                                                                            class="tenants-info-left font-12 color-heading mb-2">
                                                                            No Data Found!</div>
                                                                    @endforelse
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endcan
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
