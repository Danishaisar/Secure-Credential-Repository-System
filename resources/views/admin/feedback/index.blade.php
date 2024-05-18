<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <!-- Container -->
    <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-white">User Feedback</h1>
        </div>

        <!-- Feedback Table -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Feedback from Users</h3>
                <div class="mt-2 max-w-xl text-sm text-gray-500 dark:text-gray-400">
                    <p>Review and manage feedback submitted by users.</p>
                </div>

                <div class="mt-5">
                    <ul class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-md">
                        @forelse ($feedbacks as $feedback)
                            <li class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                        {{ $feedback->user->name }} - {{ $feedback->created_at->format('M d, Y') }}
                                    </div>
                                    <div class="ml-2 flex-shrink-0 flex">
                                        <p class="text-sm text-gray-600 dark:text-gray-400 overflow-hidden">{{ $feedback->feedback }}</p>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="px-4 py-4 sm:px-6">
                                <p class="text-sm text-gray-500 dark:text-gray-400">No feedback available at the moment.</p>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
