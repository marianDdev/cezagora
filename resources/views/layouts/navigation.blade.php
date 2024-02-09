@php
    $hasSellerRole = \Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->hasRole(\App\Services\User\UserServiceInterface::ROLE_SELLER);
    $hasAdminRole = \Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->hasRole(\App\Services\User\UserServiceInterface::ROLE_ADMIN);
@endphp
<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        @include('layouts.logo')
        @if(!$hasSellerRole || !$hasAdminRole)
            @include('search.search-bar')
        @endif
        @include('layouts.user-menu')
        @include('layouts.navigation-list')
        @include('users.forms.upload_profile_image_modal')
        @include('companies.forms.upload_logo_modal')
    </div>
</nav>
