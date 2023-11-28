<div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
    <a href="{{ route('my.products.services') }}">
            <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" src="{{ $packaging->getFirstMediaUrl('packagings') ?? 'https://t4.ftcdn.net/jpg/03/21/80/19/240_F_321801983_nc5GX5xGwaXxn5W6d9edJQOq3XVmochS.jpg'}}" />
        <div class="p-5">
            <div class="p-5">
                <a href="#">
                    <h3 class="text-xl font-bold text-indigo-500">
                        {{ $packaging->name }}
                    </h3>
                </a>
                    <span class="text-gray-500 dark:text-gray-400">{{ $packaging->category->name }}</span>
                    <span class="text-gray-500 dark:text-gray-400">{{ $packaging->price }}</span>
                    <span class="text-gray-500 dark:text-gray-400">{{ $packaging->colour }}</span>
                    <span class="text-gray-500 dark:text-gray-400">{{ $packaging->capacity }}</span>
                    <span class="text-gray-500 dark:text-gray-400">{{ $packaging->material }}</span>
                    <span class="text-gray-500 dark:text-gray-400">{{ $packaging->neck_size }}</span>
                    <span class="text-gray-500 dark:text-gray-400">{{ $packaging->bottom_shape }}</span>
            </div>
        </div>
    </a>
</div>
