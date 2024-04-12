<x-guest-layout>
    <x-auth-card>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('mfa.verify') }}">
            @csrf

            <div class="grid gap-6">
                <!-- MFA Code Input -->
                <div class="space-y-2">
                    <x-form.label for="code" :value="__('MFA Code')" />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-key aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="code"
                            class="block w-full"
                            type="text"
                            name="code"
                            :value="old('code')"
                            required
                            autofocus
                            placeholder="{{ __('Enter MFA Code') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

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
