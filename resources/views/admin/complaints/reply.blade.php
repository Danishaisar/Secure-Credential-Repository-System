<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-gradient-to-r from-blue-500 via-green-500 to-teal-500 p-6 shadow-xl text-white rounded-lg">
            <h1 class="text-4xl font-extrabold tracking-tight">Reply to Complaint</h1>
        </div>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden p-6">
            <form method="POST" action="{{ route('admin.complaints.reply', $complaint->id) }}">
                @csrf

                <!-- Ticket Number -->
                <div class="mb-4">
                    <x-form.label for="ticket_number" :value="__('Ticket Number')" />
                    <x-form.input id="ticket_number" class="block mt-1 w-full" type="text" name="ticket_number" :value="$complaint->ticket_number" readonly />
                </div>

                <!-- Message -->
                <div class="mb-4">
                    <x-form.label for="message" :value="__('Message')" />
                    <x-form.input id="message" class="block mt-1 w-full" type="text" name="message" :value="$complaint->message" readonly />
                </div>

                <!-- Reply -->
                <div class="mb-4">
                    <x-form.label for="reply" :value="__('Reply')" />
                    <x-form.textarea id="reply" class="block mt-1 w-full" name="reply" required>{{ old('reply') }}</x-form.textarea>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full shadow transition-transform transform hover:scale-110 duration-300">
                        {{ __('Send Reply') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
