<!-- Modal toggle -->
<button data-modal-target="add-qualification-modal" data-modal-toggle="add-qualification-modal"
        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
        type="button">
    {{ __('messages.add_qualification') }}
</button>

<div id="add-qualification-modal" tabindex="-1" aria-hidden="true"
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
                        data-modal-hide="add-qualification-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg flex justify-center items-center">
                <form method="POST" action="{{ route('qualification.store') }}" class="w-4/5 ">
                    @csrf
                    <div class="mb-6">
                        <input type="hidden" name="company_id" value="{{ $company->id }}">
                    </div>
                    <div class="mb-6">
                        <div class="flex items-center">
                            <select name="type"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="{{ null }}">Select qualification type</option>
                                @foreach(\App\Services\Qualification\QualificationServiceInterface::TYPES as $type)
                                    <option value="{{ $type }}">{{ $type  }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>
                    </div>
                    <div class="mb-6">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" type="text" name="name" :value="old('name')" autofocus
                                      autocomplete="name"
                                      placeholder="Eg: ISO 9001" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <x-input-label for="issuer" :value="__('Issuing organization')" />
                        <x-text-input id="issuer" type="text" name="issuer" :value="old('issuer')" autofocus
                                      autocomplete="issuer"
                                      placeholder="Eg: Global Quality Certification Inc." />
                        <x-input-error :messages="$errors->get('issuer')" class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <x-input-label for="certificate_number" :value="__('Qualification number or ID')" />
                        <x-text-input id="certificate_number" type="text" name="certificate_number"
                                      :value="old('certificate_number')" autofocus autocomplete="mcc"
                                      placeholder="Eg: CERT12345X_2023-01-BIO_ISO9001-0001" />
                        <x-input-error :messages="$errors->get('certificate_number')" class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <x-input-label for="scope" :value="__('Scope or coverage')" />
                        <x-text-input id="scope" type="text" name="scope" :value="old('scope')" autofocus
                                      autocomplete="scope"
                                      placeholder="E.g: Ingredient Sourcing,Product Testing, EU Safety Compliance, Sustainable Packaging" />
                        <x-input-error :messages="$errors->get('scope')" class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <x-input-label for="verification_link" :value="__('URL for credential’s authenticity verification.')" />
                        <x-text-input id="verification_link" type="url" name="verification_link" :value="old('verification_link')" autofocus
                                      autocomplete="verification_link" placeholder="Eg: https://www.example.com/my_qualification_id" />
                        <x-input-error :messages="$errors->get('verification_link')" class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <x-input-label for="url" :value="__('URL of credential document digital copy (if available).')" />
                        <x-text-input id="url" type="url" name="url" :value="old('url')" autofocus
                                      autocomplete="url" placeholder="Eg: https://www.example.com/my_qualification.pdf" />
                        <x-input-error :messages="$errors->get('url')" class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <x-input-label for="additional_info" :value="__('Additional info')" />
                        <x-text-input id="additional_info" type="text" name="additional_info"
                                      :value="old('additional_info')" autofocus
                                      autocomplete="additional_info" placeholder="E.g: Specific conditions of certification" />
                        <x-input-error :messages="$errors->get('additional_info')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="issued_at" :value="__('Issue date')" />
                        <div class="flex items-center">
                            <input type="date" name="issued_at"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                   max="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="mb-6">
                        <x-input-label for="expire_at" :value="__('Expiration date if there is the case')" />
                        <div class="flex items-center">
                            <input type="date" name="expire_at"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>
                    </div>

                    <x-primary-button class="mb-10"
                                      :data-modal-hide="!$errors->any() ? 'add-qualification-modal' : 'do not close'">
                        {{ __('messages.submit') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</div>
