<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Email notifications</h2>
            </div>
            <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-3">
                <div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
                    <a href="{{ route('campaigns.index') }}">
                        <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg"
                             src="https://t3.ftcdn.net/jpg/01/95/33/72/240_F_195337230_UUKn0IMdNVUJ13GK2aTffAwOLU7BHtTc.jpg"
                             alt="Membership invitation emails image" />
                        <div class="p-5">
                            <div class="p-5">
                                <a href="{{ route('membership_invitation.create') }}">
                                    <h3 class="text-xl font-bold tracking-tight text-indigo-500">
                                        Membership invitation emails
                                    </h3>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
