<x-app-layout>
    <section class="bg-gray-50">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto ">
            <div
                class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Create promotional campaign
                    </h1>

                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('campaign.store') }}">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" type="text" name="name" :value="old('name')"
                                          autofocus autocomplete="name"  />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="pt-6" id="filter-section-2">
                            <x-input-label for="start_at" :value="__('Start Date')" />
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <input type="date" name="start_at"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                           min="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>
                        <div class="pt-6" id="filter-section-2">
                            <x-input-label for="end_at" :value="__('End Date (optional)')" />
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <input type="date" name="end_at"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                           min="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>
                        <div>
                            <x-input-label for="limit" :value="__('Limit (how many times a company can benefit from promotion during campaign)')" />
                            <x-text-input id="limit" type="number" limit="limit" :value="old('limit')"
                                          autofocus autocomplete="limit"  />
                            <x-input-error :messages="$errors->get('limit')" class="mt-2" />
                        </div>
                        <x-primary-button class="ml-4">
                            {{ __('Create campaign') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>

