<x-app-layout>
    <x-slot name="header">
        <!-- Header with updated purple gradient design -->
        <div class="flex justify-between items-center bg-gradient-to-r from-purple-700 to-purple-500 p-6 shadow-xl rounded-xl text-white" style="background: linear-gradient(145deg, #6a1b9a, #9c27b0);">
            <h1 class="text-4xl font-bold tracking-wider" style="color: #FFFFFF; text-shadow: 2px 2px 8px rgba(0,0,0,0.2);">User Agreement</h1>
            <span class="text-xl font-light" style="color: #FFFFFF;">{{ Auth::user()->name }}</span>
        </div>
    </x-slot>

    <div class="bg-gradient-to-b from-gray-200 to-gray-300 py-12 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-1 gap-12">
                <!-- Card for User Agreement -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-500 ease-in-out" style="box-shadow: 11px 11px 22px #b8b8b8, -11px -11px 22px #ffffff;">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-gray-800">Agreement Video and Close Kin Selection</h2>
                        <form action="{{ route('user.agreement.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Video Upload -->
                            <div class="mb-4">
                                <label for="agreement_video" class="block text-sm font-medium text-gray-700">Upload Agreement Video</label>
                                <input type="file" name="agreement_video" id="agreement_video" class="mt-1 block w-full">
                                @error('agreement_video')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Close Kin Selection -->
                            <div class="mb-4">
                                <label for="selected_kin" class="block text-sm font-medium text-gray-700">Select Close Kin</label>
                                <div class="mt-1">
                                    @foreach(Auth::user()->familyInfo->only(['kin_email_1', 'kin_email_2', 'kin_email_3']) as $key => $email)
                                        @if($email)
                                            <div>
                                                <input type="checkbox" name="selected_kin[]" value="{{ $email }}"> {{ $email }}
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                @error('selected_kin')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Submit Button -->
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
                        </form>
                    </div>
                </div>

                <!-- Display Uploaded Video if Exists -->
                @if (Auth::user()->agreement_video)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-500 ease-in-out mt-6" style="box-shadow: 11px 11px 22px #b8b8b8, -11px -11px 22px #ffffff;">
                        <div class="p-6">
                            <h2 class="text-2xl font-bold text-gray-800">Uploaded Agreement Video</h2>
                            <div class="video-container mt-4">
                                <video controls>
                                    <source src="{{ asset('storage/' . Auth::user()->agreement_video) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .video-container {
        text-align: center;
    }

    .video-container video {
        width: 100%;
        max-width: 300px; /* Set a smaller maximum width */
        height: auto;
        border-radius: 8px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        display: block;
        margin: 0 auto; /* Center the video */
    }
</style>
