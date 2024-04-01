<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-semibold leading-tight">
                Dashboard
            </h2>
            <!-- <a href="https://github.com/kamona-wd/kui-laravel-breeze" target="_blank"
                class="flex items-center space-x-2 px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5l7 7-7 7" />
                </svg>
                <span>Star on Github</span>
            </a> -->
        </div>
    </x-slot>

    <div class="mt-6 p-6 bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <p class="text-xl font-semibold text-gray-800 dark:text-gray-200">Welcome, {{ auth()->user()->name }}!</p>
        <p class="mt-2 text-gray-600 dark:text-gray-400">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus blandit, turpis nec malesuada laoreet, nisi nisi tempor purus, vel feugiat sapien quam id turpis.</p>
    </div>
</x-app-layout>
