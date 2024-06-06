<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <!-- Container -->
    <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-white">Death Certificates</h1>
        </div>

        <!-- Death Certificates Table -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Submitted Death Certificates</h3>
                <div class="mt-2 max-w-xl text-sm text-gray-500 dark:text-gray-400">
                    <p>Review and verify death certificates submitted by close kin.</p>
                </div>

                <div class="mt-5">
                    <ul class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-md">
                        @forelse ($deathCertificates as $certificate)
                            <li class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                        {{ $certificate->user_name }} - {{ $certificate->created_at->format('M d, Y') }}
                                    </div>
                                    <div class="ml-2 flex-shrink-0 flex">
                                        <p class="text-sm text-gray-600 dark:text-gray-400 overflow-hidden">{{ $certificate->close_kin_email }}</p>
                                    </div>
                                    <div class="ml-2 flex-shrink-0 flex">
                                        <a href="{{ Storage::url($certificate->path) }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline">View Certificate</a>
                                    </div>
                                    <div class="ml-2 flex-shrink-0 flex">
                                        <form action="{{ route('admin.deathCertificates.verify', $certificate->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Verify</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="px-4 py-4 sm:px-6">
                                <p class="text-sm text-gray-500 dark:text-gray-400">No death certificates available at the moment.</p>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
