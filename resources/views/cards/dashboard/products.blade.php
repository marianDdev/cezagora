<div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
    <a href="{{ route('my.products.services') }}">
        <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" src="{{ $imagePath}}" />
        <div class="p-5">
                <div class="p-5">
                    @if($count === 0)
                        <h3 class="text-xl font-bold tracking-tight text-gray-500">
                            Products
                        </h3>
                        <a href="#" class="text-indigo-500">Click here to add your first products</a>
                    @else
                        <a href="#">
                            <h3 class="text-xl font-bold tracking-tight text-indigo-500">
                                Products
                            </h3>
                        </a>
                        <span class="text-gray-500 dark:text-gray-400">You have {{ $count }} products</span>
                    @endif
                </div>
        </div>
    </a>
</div>
