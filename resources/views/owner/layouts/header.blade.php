<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <div class="navbar-brand-box">
                <a href="{{ route('dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ getSettingImage('app_logo') }}" alt="logo-sm-light">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ getSettingImage('app_logo') }}" alt="logo-light">
                    </span>
                </a>
            </div>
            <button type="button" class="btn-sm px-3 font-24 header-item" id="vertical-menu-btn">
                <i class="ri-indent-decrease"></i>
            </button>
            {{-- <div class="header-item px-3">
                <input type="text" class="form-control" id="topSearch">
                <div class="bg-white position-absolute shadow-lg top-100 w-100">
                    <div id="topSearchContent" class="text-left"></div>
                </div>
            </div> --}}
        </div>
        @if (isAddonInstalled('PROTYSAAS') > 1)
            @if (!ownerCurrentPackage(auth()->id()))
                <div class="d-flex exclamation">
                    <button class="text-danger exclamation-btu">
                        <i class="fas fa-exclamation-circle"></i>
                    </button>
                    <div class="text-center exclamation-area">
                        {{ __('Currently you doesn\'t have any subscription!') }} <a
                            href="{{ route('subscription.index', ['current_plan' => 'no']) }}"
                            class="text-danger px-1" title="{{ __('Choose a plan') }}">{{ __('Choose a plan') }}</a>
                    </div>
                    <button type="button" class="close topBannerClose ms-2"><span>&times;</span></button>
                </div>
            @endif
        @endif
        <div class="d-flex">

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="header-item" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle avatar-xs fit-image header-profile-user"
                        src="{{ auth()->user()->image }}" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1 font-medium">{{ auth()->user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu {{ selectedLanguage()->rtl == 1 ? 'dropdown-menu-start' : 'dropdown-menu-end' }}"
                    aria-labelledby="page-header-user-dropdown">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('profile') }}"><i
                            class="ri-user-line align-middle me-1"></i> {{ __('Profile') }}</a>
                    <a class="dropdown-item" href="{{ route('setting.general-setting') }}"><i
                        class="ri-settings-2-line align-middle me-1"></i> {{ __('Settings') }}</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"><i
                            class="ri-shut-down-line align-middle me-1"></i> {{ __('Logout') }}</a>
                </div>
            </div>
        </div>
    </div>
</header>
