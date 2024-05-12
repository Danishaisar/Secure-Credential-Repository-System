<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-gradient-to-r from-purple-500 to-purple-800 p-6 shadow-xl text-white rounded-lg">
            <h1 class="text-3xl font-bold">{{ __('Create New Credential') }}</h1>
            <div class="flex justify-end">
                <a href="{{ route('credentials.index') }}" class="bg-white hover:bg-gray-100 text-purple-600 font-bold py-2 px-4 rounded-full shadow transition-transform transform hover:scale-110 duration-300">
                    &larr; Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="container mx-auto p-8">
        <div class="max-w-4xl mx-auto bg-white rounded-lg overflow-hidden shadow-lg">
            <form action="{{ route('credentials.store') }}" method="POST">
                @csrf

                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Service Information -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-medium text-gray-900">Service Information</h3>
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" rows="3" class="form-textarea mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50"></textarea>
                            </div>
                        </div>

                        <!-- Account Details -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-medium text-gray-900">Account Details</h3>
                            <div>
                                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                                <input type="text" name="username" id="username" value="{{ old('username') }}" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <input type="password" name="password" id="password" value="{{ old('password') }}" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="px-4 py-4 bg-gray-100 text-right rounded-b-lg">
                    <button type="submit" class="bg-white hover:bg-gray-100 text-purple-600 font-bold py-2 px-4 rounded-full shadow transition-transform transform hover:scale-110 duration-300">
                        Create Credential
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
