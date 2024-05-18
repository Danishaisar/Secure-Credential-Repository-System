<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <!-- Container -->
    <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-white">Audit Log Details</h1>
        </div>

        <!-- Audit Log Details -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Detailed Information</h3>
                <div class="mt-2 max-w-xl text-sm text-gray-500 dark:text-gray-400">
                    <p>Review the details of this audit log entry.</p>
                </div>

                <div class="mt-5">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-500 dark:text-gray-400">ID</th>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $auditLog->id }}</td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-500 dark:text-gray-400">User</th>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $auditLog->user ? $auditLog->user->name : 'System' }}</td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Action</th>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $auditLog->action }}</td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Details</th>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $auditLog->details }}</td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Timestamp</th>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $auditLog->created_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-5">
                    <a href="{{ route('admin.audit_logs.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Back to Audit Logs</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
