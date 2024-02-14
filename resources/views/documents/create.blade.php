<x-app-layout>
    <section class="bg-gray-50">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div
                class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <form class="space-y-6" method="POST" action="{{ route('document.store') }}">
                        @csrf
                        <input type="hidden" name="ingredient_id" value="{{ $ingredientId }}">
                        @include('ingredients.forms.documents_checkboxes')
                        <div class="flex">
                        <button type="submit"
                                class="w-full mr-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600">
                            <span class="mr-2">Create & Go to ingredient variants</span>
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </button>
                        <a href="{{ route('ingredient.variant.create', ['ingredientId' => $ingredientId]) }}"
                                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600">
                            Skip
                        </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
