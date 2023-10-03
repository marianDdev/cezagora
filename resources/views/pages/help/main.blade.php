<x-guest-layout>
    <section class="bg-white dark:bg-gray-900">
        <h1 class="mb-4 text-3xl font-bold text-center">
            Welcome to our Help Center.
        </h1>
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
            <div class="grid md:grid-cols-3 gap-4">
                @include('pages.help.cards._guides')
                @include('pages.help.cards._faq')
                @include('pages.help.cards._contact')
                @include('pages.help.cards._video_tutorials')
                @include('pages.help.cards._roles')
                @include('pages.help.cards._policies')

            </div>
        </div>
    </section>
</x-guest-layout>
