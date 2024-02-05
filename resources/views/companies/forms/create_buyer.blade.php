<p class="text-gray-500 dark:text-gray-400">You didn't add your company details.</p>
<!-- Modal toggle -->
<button data-modal-target="create-company-buyer" data-modal-toggle="create-company-buyer"
        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
        type="button">
    {{ __('messages.create_company') }}
</button>

<div id="create-company-buyer" tabindex="-1" aria-hidden="true"
     class="{{ session()->has('errors') && session()->get('errors')->hasBag('default') ? '' : 'hidden' }} fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ __('messages.create_company') }}
                </h3>
                <button type="button"
                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="create-company-buyer">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg flex justify-center items-center">
                <form method="POST" action="{{ route('company.store') }}" class="w-4/5 ">
                    @csrf
                    <div class="mb-6 mt-6">
                        <x-text-input id="email" type="email" name="email" :value="old('email')" autofocus
                                      autocomplete="email"
                                      placeholder="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <x-text-input id="name" type="text" name="name" :value="old('name')" autofocus
                                      autocomplete="name"
                                      placeholder="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <x-text-input id="phone" type="text" name="phone" :value="old('phone')" autofocus
                                      autocomplete="phone"
                                      placeholder="phone" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <x-input-label for="website" :value="__('Add your website including https://www (Optional)')" />
                        <x-text-input id="website" type="text" name="website" :value="old('website')" autofocus
                                      autocomplete="website" placeholder="Website or social media page URL" />
                        <x-input-error :messages="$errors->get('website')" class="mt-2" />
                    </div>
                    <livewire:country-dropdown />
                    <x-primary-button class="mb-10"
                                      :data-modal-hide="!$errors->any() ? 'create-company-buyer' : 'do not close'">
                        {{ __('messages.submit') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</div>
