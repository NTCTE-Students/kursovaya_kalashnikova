<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Регистрация</title>
    <style>
        /* Анимации и стили */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        body {
            background: linear-gradient(-45deg, #f5f7fa, #e4e8f0, #d8e1e8, #c3d0d9);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            padding: 1rem 2rem;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(5px);
        }
        
        .header a {
            margin: 0 10px;
            padding: 8px 15px;
            text-decoration: none;
            color: #4a5568;
            font-weight: 600;
            border-radius: 20px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            position: relative;
        }
        
        .header a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #4a90e2, #8e44ad);
            transition: width 0.3s ease;
        }
        
        .header a:hover {
            color: #2d3748;
            transform: translateY(-2px);
        }
        
        .header a:hover::after {
            width: 100%;
        }
        
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 2rem;
        }
        
        .tema {
            text-align: center;
            color: #2d3748;
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 2rem;
            font-size: 2rem;
        }
        
        .tema::after {
            content: '';
            position: absolute;
            width: 80px;
            height: 4px;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(90deg, #4a90e2, #8e44ad);
            border-radius: 2px;
        }
        
        .auth {
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            animation: fadeIn 0.6s ease-out;
            width: 100%;
            max-width: 500px;
        }
        
        form div {
            margin-bottom: 1.5rem;
        }
        
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #4a5568;
        }
        
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.2);
            outline: none;
        }
        
        .button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(45deg, #4a90e2, #8e44ad);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(74, 144, 226, 0.3);
            animation: pulse 1.5s infinite;
        }
        
        .auth-links {
            text-align: center;
            margin-top: 1.5rem;
        }
        
        .auth-links a {
            color: #4a90e2;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .auth-links a:hover {
            color: #8e44ad;
            text-decoration: underline;
        }
        
        .alert-danger {
            margin-top: 1.5rem;
            padding: 1rem;
            background: #ffebee;
            border-left: 4px solid #f44336;
            border-radius: 8px;
            animation: fadeIn 0.5s ease;
        }
        
        .alert-danger ul {
            margin: 0;
            padding-left: 1.5rem;
        }
        
        .alert-danger li {
            color: #f44336;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <a href="{{ route('index') }}">На главную</a>
            <a href="{{ route('themes.index') }}">Темы</a>
        </div>
        <div>
            @auth
            <a href="{{ route('logout') }}">Выйти</a>
            @else
            <a href="{{ route('login') }}">Войти</a>
            <a href="{{ route('register') }}">Регистрация</a>
            @endauth
        </div>
    </div>

    <main>
        <h1 class="tema">Регистрация</h1>
        <div class="auth">
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div>
                    <label for="name">Имя пользователя</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div>
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div>
                    <label for="password">Пароль</label>
                    <input type="password" name="password" id="password" minlength="8" required>
                </div>
                <input type="submit" value="Зарегистрироваться" class="button">
            </form>
            
            <div class="auth-links">
                <a href="{{ route('login') }}">Уже есть аккаунт? Войти</a>
            </div>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </main>
</body>
</html>