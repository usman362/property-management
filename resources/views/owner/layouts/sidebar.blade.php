<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                @can('view-dashboard')
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="ri-dashboard-line"></i>
                            <span>{{ __('Dashboard') }}</span>
                        </a>
                    </li>
                @endcan

                @can('view-buildings')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="ri-building-line"></i>
                            <span>{{ __('Building') }}</span>
                        </a>
                        <ul class="sub-menu {{ @$navBuildingMMShowClass }}" aria-expanded="false">
                            <li class="{{ @$subNavAllBuildingMMActiveClass }}">
                                <a href="{{ route('building.allBuilding') }}"
                                    class="{{ @$subNavAllBuildingActiveClass }}">{{ __('All Buildings') }}</a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @canany(['view-apartments', 'view-apartment-comments'])

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="ri-building-line"></i>
                            <span>{{ __('Apartments') }}</span>
                        </a>
                        <ul class="sub-menu {{ @$navApartmentMMShowClass }}" aria-expanded="false">
                            @can('view-apartments')
                                <li class="{{ @$subNavAllApartmentMMActiveClass }}">
                                    <a href="{{ route('property.allProperty') }}"
                                        class="{{ @$subNavAllApartmentActiveClass }}">{{ __('All Apartments') }}</a>
                                </li>
                            @endcan
                            @can('view-apartment-comments')
                                <li class="{{ @$subNavAllApartmentCommentMMActiveClass }}">
                                    <a href="{{ route('property.comments') }}"
                                        class="{{ @$subNavAllApartmentCommentActiveClass }}">{{ __('Comments') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('view-tenants')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="ri-user-3-line"></i>
                            <span>{{ __('Tenants') }}</span>
                        </a>
                        <ul class="sub-menu {{ @$navTenantMMShowClass }}" aria-expanded="false">
                            <li class="{{ @$subNavAllTenantMMActiveClass }}">
                                <a href="{{ route('tenant.index', ['type' => 'all']) }}"
                                    class="{{ @$subNavAllTenantActiveClass }}">{{ __('All Tenants') }}</a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('view-maintenance')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="ri-user-3-line"></i>
                            <span>{{ __('Applications') }}</span>
                        </a>
                        <ul class="sub-menu {{ @$navApplicationMMShowClass }}" aria-expanded="false">
                            <li class="{{ @$subNavAllApplicationMMActiveClass }}">
                                <a href="{{ route('applications.index') }}"
                                    class="{{ @$subNavAllApplicationActiveClass }}">{{ __('All Applications') }}</a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('view-maintenance')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="ri-account-circle-line"></i>
                            <span>{{ __('Maintenance') }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('maintainer.index') }}">{{ __('Maintenance') }}</a></li>
                            {{-- <li><a href="{{ route('maintenance-request.index') }}">{{ __('Maintenance Request') }}</a></li> --}}
                        </ul>
                    </li>
                @endcan

                @canany(['view-maintenance-report', 'view-tenant-report'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="ri-folder-chart-line"></i>
                            <span>{{ __('Report') }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('view-maintenance-report')
                                <li>
                                    <a href="{{ route('reports.maintenance') }}">{{ __('Maintenance') }}</a>
                                </li>
                            @endcan
                            @can('view-tenant-report')
                                <li>
                                    <a href="{{ route('reports.tenant') }}">{{ __('Tenant') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @can('view-users')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="ri-user-3-line"></i>
                            <span>{{ __('Users') }}</span>
                        </a>
                        <ul class="sub-menu {{ @$navUsersMMShowClass }}" aria-expanded="false">
                            <li class="{{ @$subNavAllUsersMMActiveClass }}">
                                <a href="{{ route('users.index') }}"
                                    class="{{ @$subNavAllUsersActiveClass }}">{{ __('All Users') }}</a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('view-roles')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="ri-user-3-line"></i>
                            <span>{{ __('Roles & Permissions') }}</span>
                        </a>
                        <ul class="sub-menu {{ @$navRolesMMShowClass }}" aria-expanded="false">
                            @can('view-roles')
                            <li class="{{ @$subNavAllRolesMMActiveClass }}">
                                <a href="{{ route('roles-permissions.index') }}"
                                    class="{{ @$subNavAllRolesActiveClass }}">{{ __('All Roles & Permissions') }}</a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @canany(['view-profile-settings', 'view-password-settings'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="ri-account-circle-line"></i>
                            <span>{{ __('Profile') }}</span>
                        </a>
                        <ul class="sub-menu {{ @$navProfileMMShowClass }}" aria-expanded="false">
                            @can('view-profile-settings')
                                <li class="{{ @$subNavProfileMMActiveClass }}"><a class="{{ @$subNavProfileActiveClass }}"
                                        href="{{ route('profile') }}">{{ __('My Profile') }}</a></li>
                            @endcan
                            @can('view-password-settings')
                                <li><a href="{{ route('change-password') }}">{{ __('Change Password') }}</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
