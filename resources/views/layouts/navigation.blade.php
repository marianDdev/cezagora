<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        @include('layouts.logo')
        @include('search.search-bar')
        @include('layouts.user-menu')
        @include('layouts.navigation-list')
        @include('users.forms.upload_profile_image_modal')
        @include('companies.forms.upload_logo_modal')
    </div>
</nav>
