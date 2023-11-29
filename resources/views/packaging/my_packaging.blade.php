<x-guest-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 text-center">
            <h1 class="max-w-2xl mb-4 text-2xl font-extrabold tracking-tight leading-none md:text-3xl xl:text-4xl">

                {{ __('messages.your_packaging_list') }}
            </h1>
            <a class="mb-4 font-bold tracking-tight leading-none text-indigo-500"
               href="{{ route('packaging.create') }}">{{ __('messages.add_more_packaging') }}</a>
        </div>
    </section>

    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($packagings as $packaging)
                    @include('cards.packaging.single', ['packaging' => $packaging])
                @endforeach
            </div>
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
                {{ $packagings->links() }}
            </div>
        </div>
    </section>
</x-guest-layout>
