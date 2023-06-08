<x-app-layout>

    <h3 class="mb-10 mt-16 text-3xl font-extrabold leading-none tracking-tight text-blue-500 md:text-3xl lg:text-3xl dark:text-white text-center">Manage all your ingredients in one place</h3>

    <a>click here to add more ingredients:</a>
    <ul>
        <li>choose multiple from our ingredients selection. If we don't have it add it via add ingredient form</li>
        <li>import ingreients from csv or xls file. Please name your columns as they are in this table</li>
        <li></li>
    </ul>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg flex justify-center items-center">
        <table class="w-4/5 text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-sm text-blue-500 uppercase bg-gray-200">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Company
                    </th>
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
                        <span class="sr-only">Edit</span>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Delete</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($ingredients as $ingredient)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $ingredient->company}}
                        </th>
                        <td class="px-6 py-4">
                            {{ $ingredient->name}}
                        </td>
                        <td class="px-6 py-4">
                            {{ $ingredient->description}}
                        </td>
                        <td class="px-6 py-4">
                            {{ $ingredient->function}}
                        </td>
                        <td class="px-6 py-4">
                            {{ $ingredient->quantity}}
                        </td>
                        <td class="px-6 py-4">
                            ${{ $ingredient->price}}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
