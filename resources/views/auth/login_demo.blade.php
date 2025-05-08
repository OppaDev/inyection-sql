<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Demo</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; min-height: 90vh; background-color: #f4f4f4; }
        .container { background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 300px; }
        label { display: block; margin-bottom: 5px; }
        input[type="email"], input[type="password"], button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }
        button { background-color: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        .alert { padding: 10px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 4px; margin-bottom: 15px; }
        .checkbox-container { margin-bottom: 15px; display: flex; align-items: center; }
        .checkbox-container input { margin-right: 8px; width: auto; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login Demo</h2>

        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
            <div class="alert">
                {{ session('error') }}
            </div>
        @endif


        <form method="POST" action="{{ route('login.demo.submit') }}">
            @csrf

            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
            </div>

            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="checkbox-container">
                <input type="checkbox" name="secure_mode" id="secure_mode" value="1" checked>
                <label for="secure_mode">Modo Seguro</label>
            </div>

            <div>
                <button type="submit">
                    Login
                </button>
            </div>
        </form>
         @if(auth()->check())
            <form method="POST" action="{{ route('logout.demo') }}" style="margin-top: 10px;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @endif
    </div>
</body>
</html>