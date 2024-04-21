<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-semibold leading-tight">
                Super Admin Dashboard
            </h2>
        </div>
    </x-slot>

    <div class="mt-6 p-6 bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <p class="text-xl font-semibold text-gray-800 dark:text-gray-200">Welcome, {{ auth()->user()->name }}! You are logged in as a Super Admin.</p>
        <p class="mt-2 text-gray-600 dark:text-gray-400">This is the Super Admin dashboard. Here you can manage high-level administrative functions and oversee all system settings and configurations.</p>
    </div>
</x-app-layout>
