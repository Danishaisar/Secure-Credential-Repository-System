<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <!-- Container -->
    <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-white">{{ __("User Management") }}</h1>
            <a href="{{ route('admin.users.create') }}" class="flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 focus:ring-purple-500 focus:ring-offset-2 focus:outline-none focus:ring-2 transition duration-150 ease-in-out text-white font-semibold rounded-md shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Add User
            </a>
        </div>

        <!-- Active Users Table -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Active Users</h3>
                <div class="mt-2 max-w-xl text-sm text-gray-500 dark:text-gray-400">
                    <p>Manage your application's active users.</p>
                </div>

                <div class="mt-5">
                    <ul class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-md">
                        @foreach ($users as $user)
                        <li class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $user->name }}</p>
                                <div class="ml-2 flex-shrink-0 flex">
                                    <a href="{{ route('admin.users.show', $user) }}" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">View</a>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="ml-4">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                                    </form>
                                    <form action="{{ route('admin.users.deceased', $user) }}" method="POST" class="ml-4">
                                        @csrf
                                        <button type="submit" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Mark as Deceased
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Deceased Users Table -->
        <div class="bg-white dark:bg-gray-800 mt-8 overflow-hidden shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Deceased Users</h3>
                <div class="mt-2 max-w-xl text-sm text-gray-500 dark:text-gray-400">
                    <p>View users marked as deceased.</p>
                </div>

                <div class="mt-5">
                    <ul class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-md">
                        @foreach ($deceasedUsers as $deceasedUser)
                        <li class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $deceasedUser->name }}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
