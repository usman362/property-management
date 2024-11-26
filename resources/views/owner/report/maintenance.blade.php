@extends('owner.layouts.app')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="page-content-wrapper bg-white p-30 radius-20">
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
                                        <li class="breadcrumb-item" aria-current="page">{{ __('Report') }}</li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="tenants-top-bar">
                            <div class="property-search-inner-bg bg-off-white theme-border radius-4 p-25 pb-0 mb-25">
                                <form action="">
                                    <div class="row">
                                        <div class="col-md-6 mb-25">
                                            <select class="form-select flex-shrink-0" name="apartment_id" id="apartment_id">
                                                <option value="" selected>--{{ __('Select Apartment') }}--</option>
                                                @foreach ($apartments as $apartment)
                                                    <option value="{{$apartment->id}}">{{$apartment->apartment_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-25">
                                            <div class="input-group">
                                                <span class="input-group-text">{{ __('Month') }}</span>
                                                <input type="month" class="form-control" placeholder="Month"
                                                    id="month" name="month" aria-label="Month">
                                                <span class="input-group-text">{{ __('Year') }}</span>
                                                <input type="text" class="form-control" placeholder="Year"
                                                    id="year" name="year" aria-label="Year">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="notice-board-table-area">
                            <div class="bg-off-white theme-border radius-4 p-25">
                                <table id="maintenanceReportDataTable"
                                    class="table bg-off-white aaa theme-border p-20 dt-responsive">
                                    <thead>
                                        <tr>
                                            <th>{{ __('SL') }}</th>
                                            <th class="text-center" data-priority="1">{{ __('Apartment Name') }}</th>
                                            <th class="text-center">{{ __('Date') }}</th>
                                            <th class="text-center">{{ __('Issue') }}</th>
                                            <th class="text-center">{{ __('Status') }}</th>
                                            <th class="text-center">{{ __('Repair Fees') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="maintenanceReportRoute" value="{{ route('reports.maintenance') }}">
@endsection
@push('style')
    @include('common.layouts.datatable-style')
@endpush
@push('script')
    @include('common.layouts.datatable-script')
    <script src="{{ asset('assets/js/custom/report-maintenance.js') }}"></script>
@endpush
