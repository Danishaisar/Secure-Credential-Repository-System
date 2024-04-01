<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                User Credentials for {{ $user->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Credentials
                    </h3>
                    <div class="mt-4">
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                            @foreach ($credentials as $credential)
                                <div class="sm:col-span-1 flex justify-between bg-gray-100 rounded-lg p-4">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">
                                            {{ $credential->name }}
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            ********** <!-- Hidden password -->
                                        </dd>
                                    </div>
                                    @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.credentials.show', $credential->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white text-sm font-medium rounded-md">
                                       View
                                    </a>
                                    @endif
                                </div>
                            @endforeach
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
