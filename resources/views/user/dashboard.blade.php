<x-app-layout>
    <x-slot name="header">
        <!-- Header with updated purple gradient design -->
        <div class="flex justify-between items-center bg-gradient-to-r from-purple-700 to-purple-500 p-6 shadow-xl rounded-xl text-white">
            <h1 class="text-4xl font-bold tracking-wider">Dashboard</h1>
            <span class="text-xl font-light">{{ Auth::user()->name }}</span>
        </div>
    </x-slot>

    <div class="py-12 min-h-screen bg-gray-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <!-- Welcome Card -->
            <div class="bg-white rounded-xl shadow-md p-6 transform hover:scale-105 transition duration-500 ease-in-out">
                <h2 class="text-2xl font-bold text-gray-800">Welcome Back, {{ Auth::user()->name }}!</h2>
                <p class="text-lg text-gray-700 mt-2">Email: {{ Auth::user()->email }}</p>
                <p class="text-sm text-gray-500 mt-1">Account status: Active</p>
            </div>

            <!-- Stored Credentials Card -->
            <div class="bg-white rounded-xl shadow-md p-6 transform hover:scale-105 transition duration-500 ease-in-out">
                <h2 class="text-2xl font-bold text-gray-800">Stored Credentials</h2>
                <p class="text-xl font-semibold text-blue-800 mt-2">Credentials: {{ Auth::user()->credentials->count() }}</p>
                @forelse (Auth::user()->credentials as $credential)
                    <div class="flex justify-between items-center mt-4">
                        <span class="font-semibold text-gray-800">{{ $credential->name }}</span>
                        <div class="flex items-center">
                            <span class="text-gray-600 mr-2">{{ $credential->username }} - {{ str_repeat('*', strlen($credential->password)) }}</span>
                            <img src="{{ asset('images/icon8.png') }}" alt="Credential Icon" class="w-5 h-5">
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 mt-2">No credentials stored yet.</p>
                @endforelse
            </div>

            <!-- Family Information Card -->
            <div class="bg-white rounded-xl shadow-md p-6 transform hover:scale-105 transition duration-500 ease-in-out">
                <h2 class="text-2xl font-bold text-gray-800">Family Information</h2>
                @if(Auth::user()->familyInfo)
                    <p class="mt-2">Kin 1: <strong>{{ Auth::user()->familyInfo->kin_email_1 }}</strong> ({{ Auth::user()->familyInfo->relation_1 }})</p>
                    <p class="mt-1">Kin 2: <strong>{{ Auth::user()->familyInfo->kin_email_2 }}</strong> ({{ Auth::user()->familyInfo->relation_2 }})</p>
                    <p class="mt-1">Kin 3: <strong>{{ Auth::user()->familyInfo->kin_email_3 }}</strong> ({{ Auth::user()->familyInfo->relation_3 }})</p>
                    <p class="text-lg font-semibold {{ Auth::user()->familyInfo->verified ? 'text-green-500' : 'text-red-500' }} mt-2">
                        Status:
                        @if (Auth::user()->familyInfo->verified)
                        <span class="inline-flex items-center">
                            Verified
                            <img src="{{ asset('images/icon7.png') }}" alt="Verified Icon" class="ml-2 w-5 h-5">
                        </span>
                        @else
                            Not Verified
                        @endif
                    </p>
                @endif
            </div>

            <!-- Security Settings Card -->
            <div class="bg-white rounded-xl shadow-md p-6 transform hover:scale-105 transition duration-500 ease-in-out flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Security Settings</h2>
                    <p class="text-lg font-semibold text-gray-800 mt-2">{{ Auth::user()->google2fa_secret ? 'Multifactor Authentication is enabled' : 'Not enabled' }}</p>
                </div>
                <img src="{{ asset('images/icon4.png') }}" alt="Security Icon" class="w-20 h-20">
            </div>
        </div>
    </div>
</x-app-layout>
