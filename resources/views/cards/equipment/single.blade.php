<div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
    <a href="{{ route('my.products.services') }}">
        <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg"
             src="{{ $equipment->getFirstMediaUrl('services') ?? 'https://t4.ftcdn.net/jpg/03/21/80/19/240_F_321801983_nc5GX5xGwaXxn5W6d9edJQOq3XVmochS.jpg'}}" />
        <div class="p-5">
            <div class="p-5">
                <a href="#">
                    <h3 class="text-xl font-bold ">
                        {{ ucfirst(__('messages.company')) }}: <span
                            class="text-indigo-500">{{ $equipment->company->name }}</span>
                    </h3>
                </a>
                <p class="text-gray-500 dark:text-gray-400 mb-2">{{ ucfirst(__('messages.name')) }}: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ $equipment->name }}</span>
                </p>
                <p class="text-gray-500 dark:text-gray-400 mb-2">{{ ucfirst(__('messages.description')) }}: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ $equipment->description }}</span>
                </p>
                <p class="text-gray-500 dark:text-gray-400 mb-2">{{ ucfirst(__('messages.type')) }}: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ \Illuminate\Support\Str::title(str_replace('_', ' ', $equipment->type)) }}
                    </span>
                </p>
                <p class="text-gray-500 dark:text-gray-400 mb-2">{{ ucfirst(__('messages.price')) }}: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ $equipment->price }}</span></p>
                <p class="text-gray-500 dark:text-gray-400 mb-2">{{ ucfirst(__('messages.additional_info')) }}: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ $equipment->additional_info }}</span>
                </p>
                <p class="text-gray-500 dark:text-gray-400 mb-2">{{ ucfirst(__('messages.availability')) }}: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ $equipment->availability }}</span>
                </p>
                <p class="text-gray-500 dark:text-gray-400 mb-2">{{ ucfirst(__('messages.available_at')) }}: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ \Carbon\Carbon::parse($equipment->available_at)->format('Y-m-d') }}</span>
                </p>
            </div>
        </div>
    </a>
</div>
