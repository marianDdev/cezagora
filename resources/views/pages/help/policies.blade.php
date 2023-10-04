<x-guest-layout>
    <section class="bg-white dark:bg-gray-900">
        <h1 class="mb-4 text-3xl font-bold text-center">
            Policies
        </h1>
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
            <div class="grid md:grid-cols-3 gap-4">
                @include('pages.help.cards._advertising_policy')
                @include('pages.help.cards._brand_policy')
                @include('pages.help.cards._cookie_policy')
                @include('pages.help.cards._copyright_policy')
                @include('pages.help.cards._general_policies')
                @include('pages.help.cards._privacy_policy')
                @include('pages.help.cards._tc')
            </div>
        </div>
    </section>
</x-guest-layout>
