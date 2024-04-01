<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Credentials for ') . $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Credential Details</h3>
                    <div class="mt-5 overflow-hidden border-t border-gray-200">
                        <dl class="divide-y divide-gray-200">
                            @forelse ($credentials as $credential)
                                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        {{ $credential->name }}
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 flex items-center">
                                        <input type="password" readonly id="credential-{{ $credential->id }}" value="{{ $credential->description }}" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-black" style="transition: all 0.15s ease;">
                                        <button onclick="toggleVisibility({{ $credential->id }})" class="ml-4 px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                                            Show
                                        </button>
                                    </dd>
                                </div>
                            @empty
                                <div class="px-4 py-5 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        No credentials found.
                                    </dt>
                                </div>
                            @endforelse
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleVisibility(credentialId) {
            let credentialInput = document.getElementById('credential-' + credentialId);
            let button = credentialInput.nextElementSibling;
            
            if (credentialInput.type === "password") {
                credentialInput.type = "text";
                button.textContent = 'Hide';
            } else {
                credentialInput.type = "password";
                button.textContent = 'Show';
            }
        }
    </script>
</x-app-layout>
