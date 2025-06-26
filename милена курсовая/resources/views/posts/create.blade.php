<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Create Post</title>
    <style>
        /* Основные анимации */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.03); }
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
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .header a {
            margin: 0 10px;
            padding: 8px 15px;
            text-decoration: none;
            color: #4a5568;
            font-weight: 500;
            border-radius: 20px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .header a::before {
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
        
        .header a:hover::before {
            width: 100%;
        }
        
        .post {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.8s ease-out forwards;
        }
        
        .tema {
            text-align: center;
            color: #2d3748;
            position: relative;
            padding-bottom: 10px;
            margin-bottom: 2rem;
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
        }
        
        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 12px 15px;
            margin: 8px 0 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }
        
        input[type="text"]:focus,
        textarea:focus,
        select:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.2);
            outline: none;
            transform: translateY(-2px);
        }
        
        textarea {
            min-height: 200px;
            resize: vertical;
        }
        
        select[multiple] {
            height: auto;
            min-height: 100px;
            background-image: none;
            padding: 10px;
        }
        
        select[multiple] option {
            padding: 8px 12px;
            margin: 4px 0;
            border-radius: 4px;
            transition: all 0.2s ease;
        }
        
        select[multiple] option:hover {
            background: #4a90e2;
            color: white;
        }
        
        input[type="submit"] {
            background: linear-gradient(45deg, #4a90e2, #8e44ad);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 30px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 4px 10px rgba(74, 144, 226, 0.3);
            display: block;
            margin: 30px auto 0;
            width: auto;
        }
        
        input[type="submit"]:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 6px 15px rgba(74, 144, 226, 0.4);
            animation: pulse 1.5s infinite;
        }
        
        input[type="submit"]:active {
            transform: translateY(1px);
        }
        
        .alert-danger {
            animation: shake 0.5s ease;
            background: #ffebee;
            border-left: 4px solid #f44336;
            padding: 15px;
            border-radius: 8px;
            margin: 20px auto;
            max-width: 800px;
            box-shadow: 0 3px 10px rgba(244, 67, 54, 0.1);
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }
        
        label {
            font-weight: 600;
            color: #4a5568;
            display: block;
            margin-top: 15px;
            transition: all 0.3s ease;
        }
        
        input:focus + label,
        textarea:focus + label,
        select:focus + label {
            color: #4a90e2;
        }
    </style>
</head>
<body>
    <form action="{{ route('posts.store') }}" method="POST">
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
    
    <div class="post">
        <h1 class="tema">Создать пост</h1>
        @csrf
        <div>
            <label for="title">Название</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="content">Содержание</label>
            <textarea id="content" name="content" required></textarea>
        </div>
        <div>
            <label for="themes">Темы:</label>
            <select name="themes[]" id="themes" multiple>
                @foreach ($themes as $theme)
                    <option value="{{ $theme->id }}">{{ $theme->title }}</option>
                @endforeach
            </select>
        </div>
        <input type="submit" value="Создать">
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