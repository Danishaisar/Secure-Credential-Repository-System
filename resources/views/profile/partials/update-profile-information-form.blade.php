<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')

        <!-- Name Input -->
        <div class="space-y-2">
            <x-form.label for="name" :value="__('Name')" />
            <x-form.input id="name" name="name" type="text" class="block w-full"
                          :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-form.error :messages="$errors->get('name')" />
        </div>

        <!-- Email Input -->
        <div class="space-y-2">
            <x-form.label for="email" :value="__('Email')" />
            <x-form.input id="email" name="email" type="email" class="block w-full"
                          :value="old('email', $user->email)" required autocomplete="email" />
            <x-form.error :messages="$errors->get('email')" />

            <!-- Email Verification Notice -->
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-300">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:text-gray-400 dark:hover:text-gray-200 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>
                    @if (session('status') == 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to the email address you provided.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Close Kin Email Input -->
        <div class="space-y-2">
            <x-form.label for="close_kin_email" :value="__('Close Kin Email')" />
            <x-form.input id="close_kin_email" name="close_kin_email" type="email" class="block w-full"
                          :value="old('close_kin_email', auth()->user()->close_kin_email)" />
            <x-form.error :messages="$errors->get('close_kin_email')" />
        </div>

        <!-- Submit Button -->
        <div class="flex items-center gap-4">
            <x-button>{{ __('Save') }}</x-button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
