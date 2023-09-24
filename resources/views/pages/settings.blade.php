<x-guest-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">

            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Account settings</h2>
            </div>

            <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
                @include('cards.settings.deactivate_account')
                @include('cards.settings.language')
                @include('cards.settings.notifications')
            </div>
        </div>
    </section>
</x-guest-layout>
