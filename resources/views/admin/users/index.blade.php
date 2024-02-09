<x-app-layout>
    <div class="mb-10 relative overflow-x-auto shadow-md sm:rounded-lg">
        <section class="bg-white dark:bg-gray-900">
            <div class="px-4 mx-auto max-w-screen-md">
                <p class="mb-6 lg:mb-6 font-extrabold text-center text-red-500 dark:text-gray-400 sm:text-xl">Buyers</p>
            </div>
        </section>
        <table class="w-3/4 mx-auto text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        First name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Last name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Company email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Company name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Company phone
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Website
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Country
                    </th>
                    <th scope="col" class="px-6 py-3">
                        City
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Signup date
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($buyers as $buyer)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">
                            {{ $buyer->first_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $buyer->last_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $buyer->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $buyer->company ? $buyer->company->email : ''}}
                        </td>
                        <td class="px-6 py-4">
                            {{ $buyer->company ? $buyer->company->name : ''}}
                        </td>
                        <td class="px-6 py-4">
                            {{ $buyer->company ? $buyer->company->phone : ''}}
                        </td>
                        <td class="px-6 py-4">
                            {{ $buyer->company ? $buyer->company->website : ''}}
                        </td>
                        <td class="px-6 py-4">
                            {{ $buyer->company ? $buyer->company->address->country : ''}}
                        </td>
                        <td class="px-6 py-4">
                            {{ $buyer->company ? $buyer->company->address->city : ''}}
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($buyer->created_at)->format('d-m-Y') }}
                        </td>
                    </tr>
                @endforeach
                <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
                    {{ $buyers->links() }}
                </div>
            </tbody>
        </table>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <section class="bg-white dark:bg-gray-900">
            <div class="px-4 mx-auto max-w-screen-md">
                <p class="mb-6 lg:mb-6 font-extrabold text-center text-red-500 dark:text-gray-400 sm:text-xl">Sellers</p>
            </div>
        </section>
        <table class="w-3/4 mx-auto text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        First name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Last name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Company email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Company name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Company phone
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Website
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Country
                    </th>
                    <th scope="col" class="px-6 py-3">
                        City
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Signup date
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($sellers as $seller)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">
                            {{ $seller->first_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $seller->last_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $seller->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $seller->company ? $seller->company->email : ''}}
                        </td>
                        <td class="px-6 py-4">
                            {{ $seller->company ? $seller->company->name : ''}}
                        </td>
                        <td class="px-6 py-4">
                            {{ $seller->company ? $seller->company->phone : ''}}
                        </td>
                        <td class="px-6 py-4">
                            {{ $seller->company ? $seller->company->website : ''}}
                        </td>
                        <td class="px-6 py-4">
                            {{ $seller->company ? $seller->company->address->country : ''}}
                        </td>
                        <td class="px-6 py-4">
                            {{ $seller->company ? $seller->company->address->city : ''}}
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($seller->created_at)->format('d-m-Y') }}
                        </td>
                    </tr>
                @endforeach
                <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
                    {{ $sellers->links() }}
                </div>
            </tbody>
        </table>
    </div>
</x-app-layout>
