<table class="w-4/5 text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-sm text-blue-500 uppercase bg-gray-200">
        <tr>
            <th scope="col" class="px-6 py-3">
                Name
            </th>
            <th scope="col" class="px-6 py-3">
                Category
            </th>
            <th scope="col" class="px-6 py-3">
                Email
            </th>
            <th scope="col" class="px-6 py-3">
                Phone
            </th>
            <th scope="col" class="px-6 py-3">
                Country
            </th>
            <th scope="col" class="px-6 py-3">
                City
            </th>
            <th scope="col" class="px-6 py-3">
                State
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($companies as $company)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-6 py-4 text-indigo-500">
                    <a href="{{ route('company.show', $company->slug) }}">
                    {{ $company->name ?? '' }}
                    </a>
                </td>
                <td class="px-6 py-4">
                    {{ $company->category->name ?? '' }}
                </td>
                <td class="px-6 py-4">
                    {{ $company->email ?? '' }}
                </td>
                <td class="px-6 py-4">
                    {{ $company->phone ?? '' }}
                </td>
                <td class="px-6 py-4">
                    {{ $company->addresses->first()->country ?? '' }}
                </td>
                <td class="px-6 py-4">
                    {{ $company->addresses->first()->city ?? '' }}
                </td>
                <td class="px-6 py-4">
                    {{ $company->address->state ?? '' }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
