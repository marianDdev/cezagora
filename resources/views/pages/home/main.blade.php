<x-guest-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
            @include('pages.home.hero')
            <div class="grid md:grid-cols-2 gap-8">
                @include('pages.home.raw_materials')
                @include('pages.home.laboratory')
                @include('pages.home.compliance')
                @include('pages.home.packaging')
                @include('pages.home.carriers')
                @include('pages.home.marketing')
                @include('pages.home.cosmetic_products')
            </div>
        </div>
    </section>
</x-guest-layout>
