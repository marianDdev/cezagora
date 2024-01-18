<x-app-layout>
    <section class="bg-gray-50">
        <div class="flex flex-col items-center justify-center mb-6 mt-6">
            <div
                class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Send membership invitations
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('membership_invitation.store') }}">
                        @csrf
                        <div>
                            <x-input-label for="email_company_pairs" :value="__('Email-Company pairs separated by comma. Eg: aa@gmail.com-company A,bb@gmail.com-company B')" />
                            <x-text-input id="email_company_pairs" type="text" name="email_company_pairs" :value="old('email_company_pairs')" autofocus autocomplete="email_company_pairs" placeholder="aa@gmail.com-company A,bb@gmail.com-company B" />
                            <x-input-error :messages="$errors->get('email_company_pairs')" class="mt-2" />
                        </div>
                        <x-primary-button class="ml-4">
                            {{ __('Send invitations') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </section>
        @if($invitations->count() === 0)
            <section class="bg-white dark:bg-gray-900">
                <div class="px-4 mx-auto max-w-screen-md">
                    <p class="mb-6 lg:mb-6 font-extrabold text-center text-red-500 dark:text-gray-400 sm:text-xl">No emails sent for the moment.</p>
                </div>
            </section>
        @else
        <section class="bg-white dark:bg-gray-900">
            <div class="mx-auto max-w-screen-md">
                <p class="font-extrabold text-center text-gray-500 dark:text-gray-400 sm:text-xl">Membership invitations emails history.</p>
            </div>
        </section>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-3/4 mx-auto text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Company
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invitations as $invitation)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">
                                    {{ $invitation->receiver_name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $invitation->receiver_email }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($invitation->created_at)->format('Y-m-d H:i:s') }}
                                </td>
                            </tr>
                        @endforeach
                            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
                                {{ $invitations->links() }}
                            </div>
                    </tbody>
                </table>
            </div>
        @endif
</x-app-layout>
