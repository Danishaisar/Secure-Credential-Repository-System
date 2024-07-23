<x-app-layout>
    <x-slot name="header">
        <!-- Header with updated purple gradient design -->
        <div class="flex justify-between items-center bg-gradient-to-r from-purple-700 to-purple-500 p-6 shadow-xl rounded-xl text-white" style="background: linear-gradient(145deg, #6a1b9a, #9c27b0);">
            <h1 class="text-4xl font-bold tracking-wider" style="color: #FFFFFF; text-shadow: 2px 2px 8px rgba(0,0,0,0.2);">Dashboard</h1>
            <span class="text-xl font-light" style="color: #FFFFFF;">{{ Auth::user()->name }}</span>
        </div>
    </x-slot>

    <div class="bg-gradient-to-b from-gray-200 to-gray-300 py-12 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Welcome Card -->
                <div class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition duration-500 ease-in-out flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Welcome Back, {{ Auth::user()->name }}!</h2>
                        <p class="text-lg text-gray-700">Email: {{ Auth::user()->email }}</p>
                        <p class="text-sm text-gray-500 mt-2">Account status: Active</p>
                    </div>
                    <div class="flex-shrink-0">
                        <img src="{{ asset('images/administration.png') }}" alt="Logo" class="w-16 h-16">
                    </div>
                </div>

                <!-- Active Users Card -->
                <div class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition duration-500 ease-in-out flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Active Users</h2>
                        <p class="text-2xl font-semibold text-blue-800">{{ $users->count() }}</p>
                    </div>
                    <div class="flex-shrink-0">
                        <img src="{{ asset('images/user.png') }}" alt="Logo" class="w-16 h-16">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mt-12">
                <!-- Deceased Users Card -->
                <div class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition duration-500 ease-in-out flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Deceased Users</h2>
                        <p class="text-2xl font-semibold text-blue-800">{{ $deceasedUsers->count() }}</p>
                    </div>
                    <div class="flex-shrink-0">
                        <img src="{{ asset('images/obituary.png') }}" alt="Logo" class="w-16 h-16">
                    </div>
                </div>

                <!-- Pending Death Certificates Card -->
                <div class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition duration-500 ease-in-out flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Pending Death Certificates</h2>
                        <p class="text-2xl font-semibold text-blue-800">{{ $pendingDeathCertificatesCount }}</p>
                    </div>
                    <div class="flex-shrink-0">
                        <img src="{{ asset('images/document.png') }}" alt="Logo" class="w-16 h-16">
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="flex justify-center mt-12">
                <div class="bg-white rounded-xl shadow-lg p-6 w-full lg:w-1/2 transform hover:scale-105 transition duration-500 ease-in-out">
                    <h2 class="text-2xl font-bold text-gray-800">Recent Activities</h2>
                    <ul class="mt-4">
                        @forelse ($recentActivities->take(3) as $activity)
                            <li class="py-2 border-b border-gray-200">
                                <div class="flex justify-between">
                                    <div class="text-gray-800">{{ $activity->action }}</div>
                                    <div class="text-sm text-gray-600">{{ $activity->created_at->diffForHumans() }}</div>
                                </div>
                                <p class="text-gray-600">{{ $activity->details }}</p>
                            </li>
                        @empty
                            <li class="py-2 text-gray-600">No recent activities.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
