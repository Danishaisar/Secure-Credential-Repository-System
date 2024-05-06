<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-gradient-to-r from-purple-800 to-indigo-700 p-4 shadow-md text-white">
            <h2 class="text-2xl font-semibold">User Dashboard</h2>
            <div>{{ Auth::user()->name }}</div>
        </div>
    </x-slot>

    <div class="bg-gray-100 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Welcome card -->
                <div class="col-span-1 md:col-span-3 bg-white rounded-lg shadow px-5 py-4">
                    <h3 class="text-xl font-bold text-gray-800">Welcome, {{ Auth::user()->name }}!</h3>
                    <p class="text-gray-600">Email: {{ Auth::user()->email }}</p>
                </div>

                <!-- Credentials card -->
                <div class="bg-white rounded-lg shadow px-5 py-4">
                    <h3 class="text-lg font-semibold text-indigo-600">Your Credentials</h3>
                    <div class="mt-2 text-sm text-gray-600 space-y-1">
                        @foreach (Auth::user()->credentials as $credential)
                        <p><strong>{{ $credential->name }}</strong>: {{ $credential->username }} - {{ str_repeat('*', strlen($credential->password)) }}</p>
                        @endforeach
                    </div>
                </div>

                <!-- Family Information card -->
                <div class="bg-white rounded-lg shadow px-5 py-4">
                    <h3 class="text-lg font-semibold text-indigo-600">Family Information</h3>
                    <div class="text-sm text-gray-600 mt-2">
                        <p>Kin 1: {{ Auth::user()->familyInfo->kin_email_1 }} ({{ Auth::user()->familyInfo->relation_1 }})</p>
                        <p>Kin 2: {{ Auth::user()->familyInfo->kin_email_2 }} ({{ Auth::user()->familyInfo->relation_2 }})</p>
                        <p>Kin 3: {{ Auth::user()->familyInfo->kin_email_3 }} ({{ Auth::user()->familyInfo->relation_3 }})</p>
                        <p>Additional Info: {{ Auth::user()->familyInfo->additional_info }}</p>
                    </div>
                </div>

                <!-- Security Settings card -->
                <div class="bg-white rounded-lg shadow px-5 py-4">
                    <h3 class="text-lg font-semibold text-indigo-600">Security Settings</h3>
                    <p class="text-sm text-gray-600">{{ Auth::user()->google2fa_secret ? '2FA is enabled' : '2FA is not enabled' }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
