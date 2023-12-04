<x-guest-layout>
    <section class="bg-gray-50">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div
                class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('password.store') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" type="email" name="email" :value="old('email', $request->email)"
                                          autofocus autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" type="password" name="password" :value="old('password')"
                                          autofocus autocomplete="password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirm password')" />
                            <x-text-input id="password_confirmation" type="password" name="password_confirmation"
                                          :value="old('password_confirmation')" autofocus
                                          autocomplete="password_confirmation" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                        <x-primary-button class="ml-4">
                            {{ __('Reset Password') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>

