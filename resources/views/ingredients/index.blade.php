<x-app-layout>
    <h3 class="mb-10 mt-16 text-3xl font-extrabold leading-none tracking-tight text-blue-500 md:text-3xl lg:text-3xl dark:text-white text-center">Manage all your ingredients in one place</h3>

    @include('ingredients.forms.upload')
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg flex justify-center items-center">
        @if($ingredients->count() > 0)
            @include('ingredients.index_table', ['ingredients' => $ingredients])
        @else
            <h3 class="mb-10 mt-16 text-3xl font-extrabold leading-none tracking-tight text-blue-500 md:text-3xl lg:text-3xl dark:text-white text-center">Motha fucka you have zero ingredients. Move your ass and add some!</h3>
        @endif
    </div>
</x-app-layout>
