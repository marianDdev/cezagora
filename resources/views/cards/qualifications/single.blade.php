<div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
    <a href="{{ route('my.products.services') }}">
        <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg"
             src="{{ $qualification->getFirstMediaUrl('packagings') ?? 'https://t4.ftcdn.net/jpg/03/21/80/19/240_F_321801983_nc5GX5xGwaXxn5W6d9edJQOq3XVmochS.jpg'}}" />
        <div class="p-5">
            <div class="p-5">
                <a href="#">
                    <h3 class="text-xl font-bold ">
                        {{ ucfirst(__('messages.company')) }}: <span
                            class="text-indigo-500">{{ $qualification->company->name }}</span>
                    </h3>
                </a>
                <p class="text-gray-500 dark:text-gray-400 mb-2">Name: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ $qualification->name }}</span>
                </p>
                <p class="text-gray-500 dark:text-gray-400 mb-2">Issuer: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ $qualification->issuer }}</span>
                </p>
                <p class="text-gray-500 dark:text-gray-400 mb-2">Type: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ $qualification->type }}</span>
                </p>
                <p class="text-gray-500 dark:text-gray-400 mb-2">Number: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ $qualification->certificate_number }}</span>
                </p>
                <p class="text-gray-500 dark:text-gray-400 mb-2">Scope: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ $qualification->scope }}</span>
                </p>
                <p class="text-gray-500 dark:text-gray-400 mb-2">URL: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ $qualification->url }}</span>
                </p>
                <p class="text-gray-500 dark:text-gray-400 mb-2">Verification link: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ $qualification->verification_link }}</span>
                </p>
                <p class="text-gray-500 dark:text-gray-400 mb-2">Additional info: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ $qualification->additional_info }}</span>
                </p>
                <p class="text-gray-500 dark:text-gray-400 mb-2">Issue date: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ \Carbon\Carbon::parse($qualification->issued_at)->format('Y-m-d') }}</span>
                </p>
                <p class="text-gray-500 dark:text-gray-400 mb-2">Expiration date: <span
                        class="text-gray-500 dark:text-gray-400 font-bold">{{ $qualification->expire_at ? \Carbon\Carbon::parse($qualification->expire_at)->format('Y-m-d') : ''}}</span>
                </p>
            </div>
        </div>
    </a>
</div>
