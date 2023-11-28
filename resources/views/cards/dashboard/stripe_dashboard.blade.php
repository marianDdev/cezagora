<div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
    <a href="{{ route('ingredients') }}">
        <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" src="{{ $imagePath}}" />
    </a>
    <div class="p-5">
        <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
            <form method="POST" action="{{ route('create.stripe.portal.session') }}">
                @csrf
                <button type="submit">{{ __('messages.manage_billing') }}</button>
            </form>
        </h3>
    </div>
</div>
