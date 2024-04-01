<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-100 to-gray-200">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-200">
                <div class="p-6 bg-gradient-to-r from-purple-500 to-pink-500 text-white">
                    <h2 class="text-4xl font-extrabold mb-2">User Details</h2>
                    <p class="font-light text-lg">Explore the essentials of {{ $user->name }}</p>
                </div>
                <div class="p-8 text-gray-700">
                    <div class="grid md:grid-cols-2 gap-x-10 gap-y-6">
                        <!-- User Name -->
                        <div class="user-detail">
                            <h3 class="text-xl font-semibold mb-1">Name</h3>
                            <p class="text-lg">{{ $user->name }}</p>
                        </div>

                        <!-- User Email -->
                        <div class="user-detail">
                            <h3 class="text-xl font-semibold mb-1">Email</h3>
                            <p class="text-lg">{{ $user->email }}</p>
                        </div>

                        <!-- Additional details can be enhanced similarly -->
                    </div>

                    <div class="mt-10 flex justify-start gap-6">
                        <a href="{{ route('admin.users.index') }}" class="transition duration-150 ease-in-out transform hover:-translate-y-1 hover:scale-105 inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-full shadow-lg text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:border-indigo-800 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            ← User List
                        </a>

                        <a href="{{ route('admin.users.credentials.show', $user->id) }}" class="transition duration-150 ease-in-out transform hover:-translate-y-1 hover:scale-105 inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-full shadow-lg text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:border-green-800 focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Credentials →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
