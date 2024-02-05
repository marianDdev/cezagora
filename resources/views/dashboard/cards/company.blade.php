<div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
    <div class="relative inline-block">
        <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg object-cover"
             src="{{ $user->getFirstMediaUrl('company_logos') ? $user->getFirstMediaUrl('company_logos') : 'https://cezagora.fra1.cdn.digitaloceanspaces.com/dashboard/cezagora_company.png'}}"
             alt="logo" />
        @if(!is_null($user->company))
            <div
                    class="absolute inset-0 w-full h-full bg-black bg-opacity-50 opacity-0 hover:opacity-100 flex items-center justify-center space-x-2 text-white font-bold text-xl transition-opacity duration-300 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4-4m0 0l-4 4m4-4v12" />
                </svg>
                <button data-modal-target="logo-modal" data-modal-toggle="logo-modal">Upload company logo</button>
            </div>
        @endif
    </div>
    <div class="p-5">
        @if(!is_null($company))
            @include('companies.forms.edit')
        @else
            @include($user->hasRole(\App\Services\User\UserServiceInterface::ROLE_SELLER) ? 'companies.forms.create_seller' : 'companies.forms.create_buyer')
        @endif
    </div>
</div>
