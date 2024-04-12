<x-guest-layout>
    <x-auth-card>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="mb-4 flex justify-center">
            <div>
                {!! $QR_Image !!}
            </div>
        </div>

        <div class="mt-4 text-center">
            <p>{{ __('Scan the QR Code above with your authentication app and then enter the code it generates in the verification form.') }}</p>
            <!-- Form for verification -->
            <form method="GET" action="{{ route('mfa.verifyQrCodeForm') }}">
                @csrf
                <x-button>
                    {{ __('Verify QR Code') }}
                </x-button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
