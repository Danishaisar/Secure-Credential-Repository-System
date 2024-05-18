<x-guest-layout>
    <x-auth-card>
        
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('mfa.verify') }}">
            @csrf

            <div class="space-y-6">
                <!-- MFA Code Input -->
                <div class="space-y-2">
                    <x-form.label for="code" :value="__('MFA Code')" class="text-lg font-semibold text-center" />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-key aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="code"
                            class="block w-full text-lg"
                            type="text"
                            name="code"
                            :value="old('code')"
                            required
                            autofocus
                            placeholder="{{ __('Enter MFA Code') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <!-- Buttons -->
                <div class="flex justify-between space-x-4">
                    <x-button class="w-1/3 justify-center gap-2 bg-purple-600 hover:bg-purple-700 text-white">
                        <x-heroicon-o-lock-closed class="w-6 h-6" aria-hidden="true" />
                        <span>{{ __('Verify Code') }}</span>
                    </x-button>

                    <!-- Back Button -->
                    <x-button
                        class="w-1/3 justify-center gap-2 bg-gray-300 hover:bg-gray-400 text-gray-800"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    >
                        <x-heroicon-o-arrow-left class="w-6 h-6" aria-hidden="true" />
                        <span>{{ __('Back') }}</span>
                    </x-button>
                </div>
            </div>
        </form>

        <!-- Logout Form -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </x-auth-card>
</x-guest-layout>
