<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">CezAgora Admin dashboard</h2>
                <p class="font-light text-orange-300 lg:mb-16 sm:text-xl">This is where we click buttons to run the cosmetics world</p>
            </div>
            <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-3">
                <div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
                    <a href="{{ route('campaigns.index') }}">
                        <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg"
                             src="https://t3.ftcdn.net/jpg/02/99/56/90/240_F_299569000_p2owkcBbZICGt5IFXy1w1mf8Cz780r8g.jpg"
                             alt="campaigns image" />
                        <div class="p-5">
                            <div class="p-5">
                                <a href="{{ route('campaigns.index') }}">
                                    <h3 class="text-xl font-bold tracking-tight text-indigo-500">
                                        Campaigns
                                    </h3>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
                    <a href="{{ route('admin.emails.index') }}">
                        <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg"
                             src="https://t4.ftcdn.net/jpg/01/35/06/45/240_F_135064543_h1y4vDMWg3GuXv5k2v6vX6SuiPrMMnZu.jpg"
                             alt="email image" />
                        <div class="p-5">
                            <div class="p-5">
                                <a href="{{ route('admin.emails.index') }}">
                                    <h3 class="text-xl font-bold tracking-tight text-indigo-500">
                                        Emails
                                    </h3>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
                    <a href="{{ route('campaigns.index') }}">
                        <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg"
                             src="https://t4.ftcdn.net/jpg/05/60/00/99/240_F_560009939_ntsxgLst4pLARJOnmsUJ6kxpUEOm4XvW.jpg"
                             alt="email image" />
                        <div class="p-5">
                            <div class="p-5">
                                <a href="{{ route('campaigns.index') }}">
                                    <h3 class="text-xl font-bold tracking-tight text-indigo-500">
                                        Received messages
                                    </h3>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
                    <a href="{{ route('searches.index') }}">
                        <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg"
                             src="{{ url('/images/admin/search.png') }}"
                             alt="email image" />
                        <div class="p-5">
                            <div class="p-5">
                                <a href="{{ route('searches.index') }}">
                                    <h3 class="text-xl font-bold tracking-tight text-indigo-500">
                                        Searches with no results
                                    </h3>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
