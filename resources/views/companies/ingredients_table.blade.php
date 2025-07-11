<div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:text-center">
            <p class="mt-2 bold tracking-tight text-gray-900 sm:text-4xl">{{ $company->name }}'s ingredients</p>
        </div>
    </div>
</div>
<table class="w-4/5 text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-sm text-blue-500 uppercase bg-gray-200">
        <tr>
            <th scope="col" class="px-6 py-3">
                Name
            </th>
            <th scope="col" class="px-6 py-3">
                Description
            </th>
            <th scope="col" class="px-6 py-3">
                <div class="flex items-center">
                    Function
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1" aria-hidden="true"
                             fill="currentColor" viewBox="0 0 320 512">
                            <path
                                d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z" />
                        </svg>
                    </a>
                </div>
            </th>
            <th scope="col" class="px-6 py-3">
                <div class="flex items-center">
                    Quantity
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1" aria-hidden="true"
                             fill="currentColor" viewBox="0 0 320 512">
                            <path
                                d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z" />
                        </svg>
                    </a>
                </div>
            </th>
            <th scope="col" class="px-6 py-3">
                <div class="flex items-center">
                    Price
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1" aria-hidden="true"
                             fill="currentColor" viewBox="0 0 320 512">
                            <path
                                d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z" />
                        </svg>
                    </a>
                </div>
            </th>
            <th scope="col" class="px-6 py-3">
                Actions
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($ingredients as $ingredient)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-6 py-4 text-indigo-500">
                    <a href="{{ route('ingredient.show', ['id' => $ingredient->id]) }}">
                        {{ $ingredient->name ?? '' }}
                    </a>
                </td>
                <td class="px-6 py-4">
                    {{ $ingredient->description ?? '' }}
                </td>
                <td class="px-6 py-4">
                    {{ $ingredient->function ?? '' }}
                </td>
                <td class="px-6 py-4">
                    {{ $ingredient->quantity ?? '' }}
                </td>
                <td class="px-6 py-4">
                    ${{ $ingredient->price ?? '' }}
                </td>
                <td class="px-6 py-6 text-right">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Add to cart</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
