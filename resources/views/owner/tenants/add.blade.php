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

                    <!-- Add Tenants Area row Start -->
                    <div class="all-property-area">

                        <!--Add Tenants Stepper Area Start -->
                        <div class="add-property-stepper-area add-tenants-stepper-area">
                            <div class="row">

                                <!-- Stepper Start -->
                                <div class="col-12">
                                    <div id="msform">

                                        <!-- fieldsets 1 -->
                                        <fieldset>
                                            <form class="ajax" action="{{ route('tenant.store') }}" method="POST" data-handler="stepChange">
                                                @csrf
                                                <input type="hidden" name="tenant_id" value="{{@$tenant->id}}">
                                                <div class="form-card add-property-box bg-off-white theme-border radius-4 p-20">
                                                    <!-- Tenant Information -->
                                                    <div class="add-property-title border-bottom pb-25 mb-25">
                                                        <h4>{{ __('Tenant Information') }}</h4>
                                                    </div>

                                                    <!-- Personal Information Section -->
                                                    <div class="row">
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('First Name') }} <span class="text-danger">*</span></label>
                                                            <input type="text" name="first_name" value="{{@$tenant->first_name}}" class="form-control" placeholder="{{ __('First Name') }}">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Last Name') }} <span class="text-danger">*</span></label>
                                                            <input type="text" name="last_name" value="{{@$tenant->last_name}}" class="form-control" placeholder="{{ __('Last Name') }}">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Partner\'s First Name') }}</label>
                                                            <input type="text" name="partner_first_name" value="{{@$tenant->partner_first_name}}" class="form-control" placeholder="{{ __('Partner\'s First Name') }}">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Partner\'s Last Name') }}</label>
                                                            <input type="text" name="partner_last_name" value="{{@$tenant->partner_last_name}}" class="form-control" placeholder="{{ __('Partner\'s Last Name') }}">
                                                        </div>
                                                        <div class="col-md-12 mb-25">
                                                            <label>{{ __('Address') }}</label>
                                                            <input type="text" name="address" value="{{@$tenant->address}}" class="form-control" placeholder="{{ __('Address') }}">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Phone Number') }}</label>
                                                            <input type="text" name="phone_number" value="{{@$tenant->phone_number}}" class="form-control" placeholder="{{ __('Phone Number') }}">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Cellphone Number') }}</label>
                                                            <input type="text" name="cellphone_number" value="{{@$tenant->cellphone_number}}" class="form-control" placeholder="{{ __('Cellphone Number') }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-card add-property-box bg-off-white theme-border radius-4 p-20 mt-4">
                                                    <!-- Workplace Section -->
                                                    <div class="add-property-title border-bottom pb-25 mb-25">
                                                        <h4>{{ __('Workplace Information') }}</h4>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Workplace Name') }}</label>
                                                            <input type="text" name="workplace_name" value="{{@$tenant->working_place_name}}" class="form-control" placeholder="{{ __('Workplace Name') }}">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Workplace Address') }}</label>
                                                            <input type="text" name="workplace_address" value="{{@$tenant->working_place_address}}" class="form-control" placeholder="{{ __('Workplace Address') }}">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Workplace Contact') }}</label>
                                                            <input type="text" name="workplace_contact" value="{{@$tenant->working_place_contact}}" class="form-control" placeholder="{{ __('Workplace Contact') }}">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Workplace Email') }}</label>
                                                            <input type="email" name="workplace_email" value="{{@$tenant->working_place_email}}" class="form-control" placeholder="{{ __('Workplace Email') }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-card add-property-box bg-off-white theme-border radius-4 p-20 mt-4">
                                                    <!-- Guarantor Information Section -->
                                                    <div class="add-property-title border-bottom pb-25 mb-25">
                                                        <h4>{{ __('Guarantor Information') }}</h4>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Guarantor\'s First Name') }}</label>
                                                            <input type="text" name="guarantor_first_name" value="{{@$tenant->guarantor_first_name}}" class="form-control" placeholder="{{ __('Guarantor\'s First Name') }}">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Guarantor\'s Last Name') }}</label>
                                                            <input type="text" name="guarantor_last_name" value="{{@$tenant->guarantor_last_name}}" class="form-control" placeholder="{{ __('Guarantor\'s Last Name') }}">
                                                        </div>
                                                        <div class="col-md-12 mb-25">
                                                            <label>{{ __('Guarantor\'s Address') }}</label>
                                                            <input type="text" name="guarantor_address" value="{{@$tenant->guarantor_address}}" class="form-control" placeholder="{{ __('Guarantor\'s Address') }}">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Guarantor\'s Phone Number') }}</label>
                                                            <input type="text" name="guarantor_phone_number" value="{{@$tenant->guarantor_phone_number}}" class="form-control" placeholder="{{ __('Guarantor\'s Phone Number') }}">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Guarantor\'s Cellphone Number') }}</label>
                                                            <input type="text" name="guarantor_cellphone_number" value="{{@$tenant->guarantor_cellphone_number}}" class="form-control" placeholder="{{ __('Guarantor\'s Cellphone Number') }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-card add-property-box bg-off-white theme-border radius-4 p-20 mt-4">
                                                    <!-- Guarantor's Workplace Section -->
                                                    <div class="add-property-title border-bottom pb-25 mb-25">
                                                        <h4>{{ __('Guarantor\'s Workplace Information') }}</h4>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Guarantor\'s Workplace Name') }}</label>
                                                            <input type="text" name="guarantor_workplace_name" value="{{@$tenant->guarantor_working_place_name}}" class="form-control" placeholder="{{ __('Guarantor\'s Workplace Name') }}">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Guarantor\'s Workplace Address') }}</label>
                                                            <input type="text" name="guarantor_workplace_address" value="{{@$tenant->guarantor_working_place_address}}" class="form-control" placeholder="{{ __('Guarantor\'s Workplace Address') }}">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Guarantor\'s Workplace Contact') }}</label>
                                                            <input type="text" name="guarantor_workplace_contact" value="{{@$tenant->guarantor_working_place_contact}}" class="form-control" placeholder="{{ __('Guarantor\'s Workplace Contact') }}">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Guarantor\'s Workplace Email') }}</label>
                                                            <input type="email" name="guarantor_workplace_email" value="{{@$tenant->guarantor_working_place_email}}" class="form-control" placeholder="{{ __('Guarantor\'s Workplace Email') }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-card add-property-box bg-off-white theme-border radius-4 p-20 mt-4">
                                                    <!-- Additional Information Section -->
                                                    <div class="add-property-title border-bottom pb-25 mb-25">
                                                        <h4>{{ __('Additional Information') }}</h4>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Building Name') }}</label>
                                                            <select name="building_id" class="form-control" id="">
                                                                <option value="">Select Building</option>
                                                                @foreach ($buildings as $bldg)
                                                                <option value="{{ $bldg->id }}" @selected(@$tenant->building_id == $bldg->id)>
                                                                    {{ $bldg->name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Apartment Number') }}</label>
                                                            <select name="apartment_id" class="form-control" id="">
                                                                <option value="">Select Apartment</option>
                                                                @foreach ($apartments as $apartment)
                                                                <option value="{{ $apartment->id }}" @selected(@$tenant->apartment_id == $apartment->id)>
                                                                    {{ $apartment->apartment_name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Check-In Date') }}</label>
                                                            <input type="date" name="check_in_date" value="{{@$tenant->check_in_date}}" class="form-control" placeholder="{{ __('Check-In Date') }}">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Check-Out Date') }}</label>
                                                            <input type="date" name="check_out_date" value="{{@$tenant->check_out_date}}" class="form-control" placeholder="{{ __('Check-Out Date') }}">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Contract Date') }}</label>
                                                            <input type="date" name="contract_date" value="{{@$tenant->contract_date}}" class="form-control" placeholder="{{ __('Contract Date') }}">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Monthly Fees') }}</label>
                                                            <input type="number" step="0.01" name="monthly_fees" value="{{@$tenant->monthly_fees}}" class="form-control" placeholder="{{ __('Monthly Fees') }}">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Deposit Amount') }}</label>
                                                            <input type="number" step="0.01" name="deposit_amount" value="{{@$tenant->deposit_amount}}" class="form-control" placeholder="{{ __('Deposit Amount') }}">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Payment Type (Cash/Deposit)') }}</label>
                                                            <select name="payment_type" class="form-control">
                                                                <option value="Cash" @selected(@$tenant->deposit_type == 'Cash')>{{ __('Cash') }}</option>
                                                                <option value="Deposit" @selected(@$tenant->deposit_type == 'Deposit')>{{ __('Deposit') }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Monthly Due Date') }}</label>
                                                            <input type="date" name="monthly_due_date" value="{{@$tenant->monthly_due_date}}" class="form-control" placeholder="{{ __('Monthly Due Date') }}">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Late Fees') }}</label>
                                                            <input type="number" step="0.01" name="late_fees" value="{{@$tenant->late_fees}}" class="form-control" placeholder="{{ __('Late Fees') }}">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Date') }}</label>
                                                            <input type="date" name="date" value="{{@$tenant->date}}" class="form-control" placeholder="{{ __('Date') }}">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Status') }}</label>
                                                            <select name="status" class="form-control">
                                                                <option value="pending" @selected(@$tenant->status == 'pending')>{{ __('Pending') }}</option>
                                                                <option value="approved" @selected(@$tenant->status == 'approved')>{{ __('Approved') }}</option>
                                                                <option value="rejected" @selected(@$tenant->status == 'rejected')>{{ __('Rejected') }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit"
                                                class="nextStep1 action-button theme-btn mt-25">{{ __('Save') }}</button>
                                            </form>
                                        </fieldset>


                                    </div>
                                </div>
                                <!-- Stepper End -->

                            </div>
                        </div>
                        <!-- Add Tenants Stepper Area End -->

                    </div>
                    <!-- Add Tenants Area row End -->

                </div>
                <!-- Page Content Wrapper End -->

            </div>

        </div>
        <!-- End Page-content -->

    </div>
    <input type="hidden" id="propertyShowRoute" value="{{ route('property.show', 0) }}">
    <input type="hidden" id="tenantStoreRoute" value="{{ route('tenant.store') }}">
    <input type="hidden" id="tenantListRoute" value="{{ route('tenant.index') }}">
@endsection

@push('script')
    {{-- <script src="{{ asset('/') }}assets/js/pages/profile-setting.init.js"></script> --}}
    <script src="{{ asset('assets/js/custom/tenant.js') }}"></script>
@endpush
