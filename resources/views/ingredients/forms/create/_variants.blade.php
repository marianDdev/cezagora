<x-app-layout>
    <section class="bg-gray-50">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div
                class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Add ingredient package details
                    </h1>
                    <form class="space-y-6" method="POST" action="{{ route('ingredient.variant.store') }}">
                        @csrf
                        <input type="hidden" name="ingredient_id" value="{{ $ingredientId }}">
                        <div class="mb-6">
                            <x-input-label for="unit" :value="__('Unit')" />
                            <select id="unit" name="unit"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Choose unit</option>
                                @foreach(['gr', 'kg', 'ml', 'l'] as $unit)
                                    <option value="{{ $unit }}">{{ $unit }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('unit')" class="mt-2" />
                        </div>
                        <div>
                            <label for="size"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Weight/Volume</label>
                            <input type="number" name="size"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <x-input-error :messages="$errors->get('size')" class="mt-2" />
                        </div>
                        <div>
                            <label for="price"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                            <input type="number" name="price"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                        <div>
                            <label for="quantity"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Available quantity</label>
                            <input type="number" name="quantity"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                        </div>
                        <livewire:show-available-at />
                        <button type="submit"
                                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600">
                            Create
                        </button>
                    </form>
                </div>
                <div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
