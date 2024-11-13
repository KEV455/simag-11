<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SiMagang</title>
    <link rel="stylesheet" href="{{ asset('css/styles1.css') }}">
</head>

<body>

    <div class="login-container">
        <img width="150" class="img-fluid" src="{{ asset('images/logo-title-poliwangi.png') }}" alt="">
        <h2>Selamat Datang ... 👋🏻</h2>
        <form action="{{ route('do.login') }}" method="post">
            @csrf

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="********" required>

            <button type="submit"><b>Login</b></button>
        </form>
    </div>

</body>

</html>
