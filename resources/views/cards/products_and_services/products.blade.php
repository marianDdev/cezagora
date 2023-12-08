<div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
    <a href="{{ route('my.products.services') }}">
        <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" src="{{ $imagePath}}" />
        <div class="p-5">
                <div class="p-5">
                    @if($count === 0)
                        <h3 class="text-xl font-bold tracking-tight text-gray-500">
                            {{ ucfirst(__('messages.products')) }}
                        </h3>
                        <a href="#" class="text-indigo-500">{{ __('messages.add_first_products') }}</a>
                    @else
                        <a href="#">
                            <h3 class="text-xl font-bold tracking-tight text-indigo-500">
                                {{ ucfirst(__('messages.products')) }}
                            </h3>
                        </a>
                        <span class="text-gray-500 dark:text-gray-400">{{ __('messages.products_count', ['count' => $count]) }}</span>
                    @endif
                </div>
        </div>
    </a>
</div>
