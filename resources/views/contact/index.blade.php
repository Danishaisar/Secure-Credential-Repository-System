<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <x-slot name="header">
        <div class="flex justify-between items-center bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 p-6 shadow-xl text-white rounded-lg">
            <h1 class="text-4xl font-extrabold tracking-tight">Contact Us</h1>
        </div>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <!-- Contact Form -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden p-6">
            @if(session('success'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <x-form.label for="name" :value="__('Name')" />
                    <x-form.input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <x-form.label for="email" :value="__('Email')" />
                    <x-form.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                </div>

                <!-- Message -->
                <div class="mb-4">
                    <x-form.label for="message" :value="__('Message')" />
                    <x-form.textarea id="message" class="block mt-1 w-full" name="message" required>{{ old('message') }}</x-form.textarea>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full shadow transition-transform transform hover:scale-110 duration-300">
                        {{ __('Send Message') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
