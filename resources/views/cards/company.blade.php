<div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
    <a href="#">
        <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" src="{{ $imagePath}}" />
    </a>
    <div class="p-5">
        @if(!is_null($company))
            <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white mb-2">
                My company
            </h3>
            <p class="text-gray-500 dark:text-gray-400"><span class="font-bold">Name:</span> {{ $title }}</p>
            <p class="text-gray-500 dark:text-gray-400"><span class="font-bold">Email:</span> {{ $email }}</p>
            <p class="text-gray-500 dark:text-gray-400"><span class="font-bold">Phone:</span> {{ $phone }}</p>
            <p class="text-gray-500 dark:text-gray-400"><span class="font-bold">CezAgora admin:</span> {{ $admin }}</p>
            <p class="text-blue-500 dark:text-gray-400 mt-2"><a
                    href="{{ route('companies.edit') }}">click here to update your company's details</a></p>
        @else
            <p class="text-gray-500 dark:text-gray-400">You didn't add your company details.</p>
            <p class="text-blue-500 dark:text-gray-400 mt-2"><a
                    href="{{ route('companies.create') }}">click to create your company's profile</a></p>
        @endif
    </div>
</div>
