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
                        <h4 class="mb-20">{{ __('All Comments') }}</h4>
                        <!-- Property Top Search Bar End -->

                        <!-- All Maintainer Table Area Start -->
                        <div class="all-maintainer-table-area">
                            <!-- datatable Start -->
                            <div class="bg-off-white theme-border radius-4 p-25">
                                <table id="allCommentDataTable"
                                    class="table bg-off-white aaa theme-border dt-responsive">
                                    <thead>
                                        <tr>
                                            <th>{{ __('SL') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Comment') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            {{-- <th>{{ __('Action') }}</th> --}}
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

    <input type="hidden" id="route" value="{{ route('property.comments') }}">
    <input type="hidden" id="statusChangeURL" value="{{ route('property.apartmentComments.status') }}">
@endsection
@push('style')
    @include('common.layouts.datatable-style')
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.css') }}">
@endpush

@push('script')
    @include('common.layouts.datatable-script')
    <script src="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/maintainer-profile-photo.init.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apartment-comments.js') }}"></script>
@endpush
