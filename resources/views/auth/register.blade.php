<x-guest-layout>
    <section class="bg-gray-50">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto ">
            <div
                class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <div class="mb-6">
                        <label
                            class="block mb-2 text-sm font-medium text-orange-500 dark:text-white">Check the list of countries where CezAgora is currently supported.</label>
                        <label
                            class="block mb-2 text-sm font-medium text-orange-500 dark:text-white">Once CezAgora is available in your country, we'll be more than happy to have you in our community.</label>
                        <select
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach($countries as $country)
                                <option>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Create and account
                    </h1>

                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div>
                            <x-input-label for="first_name" :value="__('First name')" />
                            <x-text-input id="first_name" type="text" name="first_name" :value="old('first_name')"
                                          autofocus autocomplete="first_name" />
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="last_name" :value="__('Last name')" />
                            <x-text-input id="last_name" type="text" name="last_name" :value="old('last_name')"
                                          autofocus autocomplete="last_name" />
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" type="email" name="email" :value="old('email')" autofocus
                                          autocomplete="email" />
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
                            <p class="text-sm text-orange-300 mt-5">
                                Choose a password with a length between 8 and 30 characters, include a number, a symbol, lower and uppercase letters.
                            </p>
                        </div>
                        <x-primary-button class="ml-4">
                            {{ __('Create an account') }}
                        </x-primary-button>
                        <p class="text-sm font-light text-gray-500">
                            Already have an account? <a href="{{ route('login') }}" class=" font-medium text-indigo-500
                                                        hover:underline"> Login here</a>
                        </p>
                        <p class="text-gray-500 text-sm">By clicking <span
                                class="text-gray-700 font-bold">Create an account</span> you agree to the CezAgora <a
                                href="#" class=" font-medium text-indigo-500
                                                        hover:underline"> Terms and Conditions</a>, <a href="#" class=" font-medium text-indigo-500
                                                        hover:underline">Privacy Policy</a> and <a href="#" class=" font-medium text-indigo-500
                                                        hover:underline">Licensing</a>.</p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>

