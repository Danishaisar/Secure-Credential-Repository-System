<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-700 to-purple-800">
                Credential Details
            </h1>
        </div>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-xl shadow-xl hover:shadow-2xl transition duration-500 ease-in-out">
            <div class="p-6">
                <div class="bg-white p-4 rounded-lg shadow mb-4">
                    <h3 class="text-xl font-bold text-indigo-600">Name:</h3>
                    <p class="text-lg font-medium text-gray-800">{{ $credential->name }}</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow mb-4">
                    <h3 class="text-xl font-bold text-indigo-600">Username:</h3>
                    <p class="text-lg font-medium text-gray-800">{{ $credential->username }}</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow mb-4">
                    <h3 class="text-xl font-bold text-indigo-600">Password:</h3>
                    <p class="text-lg font-medium text-gray-800">[Password is secured]</p>
                    <div class="flex space-x-2">
                        <form id="encryption-form" action="{{ route('credentials.encrypt', $credential) }}" method="POST">
                            @csrf
                            <button type="button" class="mt-2 inline-flex items-center justify-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-md transition duration-300" onclick="showLoadingSpinner()">
                                Verify Encryption
                            </button>
                        </form>
                    </div>
                    <div id="password-strength" class="mt-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password Strength</label>
                        <div id="strength-result" class="mt-2">
                            <p><strong>Strength:</strong> {{ $strength['score'] >= 3 ? 'Strong' : ($strength['score'] >= 2 ? 'Fair' : 'Weak') }}</p>
                            <p><strong>Suggestions:</strong> {{ implode(' ', $strength['feedback']['suggestions']) }}</p>
                        </div>
                    </div>
                </div>
                
                @if($status)
                <div class="bg-yellow-100 p-4 rounded-lg shadow mb-4">
                    <h3 class="text-xl font-bold text-yellow-600">Status</h3>
                    <p class="text-lg font-medium text-yellow-800">{{ $status }}</p>
                </div>
                @endif

                @if($suggestedPassword)
                <div class="bg-green-100 p-4 rounded-lg shadow mb-4">
                    <h3 class="text-xl font-bold text-green-600">Suggested Strong Password</h3>
                    <p class="text-lg font-medium text-green-800">{{ $suggestedPassword }}</p>
                </div>
                @endif
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

    <!-- Loading Spinner Modal -->
    <div id="loading-spinner" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex justify-center">
                    <svg class="animate-spin h-5 w-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                </div>
                <div class="mt-4 text-center">
                    <p class="text-lg font-medium text-gray-700">Verifying Encryption...</p>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-4 mt-4">
                    <div id="progress-bar" class="bg-blue-500 h-4 rounded-full" style="width: 0%;"></div>
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

    <script src="https://cdn.jsdelivr.net/npm/zxcvbn@4.4.2/dist/zxcvbn.js"></script>
    <script>
        function openModal() {
            document.getElementById('modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }

        function showLoadingSpinner() {
            document.getElementById('loading-spinner').classList.remove('hidden');
            
            var progressBar = document.getElementById('progress-bar');
            var width = 0;
            var interval = setInterval(function() {
                if (width >= 100) {
                    clearInterval(interval);
                    document.getElementById('encryption-form').submit();
                } else {
                    width++;
                    progressBar.style.width = width + '%';
                }
            }, 10); // Adjust the interval time as needed
        }

        @if(session('encryptedPassword') && session('decryptedPassword'))
            openModal();
        @endif

        document.getElementById('password').addEventListener('input', function() {
            var password = this.value;
            var result = zxcvbn(password);
            var strengthResult = document.getElementById('strength-result');

            var score = result.score;
            var feedback = result.feedback.suggestions.join(' ');

            var strengthText;
            switch (score) {
                case 0:
                    strengthText = 'Very Weak';
                    break;
                case 1:
                    strengthText = 'Weak';
                    break;
                case 2:
                    strengthText = 'Fair';
                    break;
                case 3:
                    strengthText = 'Good';
                    break;
                case 4:
                    strengthText = 'Strong';
                    break;
            }

            strengthResult.innerHTML = `
                <div class="mt-2">
                    <p><strong>Strength:</strong> ${strengthText}</p>
                    <p><strong>Suggestions:</strong> ${feedback}</p>
                </div>
            `;
        });
    </script>
</x-app-layout>
