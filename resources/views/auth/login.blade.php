<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi Magang</title>
    <link rel="stylesheet" href="{{ asset('css/styles1.css') }}">
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>
        <form action="{{ route('login') }}" method="post">
            @csrf
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
            <a href="#forgot-password" class="link">Lupa Password?</a>
        </form>
    </div>

</body>
</html>
