<x-guest-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
            <section class="mx-auto max-w-2xl mb-6">
                <div class="text-center">
                    <h1 class="text-3xl font-bold tracking-tight text-red-400 sm:text-4xl mb-2">{{ __('messages.discover_suppliers') }}</h1>
                </div>
            </section>

            <div class="grid md:grid-cols-2 gap-8">
                @include('pages.home.raw_materials')
                @include('pages.home.packaging')
                @include('pages.home.equipment')
                @include('pages.home.formulation')
                @include('pages.home.laboratory')
                @include('pages.home.compliance')
                @include('pages.home.qa')
                @include('pages.home.marketing')
                @include('pages.home.branding')
                @include('pages.home.market_research')
                @include('pages.home.import_export')
                @include('pages.home.delivery')
                @include('pages.home.innovation')
                @include('pages.home.business_strategy')
                @include('pages.home.training')
                @include('pages.home.cosmetic_products')
            </div>
        </div>
    </section>
</x-guest-layout>
