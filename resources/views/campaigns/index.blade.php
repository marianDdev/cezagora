<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Campaigns and promotions</h2>
            </div>
            <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
                @foreach($campaigns as $campaign)
                    <div
                        class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
                        <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg"
                             src="https://t4.ftcdn.net/jpg/03/09/88/99/240_F_309889958_OfHTstMGMJt0v9It20MD2riAJPafuOQ8.jpg"
                             alt="my products and services image" />
                        <div class="p-5">
                            <div class="p-5">
                                <h3 class="text-xl font-bold tracking-tight text-indigo-500">
                                    {{ $campaign->name }}
                                </h3>
                                <p
                                    class="text-gray-500 dark:text-gray-400">Start date: {{ \Carbon\Carbon::parse($campaign->start_at)->format('Y-m-d') }}</p>
                                <p
                                    class="text-gray-500 dark:text-gray-400">End date: {{ $campaign->end_at ? \Carbon\Carbon::parse($campaign->end_at)->format('Y-m-d') : 'None' }}</p>
                                <p
                                    class="text-gray-500 dark:text-gray-400">Limit: {{ $campaign->limit }}</p>
                                <p class="text-gray-500 dark:text-gray-300 italic">(how many times a company has the right to benefit from the promotion)</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-app-layout>
