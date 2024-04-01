<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-2xl font-bold leading-tight text-indigo-600">
                {{ __('Credential Details') }}
            </h2>
        </div>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition duration-500">
            <div class="p-6">
                <div class="flex items-center mb-6">
                    <h3 class="text-lg font-semibold text-black mr-2">Name:</h3>
                    <p class="text-sm text-gray-700">{{ $credential->name }}</p>
                </div>

                <div class="flex items-center mb-6">
                    <h3 class="text-lg font-semibold text-black mr-2">Username:</h3>
                    <p class="text-sm text-gray-700">{{ $credential->username }}</p>
                </div>

                <div class="flex items-center mb-6">
                    <h3 class="text-lg font-semibold text-black mr-2">Password:</h3>
                    <p class="text-sm text-gray-700">[Password is secured]</p>
                </div>
            </div>

            <div class="flex justify-between items-center bg-gray-100 px-6 py-4">
                <a href="{{ route('credentials.index') }}" class="text-indigo-600 hover:text-indigo-900 transition duration-300">
                    &larr; Back
                </a>
                <div>
                    <a href="{{ route('credentials.edit', $credential) }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition duration-300">
                        Edit
                    </a>
                    <form action="{{ route('credentials.destroy', $credential) }}" method="POST" class="inline ml-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-300">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
