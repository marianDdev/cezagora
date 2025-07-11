@if(is_null($company))
    <div class="items-center bg-gray-200 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
        <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg"
             src="https://cezagora.fra1.cdn.digitaloceanspaces.com/dashboard/qualifications.jpeg" alt="qualifications" />
        <div class="p-5">
            <span class="text-gray-500 dark:text-gray-400">{{ __('messages.no_qualifications') }}</span>
            <span
                class="text-gray-500 dark:text-gray-400"></span>
        </div>
        @include('qualifications.forms.create')
    </div>
@else
    <div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
        <a href="{{ route('my-qualifications') }}">
            <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg"
                 src="https://cezagora.fra1.cdn.digitaloceanspaces.com/dashboard/qualifications.jpeg" alt="qualifications" />
        </a>
        <div class="p-5">
            <h3 class="text-xl font-bold tracking-tight text-indigo-500">
                <a href="{{ route('my-qualifications') }}">{{ $title }}</a>
            </h3>
            @if($qualificationsCount === 0)
                <span class="text-gray-500 dark:text-gray-400">{{ __('messages.no_qualifications') }}</span>
            @else
                <span
                    class="text-gray-500 dark:text-gray-400">{{ __('messages.qualifications_count', ['count' => $qualificationsCount]) }}</span>
                <span
                    class="text-gray-500 dark:text-gray-400"></span>
            @endif
            @include('qualifications.forms.create')
        </div>
    </div>
@endif
