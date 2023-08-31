<div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
    <div>
        <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg"
             src="https://t4.ftcdn.net/jpg/01/17/37/23/240_F_117372318_MiQbRCJbuE2J4kzujthiiOWiBw6VaNcn.jpg" />
    </div>

    <!-- Modal toggle -->
    <button data-modal-target="add-ingredient-modal" data-modal-toggle="add-ingredient-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ml-6 mr-6" type="button">
        Add ingredient manually
    </button>

    <!-- Main modal -->
    <div id="add-ingredient-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Add ingredient</h3>
                    <form class="space-y-6" method="POST" action="{{ route('ingredient.store') }}">
                        @csrf
                        <input type="hidden" name="company_id" value="{{ Auth::user()->company->id }}">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">INCI name</label>
                            <input type="text" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="ex: Melaleuca alternifolia (Tea Tree) Leaf Oil">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div>
                            <label for="common_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Common name</label>
                            <input type="text" name="common_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="ex: Tea tree oil">
                            <x-input-error :messages="$errors->get('common_name')" class="mt-2" />
                        </div>
                        <div>
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Short description</label>
                            <input type="text" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div>
                            <label for="function" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Function</label>
                            <input type="text" name="function" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <x-input-error :messages="$errors->get('function')" class="mt-2" />
                        </div>
                        <div>
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                            <input type="number" name="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                        <div>
                            <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Available quantity</label>
                            <input type="number" name="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                        </div>
                        <div>
                            <label for="availability" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Availability method</label>
                            <select name="availability"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach(['now', 'on_demand'] as $availability)
                                <option value="{{ $availability }}">{{ $availability }}</option>
                                @endforeach
                                </select>
                            <x-input-error :messages="$errors->get('availability')" class="mt-2" />
                        </div>
                        <div>
                            <label for="available_at" class="block mb-2 text-sm font-medium text-gray-900 ">Date when ingredients is available</label>
                            <input type="date" name="available_at" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <x-input-error :messages="$errors->get('available_at')" class="mt-2" />
                        </div>

{{--                        todo fix this datepicker--}}
{{--                        <div class="relative max-w-sm">--}}
{{--                            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">--}}
{{--                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">--}}
{{--                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                            <input datepicker type="text" name="available_at" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select available date date">--}}
{{--                        </div>--}}

                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
