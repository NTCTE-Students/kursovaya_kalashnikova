<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Themes</title>
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
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        
        body {
            background: linear-gradient(-45deg, #f5f7fa, #e4e8f0, #d8e1e8, #c3d0d9);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-bottom: 50px;
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
            margin: 2rem 0 3rem;
            font-size: 2.5rem;
            animation: fadeIn 0.8s ease-out;
        }
        
        .tema::after {
            content: '';
            position: absolute;
            width: 100px;
            height: 4px;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(90deg, #4a90e2, #8e44ad);
            border-radius: 2px;
            transition: all 0.4s ease;
        }
        
        .tema:hover::after {
            width: 150px;
            height: 5px;
        }
        
        .create-theme-btn {
            display: block;
            width: fit-content;
            margin: 0 auto 3rem;
            padding: 12px 30px;
            background: linear-gradient(45deg, #4a90e2, #8e44ad);
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 5px 15px rgba(74, 144, 226, 0.3);
            animation: float 4s ease-in-out infinite;
        }
        
        .create-theme-btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 10px 25px rgba(74, 144, 226, 0.4);
            animation: pulse 1.5s infinite, float 4s ease-in-out infinite;
        }
        
        .post {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2.5rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            animation: fadeIn 0.6s ease-out forwards;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            position: relative;
            overflow: hidden;
        }
        
        .post::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 0;
            background: linear-gradient(to bottom, #4a90e2, #8e44ad);
            transition: height 0.4s ease;
        }
        
        .post:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }
        
        .post:hover::before {
            height: 100%;
        }
        
        .post h3 {
            color: #2d3748;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
            position: relative;
            display: inline-block;
        }
        
        .post h3::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: #4a90e2;
            transition: width 0.3s ease;
        }
        
        .post:hover h3::after {
            width: 100%;
        }
        
        .post a {
            display: inline-block;
            padding: 10px 20px;
            background: linear-gradient(45deg, #4a90e2, #8e44ad);
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 4px 10px rgba(74, 144, 226, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .post a:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(74, 144, 226, 0.4);
            animation: pulse 1.5s infinite;
        }
        
        .post a::before {
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
        
        .post a:hover::before {
            opacity: 1;
            left: 100%;
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
            <a href="{{ route('register') }}">Зарегистрироваться</a>
            @endauth
        </div>
    </div>
    
    <h1 class="tema">Темы</h1>
    
    @auth
        <a href="{{ route('themes.create') }}" class="create-theme-btn">Создать новую тему</a>
    @endauth

    @foreach ($themes as $theme)
        <div class="post">
            <h3>{{ $theme->title }}</h3>
            <a href="{{ route('themes.show', $theme->id) }}">Читать подробнее</a>
        </div>
    @endforeach
</body>
</html>