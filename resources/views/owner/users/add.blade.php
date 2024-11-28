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

                    <!-- Add Roles&Permission Area row Start -->
                    <div class="all-property-area">

                        <!--Add Roles&Permission Stepper Area Start -->
                        <div class="add-property-stepper-area add-tenants-stepper-area">
                            <div class="row">

                                <!-- Stepper Start -->
                                <div class="col-12">
                                    <div id="msform">

                                        <!-- fieldsets 1 -->
                                        <fieldset>
                                            <form class="ajax" action="{{ route('users.store') }}" method="POST"
                                                data-handler="stepChange">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ @$user->id }}">
                                                <div
                                                    class="form-card add-property-box bg-off-white theme-border radius-4 p-20">
                                                    <!-- Role &PermissionInformation -->
                                                    <div class="add-property-title border-bottom pb-25 mb-25">
                                                        <h4>{{ __('Users') }}</h4>
                                                    </div>

                                                    <!-- Personal Information Section -->
                                                    <div class="row">
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('First Name') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="first_name"
                                                                value="{{ @$user->first_name }}" class="form-control"
                                                                placeholder="{{ __('First Name') }}" autocomplete="off">
                                                        </div>

                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Last Name') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="last_name"
                                                                value="{{ @$user->last_name }}" class="form-control"
                                                                placeholder="{{ __('Last Name') }}" autocomplete="off">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Email') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="email"
                                                                value="{{ @$user->email }}" class="form-control"
                                                                placeholder="{{ __('Email') }}" autocomplete="off">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Password') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="password" name="password"
                                                                 class="form-control"
                                                                placeholder="{{ __('Password') }}" autocomplete="off">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Contact Number') }} </label>
                                                            <input type="text" name="contact_number"
                                                                value="{{ @$user->contact_number }}" class="form-control"
                                                                placeholder="{{ __('Contact Number') }}" autocomplete="off">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Date of Birth') }}</label>
                                                            <input type="date" name="date_of_birth"
                                                                value="{{ @$user->date_of_birth }}" class="form-control"
                                                                placeholder="{{ __('Date of Birth') }}" autocomplete="off">
                                                        </div>
                                                        <div class="col-md-6 mb-25">
                                                            <label>{{ __('Role') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <select name="role" class="form-control">
                                                                <option value="">Select Role</option>
                                                                @foreach ($roles as $key => $role)
                                                                    <option value="{{ $role->name }}" @selected(isset($user) ? $user->roles->contains($role->id) : '')>
                                                                        {{ $role->name }}</option>
                                                                @endforeach
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
                        <!-- Add Roles&Permission Stepper Area End -->

                    </div>
                    <!-- Add Roles&Permission Area row End -->

                </div>
                <!-- Page Content Wrapper End -->

            </div>

        </div>
        <!-- End Page-content -->

    </div>
@endsection
@push('script')
    <script src="{{ asset('assets/js/custom/tenant.js') }}"></script>
@endpush
