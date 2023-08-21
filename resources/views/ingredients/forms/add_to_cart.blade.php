@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('order-item.store') }}" method="post">
    @csrf
    <input id="customer_id" name="customer_id"
           value="{{ \Illuminate\Support\Facades\Auth::user()->company_id }}" type="hidden" />
    <input id="seller_id" name="seller_id" value="{{ $ingredient->company->id }}"
           type="hidden" />
    <input id="item_id" name="item_id" value="{{ $ingredient->ingredient->id }}"
           type="hidden" />
    <input id="item_type" name="item_type" value="ingredient" type="hidden" />
    <input id="price" name="price" value="{{ $ingredient->price }}" type="hidden" />

    <select name="quantity"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option value="" selected>Choose quantity</option>
        @foreach(range(1, $ingredient->quantity) as $quantity)
            <option value="{{ $quantity }}">{{ $quantity }}</option>
        @endforeach
    </select>

    <input id="name" name="name" value="{{ $ingredient->ingredient->name }}" type="hidden" />
    <div
        class="mt-4 col-start-1 row-start-3 self-center sm:mt-0 sm:col-start-2 sm:row-start-2 sm:row-span-2 lg:mt-6 lg:col-start-1 lg:row-start-3 lg:row-end-4">
        <button type="submit"
                class="bg-indigo-600 text-white text-sm leading-6 font-medium py-2 px-3 rounded-lg">Add to cart
        </button>
    </div>
</form>
