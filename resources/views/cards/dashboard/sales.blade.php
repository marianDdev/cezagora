<div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
    <a href="#">
        <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" src="{{ $imagePath}}" />
    </a>
    <div class="p-5">
        <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
            <a href="{{ route('sales') }}">{{ $title }}</a>
        </h3>
        <span class="text-gray-500 dark:text-gray-400">You have {{ $countSales }} sales</span>
        <span
            class="text-gray-500 dark:text-gray-400"></span>
    </div>
</div>
