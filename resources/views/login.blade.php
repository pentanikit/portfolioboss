<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{ asset('raquibul-logo-favicon.png') }}">
  <style>
    body{font-family:system-ui,Arial;margin:0;display:grid;place-items:center;height:100vh;background:#0b0f15;color:#e5e7eb}
    .card{background:#111827;border:1px solid #1f2937;padding:24px;border-radius:14px;min-width:320px;max-width:380px}
    label{display:block;margin:8px 0 4px}
    input{width:100%;padding:10px;border-radius:10px;border:1px solid #1f2937;background:#0b0f15;color:#e5e7eb}
    button{width:100%;padding:12px;border:0;border-radius:12px;background:#22c55e;color:#031;cursor:pointer;margin-top:12px;font-weight:700}
    .err{background:#3b0d0d;color:#fca5a5;padding:10px;border-radius:8px;margin-bottom:10px;border:1px solid #7f1d1d}
    .status{background:#072; color:#bdf; padding:10px;border-radius:8px;margin-bottom:10px}
    .muted{color:#9aa3af;font-size:12px;margin-top:8px;text-align:center}
    .row{display:flex;align-items:center;gap:8px;margin-top:8px}
  </style>
</head>
<body>
  <form class="card" method="post" action="{{ route('auth') }}">
    @csrf
    <h2 style="margin:0 0 12px">Admin Login</h2>

    @if ($errors->any())
      <div class="err">{{ $errors->first() }}</div>
    @endif

    @if (session('status'))
      <div class="status">{{ session('status') }}</div>
    @endif

    <label for="email">Email</label>
    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus>

    <label for="password">Password</label>
    <input id="password" name="password" type="password" required>

    <div class="row">
      <input id="remember" name="remember" type="checkbox" value="1" style="width:auto">
      <label for="remember" style="margin:0">Remember me</label>
    </div>

    <button type="submit">Sign In</button>
    <div class="muted">Only authorized admin can access</div>
  </form>
</body>
</html>
