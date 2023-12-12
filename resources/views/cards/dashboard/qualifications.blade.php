@if($qualificationsCount === 0)
    <div class="items-center bg-gray-200 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
        <a role="link" aria-disabled="true">
            <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" src="{{ $imagePath}}" />
        </a>
        <div class="p-5">
            <h3 class="text-xl font-bold tracking-tight text-gray-400">
                <a role="link" aria-disabled="true">{{ $title }}</a>
            </h3>
            <span class="text-gray-500 dark:text-gray-400">{{ __('messages.no_sales') }}</span>
            <span
                class="text-gray-500 dark:text-gray-400"></span>
        </div>
        @include('qualifications.forms.create')
    </div>
@else
    <div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
            <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" src="{{ $imagePath}}" />
        </a>
        <div class="p-5">
            <h3 class="text-xl font-bold tracking-tight text-indigo-500">
                <a href="{{ route('my-qualifications') }}">{{ $title }}</a>
            </h3>
            <span class="text-gray-500 dark:text-gray-400">{{ __('messages.sales_count', ['qualificationsCount' => $qualificationsCount]) }}</span>
            <span
                class="text-gray-500 dark:text-gray-400"></span>
        </div>
    </div>
@endif
