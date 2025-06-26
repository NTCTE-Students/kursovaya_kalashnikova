<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>{{ $post->title }} | Просмотр поста</title>
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
        
        @keyframes slideIn {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
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
            margin: 3rem auto;
            padding: 3rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.8s ease-out forwards;
            position: relative;
            overflow: hidden;
        }
        
        .post::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(to bottom, #4a90e2, #8e44ad);
        }
        
        .post h2 {
            color: #2d3748;
            font-size: 2.2rem;
            margin-bottom: 1.5rem;
            position: relative;
            animation: slideIn 0.6s ease-out;
        }
        
        .post h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 100px;
            height: 3px;
            background: linear-gradient(90deg, #4a90e2, #8e44ad);
            border-radius: 2px;
        }
        
        .post p {
            color: #4a5568;
            line-height: 1.7;
            margin: 1.5rem 0;
            padding-left: 15px;
            border-left: 3px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        
        .post p:hover {
            border-left-color: #4a90e2;
            padding-left: 20px;
        }
        
        .post-actions {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px dashed #e2e8f0;
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .post-actions a {
            display: inline-block;
            padding: 10px 25px;
            background: linear-gradient(45deg, #4a90e2, #8e44ad);
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 4px 10px rgba(74, 144, 226, 0.3);
            position: relative;
            overflow: hidden;
            animation: fadeIn 0.8s ease-out;
        }
        
        .post-actions a:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(74, 144, 226, 0.4);
            animation: pulse 1.5s infinite;
        }
        
        .post-actions a::before {
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
        
        .post-actions a:hover::before {
            opacity: 1;
            left: 100%;
        }
        
        .post-actions button {
            padding: 10px 25px;
            background: linear-gradient(45deg, #ff4757, #ff6b81);
            color: white;
            border: none;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 4px 10px rgba(255, 71, 87, 0.3);
            position: relative;
            overflow: hidden;
            animation: fadeIn 0.8s ease-out;
        }
        
        .post-actions button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 71, 87, 0.4);
            animation: pulse 1.5s infinite;
        }
        
        .post-actions button::before {
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
        
        .post-actions button:hover::before {
            opacity: 1;
            left: 100%;
        }
        
        .meta-info {
            display: flex;
            gap: 20px;
            margin-top: 2rem;
            color: #718096;
            font-size: 0.9rem;
        }
        
        .meta-info span {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .meta-info span::before {
            content: '•';
            color: #4a90e2;
            font-weight: bold;
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
    
    <div class="post">
        <div>
            <h2>{{ $post->title }}</h2>
            <p><strong>Автор:</strong> {{ $post->user->name }}</p>
            <p>{{ $post->content }}</p>
            
            <div class="meta-info">
                <span>Создан: {{ $post->created_at->format('d.m.Y H:i') }}</span>
                <span>Обновлен: {{ $post->updated_at->format('d.m.Y H:i') }}</span>
            </div>
        </div>

        @auth
            @if (($post->user_id == Auth::user()->id))
                <div class="post-actions">
                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}">Редактировать</a>
                    <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Вы уверены, что хотите удалить этот пост?');">Удалить</button>
                    </form>
                </div>
            @endif
        @endauth
    </div>
</body>
</html>