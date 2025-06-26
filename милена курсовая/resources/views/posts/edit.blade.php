<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Edit Post</title>
    <style>
        /* Анимации и эффекты */
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
            overflow: hidden;
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
        
        .post {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2.5rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            animation: fadeIn 0.6s ease-out forwards;
            transition: transform 0.3s ease;
        }
        
        .post:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }
        
        .tema {
            text-align: center;
            color: #2d3748;
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 2.5rem;
            font-size: 2.2rem;
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
            width: 150px;
            height: 5px;
        }
        
        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 14px 18px;
            margin: 10px 0 25px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
            background: #f8fafc;
        }
        
        input[type="text"]:focus,
        textarea:focus,
        select:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.2);
            outline: none;
            transform: translateY(-3px);
            background: white;
        }
        
        textarea {
            min-height: 250px;
            resize: vertical;
            line-height: 1.6;
        }
        
        select[multiple] {
            height: auto;
            min-height: 120px;
            background-image: none;
            padding: 10px;
        }
        
        select[multiple] option {
            padding: 10px 15px;
            margin: 5px 0;
            border-radius: 6px;
            transition: all 0.2s ease;
            background: #f1f5f9;
        }
        
        select[multiple] option:hover {
            background: linear-gradient(90deg, #4a90e2, #8e44ad);
            color: white;
            transform: translateX(5px);
        }
        
        select[multiple] option:checked {
            background: linear-gradient(90deg, #4a90e2, #8e44ad);
            color: white;
            font-weight: bold;
        }
        
        button[type="submit"] {
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
            width: auto;
            position: relative;
            overflow: hidden;
        }
        
        button[type="submit"]:hover {
            transform: translateY(-4px) scale(1.03);
            box-shadow: 0 8px 20px rgba(74, 144, 226, 0.4);
            animation: pulse 1.5s infinite, float 3s ease-in-out infinite;
        }
        
        button[type="submit"]:active {
            transform: translateY(1px);
        }
        
        button[type="submit"]::before {
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
        
        button[type="submit"]:hover::before {
            opacity: 1;
            left: 100%;
        }
        
        .alert-danger {
            animation: shake 0.5s ease;
            background: #ffebee;
            border-left: 4px solid #f44336;
            padding: 18px;
            border-radius: 10px;
            margin: 25px auto;
            max-width: 800px;
            box-shadow: 0 5px 15px rgba(244, 67, 54, 0.1);
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
            margin-top: 20px;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }
        
        input:focus + label,
        textarea:focus + label,
        select:focus + label {
            color: #4a90e2;
            transform: translateX(5px);
        }
    </style>
</head>
<body>
    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
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
            <h1 class="tema">Редактирование поста</h1>
            <div>
                <label for="title">Название</label>
                <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required>
            </div>
            <div>
                <label for="content">Содержание</label>
                <textarea id="content" name="content" required>{{ old('content', $post->content) }}</textarea>
            </div>
            <div>
                <label for="themes">Темы:</label>
                <select name="themes[]" id="themes" multiple>
                    @foreach ($themes as $theme)
                        <option value="{{ $theme->id }}" 
                            {{ in_array($theme->id, $post->themes->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $theme->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit">Обновить пост</button>
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