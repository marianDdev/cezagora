<div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
    <div>
        <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg"
             src="https://t4.ftcdn.net/jpg/01/17/37/23/240_F_117372318_MiQbRCJbuE2J4kzujthiiOWiBw6VaNcn.jpg" />
    </div>

    <!-- Modal toggle -->
    <button data-modal-target="add-manually" data-modal-toggle="add-manually"
            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ml-6 mr-6"
            type="button">
        {{ __('messages.add_manually') }}
    </button>

    <!-- Main modal -->
    <div id="add-manually" tabindex="-1" aria-hidden="true"
         class="{{ session()->has('errors') && session()->get('errors')->hasBag('default') ? '' : 'hidden' }} fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="add-manually"
                >
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-4 py-4 lg:px-8">
                    <form class="space-y-6" method="POST" action="{{ route('packaging.store') }}">
                        @csrf
                        <input type="hidden" name="company_id" value="{{ $company->id }}">
                        <div>
                            <div class="border-b border-gray-200 py-6">
                                <div class="pt-6" id="filter-section-2">
                                    <div class="space-y-4">
                                        <div class="flex items-center">
                                            <select name="packaging_category_id"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="">{{ __('messages.select_category') }}</option>
                                                @foreach($categories as $category)
                                                    <option
                                                        value="{{ $category->id }}">{{ __(sprintf('messages.%s', \Illuminate\Support\Str::snake($category->name)))  }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.name') }}</label>
                            <input type="text" name="name"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                   placeholder="ex: Borcan">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div>
                            <label for="description"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ ucfirst(__('messages.description')) }}</label>
                            <input type="text" name="description"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div>
                            <label for="colour"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ ucfirst(__('messages.colour')) }}</label>
                            <input type="text" name="colour"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <x-input-error :messages="$errors->get('colour')" class="mt-2" />
                        </div>
                        <div>
                            <label for="bottom_shape"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ ucfirst(__('messages.bottom_shape')) }}</label>
                            <input type="text" name="bottom_shape"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <x-input-error :messages="$errors->get('bottom_shape')" class="mt-2" />
                        </div>
                        <div>
                            <label for="material"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ ucfirst(__('messages.material')) }}</label>
                            <input type="text" name="material"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                   placeholder="{{ __('messages.eg_glass') }}">
                            <x-input-error :messages="$errors->get('material')" class="mt-2" />
                        </div>
                        <div>
                            <label for="price"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ ucfirst(__('messages.price')) }}</label>
                            <input type="number" name="price"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                        <div>
                            <label for="capacity"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ ucfirst(__('messages.capacity')) }}</label>
                            <input type="number" name="capacity"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <x-input-error :messages="$errors->get('capacity')" class="mt-2" />
                        </div>
                        <div>
                            <label for="neck_size"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ ucfirst(__('messages.neck_size')) }}</label>
                            <input type="number" name="neck_size"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <x-input-error :messages="$errors->get('neck_size')" class="mt-2" />
                        </div>
                        <button type="submit"
                                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600"
                                data-modal-hide="!$errors->any() ? 'add-manually' : 'do not close'"
                        >
                            {{ ucfirst(__('messages.add')) }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
