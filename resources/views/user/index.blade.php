<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <!-- Container -->
    <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-white">{{ __("User Management") }}</h1>
            <a href="{{ route('admin.users.create') }}">
                <button type="submit" class="bg-white hover:bg-gray-100 text-purple-600 font-bold py-2 px-4 rounded-full shadow transition-transform transform hover:scale-110 duration-300">
                    Add User
                </button>
            </a>
        </div>

        <!-- Search Form -->
        <form method="GET" action="{{ route('admin.users.index') }}" class="mb-6">
            <div class="flex items-center">
                <input type="text" name="search" placeholder="Search users..." value="{{ request()->query('search') }}" class="form-input rounded-md shadow-sm mt-1 block w-full">
                <button type="submit" class="bg-white hover:bg-gray-100 text-purple-600 font-bold py-2 px-4 rounded-full shadow transition-transform transform hover:scale-110 duration-300 ml-4">
                    Search
                </button>
            </div>
        </form>

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
