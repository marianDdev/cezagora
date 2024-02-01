<x-app-layout>
    @if($searches->count() === 0)
        <section class="bg-white dark:bg-gray-900">
            <div class="px-4 mx-auto max-w-screen-md">
                <p class="mb-6 lg:mb-6 font-extrabold text-center text-red-500 dark:text-gray-400 sm:text-xl">No searches for the moment.</p>
            </div>
        </section>
    @else
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <section class="bg-gray-50">
                <div class="flex flex-col items-center justify-center mb-6 mt-6">
                    <div
                        class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                                Searched keywords with no result
                            </h1>
                        </div>
                    </div>
                </div>
            </section>
            <table class="w-3/4 mx-auto text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Company
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Company Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Company Phone
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Company Country
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Keyword
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Count
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($searches as $search)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">
                                {{ $search->company ? $search->company->name : ''}}
                            </td>
                            <td class="px-6 py-4">
                                {{ $search->company ? $search->company->email : ''}}
                            </td>
                            <td class="px-6 py-4">
                                {{ $search->company ? $search->company->phone : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $search->company ? $search->company->address->country : ''}}
                            </td>
                            <td class="px-6 py-4">
                                {{ $search->keyword }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $search->count }}
                            </td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($search->updated_at)->format('Y-m-d H:i:s') }}
                            </td>
                        </tr>
                    @endforeach
                    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
                        {{ $searches->links() }}
                    </div>
                </tbody>
            </table>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <section class="bg-gray-50">
                <div class="flex flex-col items-center justify-center mb-6 mt-6">
                    <div
                        class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                                Top 10 most searched keywords
                            </h1>
                        </div>
                    </div>
                </div>
            </section>
            <table class="w-3/4 mx-auto text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Keyword
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Count
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topKeywords as $keyword)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">
                                {{ $keyword->keyword }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $keyword->total_count }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-app-layout>
