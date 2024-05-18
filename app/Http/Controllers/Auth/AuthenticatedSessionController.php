<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\SendMfaCode;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Carbon\Carbon;
use PragmaRX\Google2FAQRCode\Google2FA;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     * Authenticate user and send initial MFA code via email.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $user = Auth::user();
        $mfaCode = rand(100000, 999999);
        $user->mfa_code = $mfaCode;
        $user->mfa_expires_at = Carbon::now()->addMinutes(10);
        $user->save();

        Mail::to($user->email)->send(new SendMfaCode($mfaCode));

        return redirect()->route('mfa.showVerify');
    }

    /**
     * Show the form for verifying MFA code via email.
     */
    public function showVerifyMfaForm(): View
    {
        return view('auth.verify-mfa');
    }

    /**
     * Verify the MFA code from email, then redirect to QR code setup/verification.
     */
    public function verifyMfaCode(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => 'required|numeric',
        ]);

        $user = Auth::user();

        if ($request->code == $user->mfa_code && now()->lessThan($user->mfa_expires_at)) {
            $user->mfa_code = null;
            $user->mfa_expires_at = null;
            $user->save();

            $request->session()->regenerate();

            // Direct to QR code setup/verification
            return redirect()->route('mfa.setup');
        }

        return back()->withErrors(['code' => 'The provided MFA code is invalid or has expired.']);
    }

    /**
     * Show QR code if not set up, or prompt for QR code verification if already set up.
     */
    public function showQrCode()
    {
        $user = Auth::user();
        $google2fa = new Google2FA();

        if (is_null($user->google2fa_secret)) {
            $user->google2fa_secret = $google2fa->generateSecretKey();
            $user->save();
        }

        $QR_Image = $google2fa->getQRCodeInline(
            config('app.name'),
            $user->email,
            $user->google2fa_secret
        );

        return view('auth.qr-code-display', ['QR_Image' => $QR_Image]);
    }

    /**
     * Verify the QR code TOTP.
     */
    public function verifyQrCode(Request $request)
    {
        $request->validate([
            'totp' => 'required|numeric',
        ]);

        $user = Auth::user();
        $google2fa = new Google2FA();
        $valid = $google2fa->verifyKey($user->google2fa_secret, $request->input('totp'));

        if ($valid) {
            $request->session()->regenerate();
            return redirect()->route('user.dashboard'); // Update to use user.dashboard route
        } else {
            return back()->withErrors(['totp' => 'Invalid TOTP. Please try again.']);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
