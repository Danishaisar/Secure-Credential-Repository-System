<x-app-layout>
    <x-slot name="header">
        <!-- Dynamic header with vibrant gradient -->
        <div class="flex justify-between items-center bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 p-6 shadow-xl text-white rounded-lg">
            <h1 class="text-4xl font-extrabold tracking-tight">Credentials Dashboard</h1>
            <div class="flex justify-end">
                <a href="{{ route('credentials.create') }}" class="bg-white hover:bg-gray-100 text-purple-600 font-bold py-2 px-4 rounded-full shadow transition-transform transform hover:scale-110 duration-300">
                    Add New Credential
                </a>
            </div>
        </div>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Manage Your Credentials</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach ($credentials as $credential)
                <!-- Credential display as a service card -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $credential->name }}</h3>
                        <p class="text-md text-gray-600">Username: {{ $credential->username }}</p>
                        <div class="flex justify-between items-center mt-4">
                            <a href="{{ route('credentials.show', $credential) }}" class="text-blue-500 hover:text-blue-700">
                                View
                            </a>
                            <a href="{{ route('credentials.edit', $credential) }}" class="text-yellow-500 hover:text-yellow-700">
                                Edit
                            </a>
                            <form action="{{ route('credentials.destroy', $credential) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
