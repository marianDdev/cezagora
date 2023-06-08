<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
        <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">{{ $user->getFullName() }}'s dashboard</h2>
            <p class="font-light text-gray-500 lg:mb-16 sm:text-xl dark:text-gray-400">Explore the whole collection of open-source web components and elements built with the utility classes from Tailwind</p>
        </div>
        <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
            @include('components.company-card',
                [
                    'name' => $company->name ?? null,
                    'imagePath' => 'https://picsum.photos/200',
                    'email' => $company->email ?? null,
                    'phone' => $company->phone ?? null,
                    'admin' => $user->getFullName(),
                    'description' => 'bla bla',
                ]
            )
            @include('components.card', ['name' => sprintf('My %s', $text), 'imagePath' => 'https://picsum.photos/200', 'count' => $business ? $business->count() : 0])
            @include('components.card', ['name' => 'My messages', 'imagePath' => 'https://picsum.photos/200', 'title' => "Manage your private nessages", 'description' => null])
        </div>
    </div>
</section>
</x-app-layout>
