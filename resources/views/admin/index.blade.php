<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="px-4 mx-auto max-w-screen-xl">
            <section class="bg-white dark:bg-gray-900">
                <div class="px-4 py-4 mx-auto max-w-screen-md text-center">
                    <h2 class="mb-4 text-3xl tracking-tight font-bold text-gray-900 dark:text-white">CezAgora Admin dashboard</h2>
                    <h3 class="mb-4 text-2xl tracking-tight font-bold text-gray-900 dark:text-white">This is where we click buttons to run the cosmetics world</h3>
                </div>
            </section>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-8">
                @include('admin._campaigns')
                @include('admin._emails')
                @include('admin._received_messages')
                @include('admin.search._keywords_with_no_results')
                @include('admin.users._buyers_and_sellers')
            </div>
        </div>
    </section>
</x-app-layout>
