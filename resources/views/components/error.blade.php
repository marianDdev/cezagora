@if ($errors->has($field))
    <div class="text-red-500">
        {{ $errors->first($field) }}
    </div>
@endif
