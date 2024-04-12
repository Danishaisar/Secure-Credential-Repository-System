<x-guest-layout>
    <x-auth-card>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('mfa.verifyQr') }}">
            @csrf

            <div class="grid gap-6">
                <!-- TOTP Code Input -->
                <div class="space-y-2">
                    <x-form.label for="totp" :value="__('TOTP Code')" />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-key aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="totp"
                            class="block w-full"
                            type="text"
                            name="totp"
                            required
                            autofocus
                            placeholder="{{ __('Enter the TOTP Code') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <!-- Submit Button -->
                <div>
                    <x-button class="justify-center w-full gap-2">
                        <x-heroicon-o-lock-closed class="w-6 h-6" aria-hidden="true" />
                        <span>{{ __('Verify Code') }}</span>
                    </x-button>
                </div>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
