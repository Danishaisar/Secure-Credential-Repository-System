<x-app-layout>
    <x-slot name="header">
        <!-- Dynamic header with vibrant gradient -->
        <div class="flex justify-between items-center bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 p-6 shadow-xl text-white rounded-lg">
            <h2 class="text-4xl font-extrabold tracking-tight">
                Manage Family Information
            </h2>
            <!-- Display verification status in the header, color changes based on verification status -->
            <span class="{{ $familyInfo->verified ? 'bg-green-500' : 'bg-red-500' }} text-white py-2 px-4 rounded-full">
                {{ $familyInfo->verified ? 'Your family is verified' : 'Your family is not verified' }}
            </span>
        </div>
    </x-slot>


    <div class="mt-8 p-8 bg-white rounded-lg shadow-xl dark:bg-dark-eval-1 {{ $familyInfo->verified ? 'border-green-500 border-2' : '' }}">
        <form method="POST" action="{{ route('user.family.update') }}" class="space-y-8">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Iteratively generate kin information sections -->
                @foreach (['1', '2', '3'] as $number)
                    <div class="border border-gray-200 p-4 rounded-lg {{ $familyInfo->verified ? 'bg-green-50' : '' }}">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ ordinal($number) }} Kin</h3>
                        <div>
                            <label for="kin_email_{{ $number }}" class="block font-medium text-sm text-gray-800">Email</label>
                            <input type="email" name="kin_email_{{ $number }}" id="kin_email_{{ $number }}" class="form-input rounded-md shadow-sm mt-2 block w-full"
                                   value="{{ old('kin_email_'.$number, $familyInfo->{'kin_email_'.$number}) }}"/>
                        </div>
                        <div class="mt-4">
                            <label for="relation_{{ $number }}" class="block font-medium text-sm text-gray-800">Relationship</label>
                            <input type="text" name="relation_{{ $number }}" id="relation_{{ $number }}" class="form-input rounded-md shadow-sm mt-2 block w-full"
                                   value="{{ old('relation_'.$number, $familyInfo->{'relation_'.$number}) }}"/>
                        </div>
                        <!-- Display verification message right below each kin information -->
                        @if($number == 3)
                            <div class="mt-4 text-lg {{ $familyInfo->verified ? 'text-green-600' : 'text-red-600' }}">
                                <i class="{{ $familyInfo->verified ? 'bi bi-check-circle-fill' : 'bi bi-x-circle-fill' }}"></i>
                                {{ $familyInfo->verified ? 'Family information verified.' : 'Family information not verified.' }}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Additional Information -->
            <div class="border border-gray-200 p-4 rounded-lg">
    <h3 class="text-xl font-semibold text-gray-800 mb-2">Additional Information</h3>
    <textarea name="additional_info" id="additional_info" rows="4"
              class="form-textarea rounded-md shadow-sm mt-2 block w-full"
              placeholder="Optional: Add any additional information here.">{{ old('additional_info', $familyInfo->additional_info) }}</textarea>
</div>


            <div class="flex justify-end mt-6">
                <x-button class="{{ $familyInfo->verified ? 'bg-green-500 hover:bg-green-600 focus:bg-green-600' : 'bg-blue-500 hover:bg-blue-600 focus:bg-blue-600' }} px-6 py-3 text-lg font-semibold text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Save Changes
                </x-button>
            </div>
        </form>
    </div>
</x-app-layout>
