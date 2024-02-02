<button data-modal-target="add-modal-{{ $item->name }}-{{ $item->id }}"
        data-modal-toggle="add-modal-{{ $item->name }}-{{ $item->id }}"
        class="block text-white bg-red-400 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        type="button">
    Add to cart
</button>
<div id="add-modal-{{ $item->name }}-{{ $item->id }}" tabindex="-1"
     class="{{ session()->has('errors') && session()->get('errors')->hasBag('default') ? '' : 'hidden' }} overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="add-modal-{{ $item->name }}-{{ $item->id }}">
                <svg class="w-3 h-3" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round"
                          stroke-linejoin="round" stroke-width="2"
                          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg
                    class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round"
                          stroke-linejoin="round" stroke-width="2"
                          d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Add {{ $ingredient->name }} to cart</h3>
                <form action="{{ route('ingredient.order-item.store') }}" method="post">
                    @csrf
                    <input id="customer_id" name="customer_id"
                           value="{{ \Illuminate\Support\Facades\Auth::user()->company_id }}" type="hidden" />
                    <input id="seller_id" name="seller_id" value="{{ $ingredient->company->id }}"
                           type="hidden" />
                    <input id="item_id" name="item_id" value="{{ $ingredient->id }}"
                           type="hidden" />
                    <input id="price" name="price" value="{{ $ingredient->price }}" type="hidden" />
                    <div>
                        <x-input-error :messages="$errors->get('quantity')" class="mb-8" />
                        <label for="quantity"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                        <input type="number" name="quantity" min="1" max="{{ $ingredient->quantity }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                    </div>

                    <input id="name" name="name" value="{{ $ingredient->name }}" type="hidden" />
                    <button type="submit"
                            data-modal-hide="!$errors->any() ? 'add-modal-{{ $item->name }}-{{ $item->id }}' : 'do not close'"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                        Add to cart
                    </button>
                    <button data-modal-hide="add-modal-{{ $item->name }}-{{ $item->id }}"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
