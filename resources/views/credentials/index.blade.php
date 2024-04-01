<x-app-layout>
    <x-slot name="header">
        <!-- Placeholder for any header content -->
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-end mb-6">
            <a href="{{ route('credentials.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                Add New Credential
            </a>
        </div>

        <h3 class="text-3xl font-semibold text-gray-800 mb-4">Your Credentials</h3>

        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Username</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($credentials as $credential)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="font-medium">{{ $credential->name }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span>{{ $credential->username }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
    <div class="flex item-center justify-center">
        <a href="{{ route('credentials.show', $credential) }}" class="text-sm text-blue-500 hover:text-blue-700 mr-3">
            View
        </a>
        <a href="{{ route('credentials.edit', $credential) }}" class="text-sm text-yellow-500 hover:text-yellow-700 mr-3">
            Edit
        </a>
        <form action="{{ route('credentials.destroy', $credential) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-sm text-red-500 hover:text-red-700">
                Delete
            </button>
        </form>
    </div>
</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
