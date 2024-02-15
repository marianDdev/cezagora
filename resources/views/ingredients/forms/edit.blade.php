<button data-modal-target="edit-ingredient-modal-{{ $ingredient->id }}"
        data-modal-toggle="edit-ingredient-modal-{{ $ingredient->id }}"
        class="w-3/4 block text-white bg-red-400 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm py-2.5 text-center"
        type="button">
    Edit
</button>

<!-- Main modal -->
<div id="edit-ingredient-modal-{{ $ingredient->id }}" tabindex="-1" aria-hidden="true"
     class="{{ session()->has('errors') && session()->get('errors')->hasBag('default') && !session()->get('errors')->getBag('default')->has('uploadError') ? '' : 'hidden' }}
         fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="edit-ingredient-modal-{{ $ingredient->id }}"
            >
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Update</h3>
                <form class="space-y-6" method="POST" action="{{ route('ingredient.update') }}">
                    @method('PATCH')
                    @csrf
                    <input type="hidden" name="company_id"
                           value="{{ \Illuminate\Support\Facades\Auth::user()->company->id }}">
                    <input type="hidden" name="id" value="{{ $ingredient->id }}" />
                    <div>
                        <label for="name"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">INCI name</label>
                        <input type="text" name="name"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                               placeholder="ex: Melaleuca alternifolia (Tea Tree) Leaf Oil"
                               value="{{ $ingredient->name }}">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <label for="common_name"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Common name</label>
                        <input type="text" name="common_name"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                               placeholder="ex: Tea tree oil" value="{{ $ingredient->common_name }}">
                        <x-input-error :messages="$errors->get('common_name')" class="mt-2" />
                    </div>
                    <div>
                        <label for="description"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Short description</label>
                        <input type="text" name="description" value="{{ $ingredient->description }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                    <div>
                        <label for="function"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Function</label>
                        <input type="text" name="function" value="{{ $ingredient->function }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <x-input-error :messages="$errors->get('function')" class="mt-2" />
                    </div>
                    <div>
                        <label for="price"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                        <input type="number" name="price" value="{{ $ingredient->price }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>
                    <div>
                        <label for="quantity"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Available quantity </label>
                        <input type="number" name="quantity" value="{{ $ingredient->quantity }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                    </div>

                    @include('ingredients.forms.create._documents_checkboxes', ['documents' => $documents, 'ingredient' => $ingredient])

                    <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600"
                            data-modal-hide="!$errors->any() ? 'edit-ingredient-modal-{{ $ingredient->id }}' : 'do not close'"
                    >
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
