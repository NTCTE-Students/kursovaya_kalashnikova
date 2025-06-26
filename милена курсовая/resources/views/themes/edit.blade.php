<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Edit Theme</title>
    <style>
        /* Анимации и эффекты */
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
        
        @keyframes floatBorder {
            0%, 100% { box-shadow: 0 0 0 0 rgba(74, 144, 226, 0.4); }
            50% { box-shadow: 0 0 0 10px rgba(74, 144, 226, 0); }
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
        
        .tema {
            text-align: center;
            color: #2d3748;
            position: relative;
            padding-bottom: 15px;
            margin: 2rem 0;
            font-size: 2.2rem;
            animation: fadeIn 0.8s ease-out;
        }
        
        .tema::after {
            content: '';
            position: absolute;
            width: 120px;
            height: 4px;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(90deg, #4a90e2, #8e44ad);
            border-radius: 2px;
            transition: all 0.4s ease;
        }
        
        .tema:hover::after {
            width: 180px;
            background: linear-gradient(90deg, #8e44ad, #4a90e2);
        }
        
        .post {
            max-width: 700px;
            margin: 2rem auto;
            padding: 2.5rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            animation: fadeIn 0.6s ease-out forwards;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .post:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }
        
        .post::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(to bottom, #4a90e2, #8e44ad);
            transition: all 0.4s ease;
        }
        
        .post:hover::before {
            background: linear-gradient(to bottom, #8e44ad, #4a90e2);
        }
        
        label {
            display: block;
            margin: 20px 0 8px;
            font-weight: 600;
            color: #4a5568;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }
        
        input[type="text"] {
            width: 100%;
            padding: 14px 18px;
            margin-bottom: 25px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            background: #f8fafc;
        }
        
        input[type="text"]:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 0 4px rgba(74, 144, 226, 0.2);
            outline: none;
            transform: translateY(-3px);
            background: white;
            animation: floatBorder 2s infinite;
        }
        
        input[type="submit"] {
            background: linear-gradient(45deg, #4a90e2, #8e44ad);
            color: white;
            border: none;
            padding: 14px 35px;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 5px 15px rgba(74, 144, 226, 0.3);
            display: block;
            margin: 40px auto 0;
            position: relative;
            overflow: hidden;
        }
        
        input[type="submit"]:hover {
            transform: translateY(-4px) scale(1.03);
            box-shadow: 0 8px 20px rgba(74, 144, 226, 0.4);
            animation: pulse 1.5s infinite;
            background: linear-gradient(45deg, #8e44ad, #4a90e2);
        }
        
        input[type="submit"]:active {
            transform: translateY(1px);
        }
        
        input[type="submit"]::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(45deg);
            transition: all 0.6s ease;
            opacity: 0;
        }
        
        input[type="submit"]:hover::before {
            opacity: 1;
            left: 100%;
        }
        
        .alert-danger {
            animation: shake 0.5s ease;
            background: #ffebee;
            border-left: 4px solid #f44336;
            padding: 15px;
            border-radius: 8px;
            margin: 20px auto;
            max-width: 700px;
            box-shadow: 0 3px 10px rgba(244, 67, 54, 0.1);
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }
    </style>
</head>
<body>
    <form action="{{ route('themes.update', $theme->id) }}" method="POST">
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
                <a href="{{ route('register') }}">Зарегистрироваться</a>
                @endauth
            </div>
        </div>
        
        <h1 class="tema">Редактирование темы</h1>
        
        <div class="post">
            @csrf
            @method('PUT')
            <div>
                <label for="title">Заголовок</label>
                <input type="text" id="title" name="title" value="{{ $theme->title }}" required>
            </div>
            <div>
                <label for="content">Описание</label>
                <input type="text" id="content" name="content" value="{{ $theme->content }}" required>
            </div>
            <input type="submit" value="Обновить тему">
        </div>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>