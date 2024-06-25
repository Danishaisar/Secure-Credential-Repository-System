<x-app-layout>
    <x-slot name="header">
        <!-- Enhanced gradient header with sophisticated typography -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-700 to-purple-800">
                Credential Details
            </h1>
        </div>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-xl shadow-xl hover:shadow-2xl transition duration-500 ease-in-out">
            <div class="p-6">
                <!-- Name detail in a separate card-like section -->
                <div class="bg-white p-4 rounded-lg shadow mb-4">
                    <h3 class="text-xl font-bold text-indigo-600">Name:</h3>
                    <p class="text-lg font-medium text-gray-800">{{ $credential->name }}</p>
                </div>

                <!-- Username detail in a separate card-like section -->
                <div class="bg-white p-4 rounded-lg shadow mb-4">
                    <h3 class="text-xl font-bold text-indigo-600">Username:</h3>
                    <p class="text-lg font-medium text-gray-800">{{ $credential->username }}</p>
                </div>

                <!-- Password detail in a separate card-like section with Encrypt and View Encrypted buttons -->
                <div class="bg-white p-4 rounded-lg shadow mb-4">
                    <h3 class="text-xl font-bold text-indigo-600">Password:</h3>
                    <p class="text-lg font-medium text-gray-800">[Password is secured]</p>
                    <div class="flex space-x-2">
                        <form action="{{ route('credentials.encrypt', $credential) }}" method="POST">
                            @csrf
                            <button type="submit" class="mt-2 inline-flex items-center justify-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-md transition duration-300">
                                Verify Encryption
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="bg-indigo-100 px-6 py-4 flex justify-between items-center rounded-b-xl">
                <a href="{{ route('credentials.index') }}" class="text-indigo-700 hover:text-indigo-900 transition duration-300">
                    &larr; Back to List
                </a>
                <div class="flex items-center">
                    <a href="{{ route('credentials.edit', $credential) }}" class="inline-flex items-center justify-center px-4 py-2 mr-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-md transition duration-300">
                        Edit
                    </a>
                    <form action="{{ route('credentials.destroy', $credential) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-md transition duration-300">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Encryption Details</h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-500"><strong>Encrypted Password:</strong> {{ session('encryptedPassword') }}</p>
                    <p class="text-sm text-gray-500 mt-2"><strong>Decrypted Password:</strong> {{ session('decryptedPassword') }}</p>
                </div>
            </div>
            <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }

        @if(session('encryptedPassword') && session('decryptedPassword'))
            openModal();
        @endif
    </script>
</x-app-layout>
