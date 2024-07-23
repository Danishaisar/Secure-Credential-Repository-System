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
                <div class="bg-white rounded-xl shadow-md p-6 transform hover:scale-105 transition duration-500 ease-in-out" style="box-shadow: 4px 4px 10px #b8b8b8, -4px -4px 10px #ffffff;">
                    <h2 class="text-2xl font-bold text-gray-800">Welcome Back, {{ Auth::user()->name }}!</h2>
                    <p class="text-lg text-gray-700">Email: {{ Auth::user()->email }}</p>
                    <p class="text-sm text-gray-500 mt-2">Account status: Active</p>
                </div>

                <!-- Stored Credentials Card -->
                <div class="bg-white rounded-xl shadow-md p-6 transform hover:scale-105 transition duration-500 ease-in-out" style="box-shadow: 4px 4px 10px #b8b8b8, -4px -4px 10px #ffffff;">
                    <h2 class="text-2xl font-bold text-gray-800">Stored Credentials</h2>
                    <p class="text-xl font-semibold text-blue-800">Credentials: {{ Auth::user()->credentials->count() }}</p>
                    @forelse (Auth::user()->credentials as $credential)
                        <div class="flex justify-between items-center mt-4">
                            <span class="font-semibold text-gray-800">{{ $credential->name }}</span>
                            <div class="flex items-center">
                                <span class="text-gray-600 mr-2">{{ $credential->username }} - {{ str_repeat('*', strlen($credential->password)) }}</span>
                                <img src="{{ asset('images/icon8.png') }}" alt="Credential Icon" style="width: 20px; height: 20px;">
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">No credentials stored yet.</p>
                    @endforelse
                </div>

                <!-- Family Information Card -->
                <div class="bg-white rounded-xl shadow-md p-6 transform hover:scale-105 transition duration-500 ease-in-out" style="box-shadow: 4px 4px 10px #b8b8b8, -4px -4px 10px #ffffff;">
                    <h2 class="text-2xl font-bold text-gray-800">Family Information</h2>
                    @if(Auth::user()->familyInfo)
                        <p>Kin 1: <strong>{{ Auth::user()->familyInfo->kin_email_1 }}</strong> ({{ Auth::user()->familyInfo->relation_1 }})</p>
                        <p>Kin 2: <strong>{{ Auth::user()->familyInfo->kin_email_2 }}</strong> ({{ Auth::user()->familyInfo->relation_2 }})</p>
                        <p>Kin 3: <strong>{{ Auth::user()->familyInfo->kin_email_3 }}</strong> ({{ Auth::user()->familyInfo->relation_3 }})</p>
                        <p class="text-lg font-semibold {{ Auth::user()->familyInfo->verified ? 'text-green-500' : 'text-red-500' }}" style="display: flex; align-items: center;">
                            Status:
                            @if (Auth::user()->familyInfo->verified)
                            <span style="display: inline-flex; align-items: center; margin-left: 5px;">
                                Verified
                                <img src="{{ asset('images/icon7.png') }}" alt="Verified Icon" style="width: 20px; height: 20px; margin-left: 5px;">
                            </span>
                            @else
                                Not Verified
                            @endif
                        </p>
                    @endif
                </div>

                <!-- Security Settings Card -->
                <div class="bg-white rounded-xl shadow-md p-6 transform hover:scale-105 transition duration-500 ease-in-out flex justify-between items-center" style="box-shadow: 4px 4px 10px #b8b8b8, -4px -4px 10px #ffffff;">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Security Settings</h2>
                        <p class="text-lg font-semibold text-gray-800">{{ Auth::user()->google2fa_secret ? 'Multifactor Authentication is enabled' : 'Not enabled' }}</p>
                    </div>
                    <img src="{{ asset('images/icon4.png') }}" alt="Security Icon" style="width: 50px; height: 50px;">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
