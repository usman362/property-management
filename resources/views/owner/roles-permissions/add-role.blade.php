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
                                            <form class="ajax" action="{{ route('roles-permissions.store') }}"
                                                method="POST" data-handler="stepChange">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ @$role->id }}">
                                                <div
                                                    class="form-card add-property-box bg-off-white theme-border radius-4 p-20">
                                                    <!-- Role &PermissionInformation -->
                                                    <div class="add-property-title border-bottom pb-25 mb-25">
                                                        <h4>{{ __('Roles & Permissions') }}</h4>
                                                    </div>

                                                    <!-- Personal Information Section -->
                                                    <div class="row">
                                                        <div class="col-md-12 mb-25">
                                                            <label>{{ __('Role Name') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="name" value="{{ @$role->name }}"
                                                                class="form-control" placeholder="{{ __('Name') }}">
                                                        </div>
                                                        @can('view-permissions')
                                                            @foreach ($permissions as $key => $permission)
                                                                <div class="col-md-3 mb-25 text-left">
                                                                    <label>{{ $permission->name }}</label>
                                                                    <input type="checkbox" name="permission[]"
                                                                        value="{{ $permission->name }}"
                                                                        @checked(isset($role) ? $role->permissions->contains($permission->id) : '')>
                                                                </div>
                                                            @endforeach
                                                        @endcan
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
