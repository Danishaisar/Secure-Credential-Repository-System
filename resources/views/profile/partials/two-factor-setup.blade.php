<div class="card">
    <div class="card-header">Two-Factor Authentication</div>
    <div class="card-body">
        @if(!empty($user->two_factor_secret))
            <p>Two-factor authentication is enabled.</p>
            <form method="POST" action="{{ url('user/two-factor-authentication/disable') }}">
                @csrf
                <button type="submit" class="btn btn-danger">Disable 2FA</button>
            </form>
        @else
            <p>Two-factor authentication is not enabled.</p>
            <form method="POST" action="{{ url('user/two-factor-authentication/enable') }}">
                @csrf
                <button type="submit" class="btn btn-primary">Enable 2FA</button>
            </form>
        @endif
    </div>
</div>
