<x-app-layout>
    <h3 class="mb-10 mt-16 text-3xl font-extrabold leading-none tracking-tight text-blue-500 md:text-3xl lg:text-3xl dark:text-white text-center">Our partners</h3>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg flex justify-center items-center">
        @if($companies->count() > 0)
            @include(
                'companies.index_table',['companies' => $companies]
                )
        @else
            <h3 class="mb-10 mt-16 text-3xl font-extrabold leading-none tracking-tight text-blue-500 md:text-3xl lg:text-3xl dark:text-white text-center">Motha fucka you have zero ingredients. Move your ass and add some!</h3>
        @endif
    </div>
</x-app-layout>
