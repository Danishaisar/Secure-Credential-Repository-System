<x-app-layout>
    <x-slot name="header">
        <!-- Dynamic header with vibrant gradient for System Overview -->
        <div class="flex justify-between items-center bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 p-6 shadow-xl text-white rounded-lg">
            <h1 class="text-4xl font-extrabold tracking-tight">System Overview</h1>
        </div>
    </x-slot>

    <!-- Container -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Session Message for Feedback Submission -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Introduction Card -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6 transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                <div class="p-6 bg-gray-100 border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Secure Credential Storage</h2>
                    <p class="text-gray-700">
                        Our system ensures your digital credentials are securely encrypted and stored. With state-of-the-art security, we safeguard your information from unauthorized access.
                    </p>
                </div>
            </div>

            <!-- MFA Card -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6 transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                <div class="p-6 bg-gray-100 border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Multifactor Authentication</h2>
                    <p class="text-gray-700">
                        To secure your account, our system implements two forms of Multifactor Authentication (MFA), each designed to ensure that access to your account is guarded against unauthorized users. Here’s how each works:
                    </p>
                    <ol class="list-decimal ml-8 mt-2 text-gray-700">
                        <li>
                            <strong>Email Verification:</strong> Upon certain critical actions or logins, a verification code is sent to your registered email address. You must enter this code to proceed, confirming your identity.
                        </li>
                        <li>
                            <strong>2FA with Authenticator Apps:</strong> For ongoing security, you must set up a two-factor authentication (2FA) app, such as Google Authenticator or another supported app. This app generates a temporary code that you need to enter along with your password when logging in or performing secure actions.
                        </li>
                    </ol>
                    <p class="text-gray-700 mt-4">
                        These measures significantly reduce the risk of unauthorized access and ensure that only you can access your account, even if someone knows your password.
                    </p>
                </div>
            </div>

            <!-- Notification Card -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6 transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                <div class="p-6 bg-gray-100 border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Close Kin Notification Process</h2>
                    <p class="text-gray-700">
                        Registered close kin will receive immediate notifications about credential updates, ensuring transparency and security in managing sensitive information.
                    </p>
                    <ul class="list-disc ml-8 text-gray-700">
                        <li>Instant alerts on credential registration and updates.</li>
                        <li>Continuous communication to keep kin informed.</li>
                    </ul>
                </div>
            </div>

            <!-- Deceased Transfer Card -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6 transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                <div class="p-6 bg-gray-100 border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Credential Transfer on Decease</h2>
                    <p class="text-gray-700">
                        Upon a user's decease, their credentials are securely transferred to the designated kin through a protected process, ensuring data integrity and privacy.
                    </p>
                </div>
            </div>

            <!-- Feedback Form Card -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-12 transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                <div class="p-6 bg-gray-100 border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Customer Feedback</h2>
                    <form action="{{ route('feedback.submit') }}" method="POST">
                        @csrf
                        <textarea name="feedback" class="form-textarea mt-1 block w-full rounded-md shadow-sm" rows="4" placeholder="Enter your feedback here..."></textarea>
                        <button type="submit" class="bg-white hover:bg-gray-100 text-purple-600 font-bold py-2 px-4 rounded-full shadow transition-transform transform hover:scale-110 duration-300">
                            Submit Feedback
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
