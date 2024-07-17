<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-gradient-to-r from-purple-500 to-purple-800 p-6 shadow-xl text-white rounded-lg">
            <h1 class="text-3xl font-bold">{{ __('Upload New Document') }}</h1>
            <div class="flex justify-end">
                <a href="{{ route('documents.index') }}" class="bg-white hover:bg-gray-100 text-purple-600 font-bold py-2 px-4 rounded-full shadow transition-transform transform hover:scale-110 duration-300">
                    &larr; Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="container mx-auto p-8">
        <div class="max-w-4xl mx-auto bg-white rounded-lg overflow-hidden shadow-lg">
            <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="p-8">
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Document Information -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-medium text-gray-900">Document Information</h3>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Document Type</label>
                                <select name="type" id="type" class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50">
                                    <option value="wasiat">Wasiat</option>
                                    <option value="hibah">Hibah</option>
                                    <option value="waqf">Waqf</option>
                                </select>
                            </div>
                            <div>
                                <label for="document" class="block text-sm font-medium text-gray-700">Upload Document</label>
                                <input type="file" name="document" id="document" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="px-4 py-4 bg-gray-100 text-right rounded-b-lg">
                    <button type="submit" class="bg-white hover:bg-gray-100 text-purple-600 font-bold py-2 px-4 rounded-full shadow transition-transform transform hover:scale-110 duration-300">
                        Upload Document
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
