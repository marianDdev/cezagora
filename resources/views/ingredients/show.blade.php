<x-app-layout>
    <!-- component -->
    <section class="text-gray-700 body-font overflow-hidden bg-white">
        <div class="container px-5 py-24 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $name }}</h1>
                    <p class="leading-relaxed">{{ $description }}</p>
                    <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-200 mb-5">
                        <div class="flex">
                            <span class="mr-3">Function: </span>
                            <p class="leading-relaxed">{{ $function }}</p>
                        </div>
                    </div>
                    <a href="{{ route('ingredients') }}"
                       class="flex ml-auto text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded">Back to all ingredients</a>
                </div>
            </div>
        </div>
    </section>
    @include('ingredients.show_table', ['ingredients' => $ingredients])
</x-app-layout>
