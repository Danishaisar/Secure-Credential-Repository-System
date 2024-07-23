<x-app-layout>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <x-slot name="header">
        <div class="flex justify-between items-center bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 p-6 shadow-xl text-white rounded-lg">
            <h1 class="text-4xl font-extrabold tracking-tight">Documents Dashboard</h1>
            <div class="flex justify-end">
                <a href="{{ route('documents.create') }}" class="bg-white hover:bg-gray-100 text-purple-600 font-bold py-2 px-4 rounded-full shadow transition-transform transform hover:scale-110 duration-300">
                    Add New Document
                </a>
            </div>
        </div>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <!-- Search Form -->
        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-3xl font-bold text-gray-800">Manage Your Documents</h2>
            <form action="{{ route('documents.index') }}" method="GET" class="flex items-center space-x-2">
                <div class="relative">
                    <input type="text" name="search" placeholder="Search documents..." class="form-input mt-1 block w-full pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:border-light-purple-500 focus:ring focus:ring-light-purple-500 focus:ring-opacity-50 transition duration-150 ease-in-out" value="{{ old('search', $search ?? '') }}">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-search text-gray-400"></i>
                    </span>
                </div>
                <button type="submit" class="bg-white hover:bg-gray-100 text-purple-600 font-bold py-2 px-4 rounded-full shadow transition-transform transform hover:scale-110 duration-300">
                    Search
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($documents as $document)
                <div class="bg-white rounded-xl shadow-md p-6 transform hover:scale-105 transition duration-500 ease-in-out" style="box-shadow: 4px 4px 10px #b8b8b8, -4px -4px 10px #ffffff;">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ ucfirst($document->type) }}</h3>
                    <div class="flex justify-between items-center mt-4">
                        <a href="{{ Storage::url($document->document_path) }}" target="_blank" class="text-blue-500 hover:text-blue-700">
                            View Document
                        </a>
                        <form action="{{ route('documents.destroy', $document) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
