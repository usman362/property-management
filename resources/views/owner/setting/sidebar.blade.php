<div class="col-md-12 col-lg-12 col-xl-4 col-xxl-3">
    <div class="account-settings-leftside bg-white theme-border radius-4 p-20 mb-25">
        <div class="tenants-details-leftsidebar-wrap d-flex">
            <ul class="account-settings-menu list-group">
                <li>
                    <a href="{{ route('setting.general-setting') }}"
                        class="account-settings-menu-item {{ @$subGeneralSettingActiveClass }}">
                        <span class="iconify" data-icon="carbon:settings"></span>{{ __('Basic Setting') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('setting.color-setting') }}"
                        class="account-settings-menu-item {{ @$subColorSettingActiveClass }}">
                        <span class="iconify"
                            data-icon="fluent:color-background-24-regular"></span>{{ __('Color Setting') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
