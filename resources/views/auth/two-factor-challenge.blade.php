{{-- resources/views/auth/two-factor-challenge.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two Factor Challenge</title>
</head>
<body>
    <div>
        <h1>Two-Factor Challenge</h1>
        @if (session('status'))
            <div>{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ url('/two-factor-challenge') }}">
            @csrf
            <div>
                <label for="code">Code</label>
                <input id="code" type="text" name="code" autofocus>
            </div>
            <div>
                <button type="submit">Log in</button>
            </div>
        </form>
    </div>
</body>
</html>
