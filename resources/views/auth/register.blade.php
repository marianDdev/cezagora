<x-guest-layout>
    <section class="bg-gray-50">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div
                class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Create and account
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div>
                            <x-input-label for="first_name" :value="__('First name')" />
                            <x-text-input id="first_name" type="text" name="first_name" :value="old('first_name')" autofocus autocomplete="first_name" />
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="last_name" :value="__('Last name')" />
                            <x-text-input id="last_name" type="text" name="last_name" :value="old('last_name')" autofocus autocomplete="last_name" />
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" type="email" name="email" :value="old('email')" autofocus autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" type="password" name="password" :value="old('password')" autofocus autocomplete="password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirm password')" />
                            <x-text-input id="password_confirmation" type="password" name="password_confirmation" :value="old('password_confirmation')" autofocus autocomplete="password_confirmation" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="terms" aria-describedby="terms" type="checkbox"
                                       class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="terms" class="font-light text-gray-500">I accept the <a
                                        class="font-medium text-primary-600 hover:underline"
                                        href="#">Terms and Conditions</a></label>
                            </div>
                        </div>
                        {{--                        <x-button type="submit" title="Create an account" />--}}
                        <x-primary-button class="ml-4">
                            {{ __('Create an account') }}
                        </x-primary-button>
                        <p class="text-sm font-light text-gray-500">
                            Already have an account? <a href="{{ route('login') }} class="font-medium text-primary-600 hover:underline"> Login here</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>

