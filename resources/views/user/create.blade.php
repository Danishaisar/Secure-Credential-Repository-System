<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Add New User</h2>
                        <div class="border-t border-gray-300"></div>
                    </div>

                    <!-- User Creation Form -->
                    <form method="POST" action="{{ route('admin.users.store') }}" class="w-full max-w-lg">
                        @csrf

                        <!-- Name Input -->
                        <div class="mb-6">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
                                Name:
                            </label>
                            <input type="text" name="name" id="name" required autofocus autocomplete="name"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <!-- Email Input -->
                        <div class="mb-6">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                                Email:
                            </label>
                            <input type="email" name="email" id="email" required
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <!-- Password Input -->
                        <div class="mb-6">
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">
                                Password:
                            </label>
                            <input type="password" name="password" id="password" required
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-between">
                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Add User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
