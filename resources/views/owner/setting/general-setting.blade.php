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
                                    <h3 class="mb-sm-0">{{ __('Settings') }}</h3>
                                </div>
                                <div class="page-title-right">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"
                                                title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
                                        <li class="breadcrumb-item"><a href="#"
                                                title="{{ __('Settings') }}">{{ __('Settings') }}</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="settings-page-layout-wrap position-relative">
                        <div class="row">
                            @include('owner.setting.sidebar')
                            <div class="col-md-12 col-lg-12 col-xl-8 col-xxl-9">
                                <div class="account-settings-rightside bg-off-white theme-border radius-4 p-25">
                                    <!-- Payment Method Page Start -->
                                    <div class="language-settings-page-area">
                                        <!-- Account Settings Content Box Start -->
                                        <div class="account-settings-content-box">
                                            <div class="account-settings-title border-bottom mb-20 pb-20">
                                                <div class="row align-items-center">
                                                    <div class="col-md-6">
                                                        <h4>{{ $pageTitle }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Settings Page inner form area start -->
                                            <form action="{{ route('setting.general-setting.update') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="settings-inner-box bg-white theme-border radius-4 mb-25">
                                                    <div class="settings-inner-box-title border-bottom p-20">
                                                        <h5>{{ __('App Setting') }}</h5>
                                                    </div>
                                                    <div class="settings-inner-box-fields p-20 pb-0">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('App Name') }}</label>
                                                                <input type="text" name="app_name"
                                                                    value="{{ getOption('app_name') }}"
                                                                    class="form-control"
                                                                    placeholder="{{ __('Type App Name') }}">
                                                            </div>
                                                            <div class="col-md-12 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('App Email') }}</label>
                                                                <input type="text" name="app_email"
                                                                    value="{{ getOption('app_email') }}"
                                                                    class="form-control"
                                                                    placeholder="{{ __('Type App Email') }}">
                                                            </div>
                                                            <div class="col-md-12 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('App Contact Number') }}</label>
                                                                <input type="text" name="app_contact_number"
                                                                    value="{{ getOption('app_contact_number') }}"
                                                                    class="form-control"
                                                                    placeholder="{{ __('Type Mobile Number') }}">
                                                            </div>
                                                            <div class="col-md-12 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('App Location') }}</label>
                                                                <input type="text" name="app_location"
                                                                    value="{{ getOption('app_location') }}"
                                                                    class="form-control"
                                                                    placeholder="{{ __('Type App Location') }}">
                                                            </div>
                                                            <div class="col-md-12 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('About Us Title') }}</label>
                                                                <input type="text" name="about_us_title"
                                                                    value="{{ getOption('about_us_title') }}"
                                                                    class="form-control"
                                                                    placeholder="{{ __('About Us Title') }}">
                                                            </div>
                                                            <div class="col-md-12 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('About Us Description') }}</label>
                                                                <input type="text" name="about_us_description"
                                                                    value="{{ getOption('about_us_description') }}"
                                                                    class="form-control"
                                                                    placeholder="{{ __('About Us Description') }}">
                                                            </div>

                                                            <div class="col-md-12 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Footer Description') }}</label>
                                                                <input type="text" name="footer_description"
                                                                    value="{{ getOption('footer_description') }}"
                                                                    class="form-control"
                                                                    placeholder="{{ __('Footer Description') }}">
                                                            </div>

                                                            <div class="col-md-12 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Quick Link 1') }}</label>
                                                                <input type="text" name="quick_link_text_1"
                                                                    value="{{ getOption('quick_link_text_1') }}"
                                                                    class="form-control"
                                                                    placeholder="{{ __('Quick Link Text 1') }}">
                                                                <input type="text" name="quick_link_1"
                                                                    value="{{ getOption('quick_link_1') }}"
                                                                    class="form-control"
                                                                    placeholder="{{ __('Quick Link 1') }}">
                                                            </div>
                                                            <div class="col-md-12 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Quick Link 2') }}</label>
                                                                <input type="text" name="quick_link_text_2"
                                                                    value="{{ getOption('quick_link_text_2') }}"
                                                                    class="form-control"
                                                                    placeholder="{{ __('Quick Link Text 2') }}">
                                                                <input type="text" name="quick_link_2"
                                                                    value="{{ getOption('quick_link_2') }}"
                                                                    class="form-control"
                                                                    placeholder="{{ __('Quick Link 2') }}">
                                                            </div>
                                                            <div class="col-md-12 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Quick Link 3') }}</label>
                                                                <input type="text" name="quick_link_text_3"
                                                                    value="{{ getOption('quick_link_text_3') }}"
                                                                    class="form-control"
                                                                    placeholder="{{ __('Quick Link Text 3') }}">
                                                                <input type="text" name="quick_link_3"
                                                                    value="{{ getOption('quick_link_3') }}"
                                                                    class="form-control"
                                                                    placeholder="{{ __('Quick Link 3') }}">
                                                            </div>
                                                            <div class="col-md-12 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Quick Link 4') }}</label>
                                                                <input type="text" name="quick_link_text_4"
                                                                    value="{{ getOption('quick_link_text_4') }}"
                                                                    class="form-control"
                                                                    placeholder="{{ __('Quick Link Text 4') }}">
                                                                <input type="text" name="quick_link_4"
                                                                    value="{{ getOption('quick_link_4') }}"
                                                                    class="form-control"
                                                                    placeholder="{{ __('Quick Link 4') }}">
                                                            </div>
                                                            {{-- <div class="col-md-12 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Default Language') }}</label>
                                                                <select name="language_id"
                                                                    class="form-select flex-shrink-0">
                                                                    <option value="">{{ __('Select Option') }}
                                                                    </option>
                                                                    @foreach ($languages as $language)
                                                                        <option value="{{ $language->id }}"
                                                                            {{ $language->id == @$default_language->id ? 'selected' : '' }}>
                                                                            {{ $language->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div> --}}
                                                            {{-- <div class="col-md-12 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('App Preloader Status') }}</label>
                                                                <select name="app_preloader_status"
                                                                    class="form-select flex-shrink-0">
                                                                    <option value="1"
                                                                        {{ getOption('app_preloader_status') == 1 ? 'selected' : '' }}>
                                                                        {{ __('Active') }}</option>
                                                                    <option value="2"
                                                                        {{ getOption('app_preloader_status') != 1 ? 'selected' : '' }}>
                                                                        {{ __('Deactivate') }}</option>
                                                                </select>
                                                            </div> --}}
                                                            <div class="col-md-12 mb-25">
                                                                <div class="app-logo-favicon-preloader-box">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <label
                                                                                class="label-text-title color-heading font-medium mb-2">{{ __('App Logo') }}
                                                                                {{ __('Black') }}</label>
                                                                            <div
                                                                                class="upload-app-logo bg-light radius-4 text-center p-3">
                                                                                <div
                                                                                    class="profile-user position-relative d-inline-block">
                                                                                    <img src="
                                                                                    @if (empty(getOption('app_logo'))) {{ asset('assets/images/users/empty-user.jpg') }}
                                                                                    @else
                                                                                         {{ getSettingImage('app_logo') }} @endif"
                                                                                        class="rounded avatar-xl app-logo-user-profile-image"
                                                                                        alt="user-profile-image">
                                                                                    <div
                                                                                        class="avatar-xs p-0 rounded-circle app-logo-profile-photo-edit">
                                                                                        <input
                                                                                            id="app-logo-profile-img-file-input"
                                                                                            name="app_logo" type="file"
                                                                                            class="app-logo-profile-img-file-input">
                                                                                        <label
                                                                                            for="app-logo-profile-img-file-input"
                                                                                            class="app-logo-profile-photo-edit avatar-xs">
                                                                                            <span
                                                                                                class="avatar-title rounded-circle"
                                                                                                title="{{ __('Upload Image') }}">
                                                                                                <i
                                                                                                    class="ri-camera-fill"></i>
                                                                                            </span>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <span
                                                                                class="text-info">{{ __('Recomended size') }}
                                                                                : {{ __('150 x 50') }}</span>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label
                                                                                class="label-text-title color-heading font-medium mb-2">{{ __('App Logo') }}
                                                                                {{ __('White') }}</label>
                                                                            <div
                                                                                class="upload-app-logo bg-light radius-4 text-center p-3">
                                                                                <div
                                                                                    class="profile-user position-relative d-inline-block">
                                                                                    <img src="
                                                                                    @if (empty(getOption('app_logo_white'))) {{ asset('assets/images/users/empty-user.jpg') }}
                                                                                    @else
                                                                                         {{ getSettingImage('app_logo_white') }} @endif"
                                                                                        class="rounded avatar-xl app-logo-white-user-profile-image"
                                                                                        alt="user-profile-image">
                                                                                    <div
                                                                                        class="avatar-xs p-0 rounded-circle app-logo-profile-photo-edit">
                                                                                        <input
                                                                                            id="app-logo-white-profile-img-file-input"
                                                                                            name="app_logo_white"
                                                                                            type="file"
                                                                                            class="app-logo-white-profile-img-file-input">
                                                                                        <label
                                                                                            for="app-logo-white-profile-img-file-input"
                                                                                            class="app-logo-profile-photo-edit avatar-xs">
                                                                                            <span
                                                                                                class="avatar-title rounded-circle"
                                                                                                title="{{ __('Upload Image') }}">
                                                                                                <i
                                                                                                    class="ri-camera-fill"></i>
                                                                                            </span>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <span
                                                                                class="text-info">{{ __('Recomended size') }}
                                                                                : {{ __('150 x 50') }}</span>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label
                                                                                class="label-text-title color-heading font-medium mb-2">{{ __('App Favicon') }}</label>
                                                                            <div
                                                                                class="upload-app-logo bg-light radius-4 text-center p-3">
                                                                                <div
                                                                                    class="profile-user position-relative d-inline-block">
                                                                                    <img src="@if (empty(getOption('app_fav_icon'))) {{ asset('assets/images/users/empty-user.jpg') }}
                                                                                    @else
                                                                                        {{ getSettingImage('app_fav_icon') }} @endif"
                                                                                        class="rounded-circle avatar-xl app-favicon-user-profile-image"
                                                                                        alt="user-profile-image">
                                                                                    <div
                                                                                        class="avatar-xs p-0 rounded-circle app-favicon-profile-photo-edit">
                                                                                        <input
                                                                                            id="app-favicon-profile-img-file-input"
                                                                                            name="app_fav_icon"
                                                                                            type="file"
                                                                                            class="app-favicon-profile-img-file-input">
                                                                                        <label
                                                                                            for="app-favicon-profile-img-file-input"
                                                                                            class="app-favicon-profile-photo-edit avatar-xs">
                                                                                            <span
                                                                                                class="avatar-title rounded-circle"
                                                                                                title="{{ __('Upload Image') }}">
                                                                                                <i
                                                                                                    class="ri-camera-fill"></i>
                                                                                            </span>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <span
                                                                                class="text-info">{{ __('Recomended size') }}
                                                                                : {{ __('64 x 64') }}</span>
                                                                        </div>
                                                                        {{-- <div class="col-md-4">
                                                                            <label
                                                                                class="label-text-title color-heading font-medium mb-2">{{ __('Preloader') }}</label>
                                                                            <div
                                                                                class="upload-app-logo bg-light radius-4 text-center p-3">
                                                                                <div
                                                                                    class="profile-user position-relative d-inline-block">
                                                                                    <img src="@if (empty(getOption('app_preloader'))) {{ asset('assets/images/users/empty-user.jpg') }}
                                                                                    @else
                                                                                        {{ getSettingImage('app_preloader') }} @endif"
                                                                                        class="rounded avatar-xl app-preloader-user-profile-image"
                                                                                        alt="user-profile-image">
                                                                                    <div
                                                                                        class="avatar-xs p-0 rounded-circle app-preloader-profile-photo-edit">
                                                                                        <input
                                                                                            id="app-preloader-profile-img-file-input"
                                                                                            name="app_preloader"
                                                                                            type="file"
                                                                                            class="app-preloader-profile-img-file-input">
                                                                                        <label
                                                                                            for="app-preloader-profile-img-file-input"
                                                                                            class="app-preloader-profile-photo-edit avatar-xs">
                                                                                            <span
                                                                                                class="avatar-title rounded-circle"
                                                                                                title="{{ __('Upload Image') }}">
                                                                                                <i
                                                                                                    class="ri-camera-fill"></i>
                                                                                            </span>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <span
                                                                                class="text-info">{{ __('Recomended size') }}
                                                                                : {{ __('150 x 50') }}</span>
                                                                        </div> --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Sign In Text Title') }}</label>
                                                                <input type="text" name="sign_in_text_title"
                                                                    class="form-control"
                                                                    value="{{ getOption('sign_in_text_title') }}"
                                                                    placeholder="{{ __('Type sign in text title') }}">
                                                            </div>
                                                            <div class="col-md-12 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Sign In Text Subtitle') }}</label>
                                                                <input type="text" name="sign_in_text_subtitle"
                                                                    class="form-control"
                                                                    value="{{ getOption('sign_in_text_subtitle') }}"
                                                                    placeholder="{{ __('Sign in text subtitle') }}">
                                                            </div>
                                                            <div class="col-md-4 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Sign In Image') }}</label>
                                                                <div
                                                                    class="upload-app-logo bg-light radius-4 text-center p-3">
                                                                    <div
                                                                        class="profile-user position-relative d-inline-block">
                                                                        <img src="@if (empty(getOption('sign_in_image'))) {{ asset('assets/images/users/empty-user.jpg') }}
                                                                                    @else
                                                                                        {{ getSettingImage('sign_in_image') }} @endif"
                                                                            class="rounded avatar-xl signin-user-profile-image"
                                                                            alt="user-profile-image">
                                                                        <div
                                                                            class="avatar-xs p-0 rounded-circle signin-profile-photo-edit">
                                                                            <input id="signin-profile-img-file-input"
                                                                                name="sign_in_image" type="file"
                                                                                class="signin-profile-img-file-input">
                                                                            <label for="signin-profile-img-file-input"
                                                                                class="signin-profile-photo-edit avatar-xs">
                                                                                <span class="avatar-title rounded-circle"
                                                                                    title="{{ __('Upload Image') }}">
                                                                                    <i class="ri-camera-fill"></i>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <span class="text-info">{{ __('Recomended size') }} :
                                                                    {{ __('576 x 458') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="settings-inner-box bg-white theme-border radius-4 mb-25">
                                                    <div class="settings-inner-box-title border-bottom p-20">
                                                        <h5>{{ __('Slider Setting') }}</h5>
                                                    </div>
                                                    <div class="settings-inner-box-fields p-20 pb-0">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Slider 1 Top Heading') }}</label>
                                                                <input type="text" name="slider_1_top_heading"
                                                                    value="{{ getOption('slider_1_top_heading') }}"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="col-md-12 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Slider 1 Heading') }}</label>
                                                                <input type="text" name="slider_1_heading"
                                                                    value="{{ getOption('slider_1_heading') }}"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="col-md-12 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Slider 1 Description') }}</label>
                                                                <input type="text" name="slider_1_description"
                                                                    value="{{ getOption('slider_1_description') }}"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="col-md-12 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Slider 1 Button Text') }}</label>
                                                                <input type="text" name="slider_1_btn_text"
                                                                    value="{{ getOption('slider_1_btn_text') }}"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="col-md-12 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Slider 1 Button Link') }}</label>
                                                                <input type="text" name="slider_1_btn_link"
                                                                    value="{{ getOption('slider_1_btn_link') }}"
                                                                    class="form-control">
                                                            </div>

                                                            <div class="col-md-12 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Slider 2 Top Heading') }}</label>
                                                                <input type="text" name="slider_2_top_heading"
                                                                    value="{{ getOption('slider_2_top_heading') }}"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="col-md-12 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Slider 2 Heading') }}</label>
                                                                <input type="text" name="slider_2_heading"
                                                                    value="{{ getOption('slider_2_heading') }}"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="col-md-12 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Slider 2 Description') }}</label>
                                                                <input type="text" name="slider_2_description"
                                                                    value="{{ getOption('slider_2_description') }}"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="col-md-12 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Slider 2 Button Text') }}</label>
                                                                <input type="text" name="slider_2_btn_text"
                                                                    value="{{ getOption('slider_2_btn_text') }}"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="col-md-12 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Slider 2 Button Link') }}</label>
                                                                <input type="text" name="slider_2_btn_link"
                                                                    value="{{ getOption('slider_2_btn_link') }}"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="theme-btn"
                                                    title="{{ __('Update') }}">{{ __('Update') }}</button>
                                            </form>
                                            <!-- Settings Page inner form area end -->
                                        </div>
                                        <!-- Account Settings Content Box End -->
                                    </div>
                                    <!-- Payment Method Page End -->
                                </div>
                            </div>
                            <!-- Account settings Area Right Side End-->
                        </div>
                    </div>
                    <!-- Settings Page Layout Wrap Area row End -->
                </div>
                <!-- Page Content Wrapper End -->
            </div>
        </div>
        <!-- End Page-content -->
    </div>
    <!-- Right Content End -->
@endsection

@push('script')
    <script src="{{ asset('assets/js/pages/app-logo-setting.init.js') }}"></script>
    <script src="{{ asset('assets/js/pages/app-favicon-img-setting.init.js') }}"></script>
    <script src="{{ asset('assets/js/pages/app-preloader-img-setting.init.js') }}"></script>
    <script src="{{ asset('assets/js/pages/signin-img-setting.init.js') }}"></script>
@endpush
