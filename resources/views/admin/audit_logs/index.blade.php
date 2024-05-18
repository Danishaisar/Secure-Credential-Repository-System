<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <!-- Container -->
    <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-white">Audit Logs</h1>
        </div>

        <!-- Audit Logs Table -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Audit Log Entries</h3>
                <div class="mt-2 max-w-xl text-sm text-gray-500 dark:text-gray-400">
                    <p>Review and manage audit logs for user activities.</p>
                </div>

                <div class="mt-5">
                    <ul class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-md">
                        @forelse ($auditLogs as $auditLog)
                            <li class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                        {{ $auditLog->user ? $auditLog->user->name : 'System' }} - {{ $auditLog->created_at->format('M d, Y') }}
                                    </div>
                                    <div class="ml-2 flex-shrink-0 flex">
                                        <p class="text-sm text-gray-600 dark:text-gray-400 overflow-hidden">{{ $auditLog->action }}</p>
                                    </div>
                                    <div class="ml-2 flex-shrink-0 flex">
                                        <a href="{{ route('admin.audit_logs.show', $auditLog->id) }}" class="text-blue-600 dark:text-blue-400 hover:underline">View Details</a>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="px-4 py-4 sm:px-6">
                                <p class="text-sm text-gray-500 dark:text-gray-400">No audit logs available at the moment.</p>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
