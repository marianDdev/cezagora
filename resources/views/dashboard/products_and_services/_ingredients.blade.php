@if(is_null($user->company) || ($user->stripe_account_enabled == false))
    <div class="items-center bg-gray-200 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
        <a role="link" aria-disabled="true">
            <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" src="{{ url('/images/homepage/raw_materials.png') }}" />
        </a>
        <div class="p-5">
            <a role="link" aria-disabled="true">
                <h3 class="text-xl font-bold tracking-tight text-gray-400">
                    {{__('messages.ingredients')}}
                </h3>
            </a>
            <span
                class="text-gray-500 dark:text-gray-400">{{ __('messages.create_company_before_add_ingredients') }}</span>
        </div>
    </div>
@else
    <div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
        <a href="{{ route('my-ingredients') }}">
            <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" src="{{ url('/images/homepage/raw_materials.png') }}" />
        </a>
        <div class="p-5">
            @if($count === 0)
                <h3 class="text-xl font-bold tracking-tight text-gray-500">
                    {{ ucfirst(__('messages.ingredients')) }}
                </h3>
                <a href="{{ route('ingredient.create') }}"
                   class="text-indigo-500">{{ __('messages.add_first_ingredients') }}</a>
            @else
                <a href="{{ route('my-ingredients') }}">
                    <h3 class="text-xl font-bold tracking-tight text-indigo-500">
                        {{ ucfirst(__('messages.ingredients')) }}
                    </h3>
                </a>
                <span
                    class="text-gray-500 dark:text-gray-400">{{ __('messages.ingredients_count', ['count' => $count]) }}</span>
            @endif
        </div>
    </div>
@endif
