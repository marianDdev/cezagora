<div class="flex items-center md:order-2">
    <button type="button"
            class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
            id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
            data-dropdown-placement="bottom">
        <span class="sr-only">Open user menu</span>
        @if(Auth::check() && Auth::user()->hasMedia('profile_picture'))
            <img class="w-4 h-4 rounded-full" src="/docs/images/people/profile-picture-3.jpg" alt="user photo">
        @else
            <div class="relative w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                <svg class="absolute w-12 h-12 text-gray-400 -left-1" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                          clip-rule="evenodd"></path>
                </svg>
            </div>
        @endif
    </button>
    <!-- Dropdown menu -->
    @include('components.dropdown-menu')
    @include('components.mobile-dropdown-menu')
</div>
