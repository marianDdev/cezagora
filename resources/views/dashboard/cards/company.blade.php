<div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
    <a href="#">
        <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" src="{{ $imagePath}}" />
    </a>
    <div class="p-5">
        @if(!is_null($company))
            @include('companies.forms.edit')
        @else
            @include('companies.forms.create')
        @endif
    </div>
</div>
