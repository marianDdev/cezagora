<x-guest-layout>
    <section class="bg-gray-50">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div
                class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-gray-900">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </h1>
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" type="email" name="email" :value="old('email')" autofocus autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <x-primary-button class="ml-4">
                            {{ __('Email Password Reset Link') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>

