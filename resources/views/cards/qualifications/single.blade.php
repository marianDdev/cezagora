<div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
    <a href="{{ route('my.products.services') }}">
        <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg"
             src="{{ $qualification->getFirstMediaUrl('packagings') ?? 'https://t4.ftcdn.net/jpg/03/21/80/19/240_F_321801983_nc5GX5xGwaXxn5W6d9edJQOq3XVmochS.jpg'}}" />
        <div class="p-5">
            <div class="p-5">
                <a href="#">
                    <h3 class="text-xl font-bold ">
                        {{ ucfirst(__('messages.name')) }}: <span class="text-indigo-500">{{ $qualification->name }}</span>
                    </h3>
                </a>
                <p class="text-gray-500 dark:text-gray-400 mb-2">Issuer: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ $qualification->issuer }}</span>
                </p>
            </div>
        </div>
    </a>
</div>
