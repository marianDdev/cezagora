<div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
    <div>
        <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg"
             src="https://t4.ftcdn.net/jpg/01/17/37/23/240_F_117372318_MiQbRCJbuE2J4kzujthiiOWiBw6VaNcn.jpg" />
    </div>

    <!-- Modal toggle -->
    <button data-modal-target="add-services-manually" data-modal-toggle="add-services-manually"
            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ml-6 mr-6"
            type="button">
        {{ __('messages.add_manually') }}
    </button>

    <!-- Main modal -->
    <div id="add-services-manually" tabindex="-1" aria-hidden="true"
         class="{{ session()->has('errors') && session()->get('errors')->hasBag('default') ? '' : 'hidden' }} fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="add-services-manually"
                >
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-4 py-4 lg:px-8">
                    <form method="POST" action="{{ route('service.store') }}" class="w-4/5 ">
                        @csrf
                        <div class="mb-6">
                            <input type="hidden" name="company_id" value="{{ $company->id }}">
                        </div>
                        <div class="mb-6">
                            <div class="flex items-center">
                                <select name="type"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="{{ null }}">{{ ucfirst(__('messages.select_service_type')) }}</option>
                                    @foreach(\App\Services\Service\ServicesServiceInterface::TYPES as $type)
                                        <option value="{{ $type }}">{{ ucfirst(__(sprintf('messages.%s', $type))) }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('type')" class="mt-2" />
                            </div>
                        </div>
                        <div class="mb-6">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" type="text" name="name" :value="old('name')" autofocus
                                          autocomplete="name"
                                          placeholder="Laboratory testing" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mb-6">
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" type="text" name="description" :value="old('Description')" autofocus
                                          autocomplete="description" />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="mb-6">
                            <x-input-label for="price" :value="__('Price in euro cents')" />
                            <x-text-input id="price" type="text" name="price" :value="old('Price')" autofocus
                                          autocomplete="price"
                                          placeholder="for 10 EURO just add 1000" />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                        <div class="mb-6">
                            <x-input-label for="additional_info" :value="__('Additional info')" />
                            <x-text-input id="additional_info" type="text" name="additional_info"
                                          :value="old('additional_info')" autofocus
                                          autocomplete="additional_info" placeholder="E.g: Specific conditions ..." />
                            <x-input-error :messages="$errors->get('additional_info')" class="mt-2" />
                        </div>
                        <x-primary-button class="mb-10"
                                          :data-modal-hide="!$errors->any() ? 'add-services-manually' : 'do not close'">
                            {{ __('messages.submit') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
