<div class="items-center bg-red-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
    <a href="{{ route('my.products.services') }}">
        <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg"
             src="{{ $service->getFirstMediaUrl('services') ?? 'https://t4.ftcdn.net/jpg/03/21/80/19/240_F_321801983_nc5GX5xGwaXxn5W6d9edJQOq3XVmochS.jpg'}}" />
        <div class="p-5">
            <div class="p-5">
                <a href="#">
                    <h3 class="text-xl font-bold ">
                        {{ ucfirst(__('messages.company')) }}: <span class="text-indigo-500">{{ $service->company->name }}</span>
                    </h3>
                </a>
                <p class="text-gray-500 dark:text-gray-400 mb-2">{{ ucfirst(__('messages.name')) }}: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ $service->name }}</span>
                </p>
                <p class="text-gray-500 dark:text-gray-400 mb-2">{{ ucfirst(__('messages.description')) }}: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ $service->description }}</span>
                </p>
                <p class="text-gray-500 dark:text-gray-400 mb-2">{{ ucfirst(__('messages.type')) }}: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ \Illuminate\Support\Str::title(str_replace('_', ' ', $service->type)) }}
                    </span>
                </p>
                <p class="text-gray-500 dark:text-gray-400 mb-2">{{ ucfirst(__('messages.price')) }}: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ $service->price }}</span></p>
                <p class="text-gray-500 dark:text-gray-400 mb-2">{{ ucfirst(__('messages.additional_info')) }}: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ $service->additional_info }}</span>
                </p>
            </div>
        </div>
    </a>
</div>
