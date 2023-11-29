<div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
    <a href="{{ route('my.products.services') }}">
        <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg"
             src="{{ $packaging->getFirstMediaUrl('packagings') ?? 'https://t4.ftcdn.net/jpg/03/21/80/19/240_F_321801983_nc5GX5xGwaXxn5W6d9edJQOq3XVmochS.jpg'}}" />
        <div class="p-5">
            <div class="p-5">
                <a href="#">
                    <h3 class="text-xl font-bold ">
                        {{ ucfirst(__('messages.name')) }}: <span class="text-indigo-500">{{ $packaging->name }}</span>
                    </h3>
                </a>
                <p class="text-gray-500 dark:text-gray-400 mb-2">{{ ucfirst(__('messages.category')) }}: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ $packaging->category->name }}</span></p>
                <p class="text-gray-500 dark:text-gray-400 mb-2">{{ ucfirst(__('messages.price')) }}: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ $packaging->price }}</span></p>
                <p class="text-gray-500 dark:text-gray-400 mb-2">{{ ucfirst(__('messages.colour')) }}: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ ucfirst($packaging->colour) }}</span></p>
                <p class="text-gray-500 dark:text-gray-400 mb-2">{{ ucfirst(__('messages.capacity')) }}: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ $packaging->capacity }}</span></p>
                <p class="text-gray-500 dark:text-gray-400 mb-2">{{ ucfirst(__('messages.material')) }}: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ $packaging->material }}</span></p>
                <p class="text-gray-500 dark:text-gray-400 mb-2">{{ ucfirst(__('messages.neck_size')) }}: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ $packaging->neck_size }}</span></p>
                <p class="text-gray-500 dark:text-gray-400 mb-2">{{ ucfirst(__('messages.bottom_shape')) }}: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ $packaging->bottom_shape }}</span></p>
            </div>
        </div>
    </a>
</div>
