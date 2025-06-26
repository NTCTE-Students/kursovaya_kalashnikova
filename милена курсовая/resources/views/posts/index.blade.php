<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Posts</title>
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
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            padding: 1rem 2rem;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .header a {
            margin: 0 10px;
            color: #4a5568;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .header a:hover {
            color: #2d3748;
        }
        
        .tema {
            text-align: center;
            color: #2d3748;
            margin: 2rem 0;
        }
        
        .post {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.6s ease-out;
        }
        
        .post:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }
        
        .post .title {
            color: #2d3748;
            margin-bottom: 1rem;
        }
        
        .post .title small {
            color: #718096;
            font-size: 0.9rem;
        }
        
        .post p {
            color: #4a5568;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }
        
        .post a {
            display: inline-block;
            padding: 8px 16px;
            background-color: #4a90e2;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        
        .post a:hover {
            background-color: #3b7bc9;
            transform: translateY(-2px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        a[href="{{ route('posts.create') }}"] {
            display: block;
            width: fit-content;
            margin: 0 auto 2rem;
            padding: 10px 20px;
            background-color: #4a90e2;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        
        a[href="{{ route('posts.create') }}"]:hover {
            background-color: #3b7bc9;
            transform: translateY(-2px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            animation: pulse 1.5s infinite;
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
    
    <h1 class="tema">Посты</h1>
    
    @auth
        <a href="{{ route('posts.create') }}">Создать новый пост</a>
    @endauth

    @foreach($posts as $post)
    <div class="post">
        <h3 class="title">{{ $post->title }} <br><small>Автор: {{ $post->user->name }}</small></h3>
        <p>{{ Str::limit($post->content, 200) }}</p>
        <a href="{{ route('posts.show', $post) }}">Читать далее</a>
    </div>
    @endforeach
</body>
</html>