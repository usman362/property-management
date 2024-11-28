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
                                                title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ __('Users') }}</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="settings-page-layout-wrap position-relative">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="account-settings-rightside bg-off-white theme-border radius-4 p-25">
                                    <div class="language-settings-page-area">
                                        <div class="account-settings-content-box">
                                            <div class="account-settings-title border-bottom mb-20 pb-20">
                                                <div class="row align-items-center">
                                                    <div class="col-md-6">
                                                        <h4>{{ __('All Users') }}</h4>
                                                    </div>
                                                    @can('add-users')
                                                        <div class="col-md-6">
                                                            <div class="property-details-right text-end">
                                                                <a href="{{ route('users.create') }}" class="theme-btn"
                                                                    title="{{ __('Add User') }}">
                                                                    {{ __('Add User') }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endcan
                                                </div>
                                            </div>
                                            <div class="language-list-table-area">
                                                <div class="bg-off-white theme-border radius-4 p-25">
                                                    <table class="table bg-off-white theme-border p-20 dt-responsive">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ __('Name') }}</th>
                                                                <th>{{ __('Email') }}</th>
                                                                <th>{{ __('Role') }}</th>
                                                                <th>{{ __('Action') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($users as $user)
                                                                <tr>
                                                                    <td>{{ $user->name }}</td>
                                                                    <td>{{ $user->email }} </td>
                                                                    <td>{{ $user->roles[0]->name ?? '' }}</td>
                                                                    <td>
                                                                        <div class="tbl-action-btns d-inline-flex">
                                                                            @can('edit-users')
                                                                                <a class="p-1 tbl-action-btn edit"
                                                                                    href="{{ route('users.edit', $user->id) }}"
                                                                                    title="Edit"><span class="iconify"
                                                                                        data-icon="clarity:note-edit-solid"></span>
                                                                                </a>
                                                                            @endcan
                                                                            @can('delete-users')
                                                                            <button class="p-1 tbl-action-btn deleteItem"
                                                                                data-formid="delete_row_form_{{ $user->id }}">
                                                                                <span class="iconify"
                                                                                    data-icon="ep:delete-filled"></span>
                                                                            </button>
                                                                            <form
                                                                                action="{{ route('users.delete', [$user->id]) }}"
                                                                                method="post"
                                                                                id="delete_row_form_{{ $user->id }}">
                                                                                {{ method_field('DELETE') }}
                                                                                <input type="hidden" name="_token"
                                                                                    value="{{ csrf_token() }}">
                                                                            </form>
                                                                            @endcan
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
