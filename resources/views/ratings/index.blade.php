<x-guest-layout>
    <section class="mx-auto max-w-2xl">
        <div class="text-center">
            <div class="flex items-center justify-center mb-2">
                <h1 class="text-3xl font-bold tracking-tight text-red-400 sm:text-4xl">
                    {{ $company->name }}
                </h1>
                <span class="flex items-center ml-3">
                    @for ($i = 1; $i <= 5; $i++)
                        <svg class="w-4 h-4 {{ $i <= $averageRating ? 'text-yellow-300' : 'text-gray-300' }}"
                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                        </svg>
                    @endfor
                </span>
                <span class="text-sm font-medium text-gray-600 ml-2">
                    {{ number_format($averageRating, 2) }} out of {{ $company->receivedRatings->count() }} reviews
                </span>
            </div>
            <p class="mt-6 text-lg leading-8 text-gray-600">{{ $company->product_description }}</p>
        </div>
    </section>

    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="grid gap-8 lg:grid-cols-3">
                @foreach($company->receivedRatings as $rating)
                    <article
                        class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                        <h2 class="mb-1 text-2xl font-bold tracking-tight text-red-400 dark:text-white">{{ $rating->reviewer->name }}</h2>
                        <p class="mb-5 text-gray-500">Joined on {{ \Carbon\Carbon::parse($rating->reviewer->created_at)->format('F Y') }}
                        </p>
                        <div class="flex items-center mb-1 space-x-1 rtl:space-x-reverse">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $rating->rating ? 'text-yellow-300' : 'text-gray-300' }}"
                                     aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                     viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                            @endfor
                        </div>
                        <footer class="mb-5 text-sm text-gray-500 dark:text-gray-400">
                            <p>{{ \Carbon\Carbon::parse($rating->created_at)->format('F d, Y') }}
                            </p></footer>
                        <p class="mb-5 text-gray-700 italic">{{ $rating->comment }}</p>
                    </article>

                @endforeach
            </div>
        </div>
    </section>
</x-guest-layout>
