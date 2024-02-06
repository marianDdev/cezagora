@php
    $user = \Illuminate\Support\Facades\Auth::user();
    $currentRole = $user->getRoleNames()->first();
    $isSeller = $currentRole === \App\Services\User\UserServiceInterface::ROLE_SELLER;
    $isBuyer = $currentRole === \App\Services\User\UserServiceInterface::ROLE_BUYER;
@endphp
<form method="POST" action="{{ route('user.toggle-role') }}">
    @csrf

    @if($isSeller)
        <input type="hidden" name="role" value="{{ \App\Services\User\UserServiceInterface::ROLE_BUYER }}" />
        <button class="block text-gray-900 bg-white font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                type="submit">
            <div class="flex">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 20 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m1 14 3-3m-3 3 3 3m-3-3h16v-3m2-7-3 3m3-3-3-3m3 3H3v3" />
                </svg>
                Switch to buyer profile
            </div>
        </button>
    @endif

    @if($isBuyer)
        <input type="hidden" name="role" value="{{ \App\Services\User\UserServiceInterface::ROLE_SELLER }}" />
        <button class="block text-gray-900 bg-white font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                type="submit">
            <div class="flex">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 20 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m1 14 3-3m-3 3 3 3m-3-3h16v-3m2-7-3 3m3-3-3-3m3 3H3v3" />
                </svg>
                Switch to seller profile
            </div>
        </button>
    @endif
</form>
