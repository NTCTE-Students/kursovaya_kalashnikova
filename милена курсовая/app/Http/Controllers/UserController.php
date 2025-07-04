<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function register(Request $request): RedirectResponse
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Create a new user instance
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash the password
            // 'role' => $request->role,
        ]);

        return redirect() -> route('index');
    }

    /**
     * Выполняет вход пользователя в систему.
     *
     * @param \Illuminate\Http\Request $request HTTP-запрос, содержащий данные для входа.
     *
     * @return \Illuminate\Http\RedirectResponse Редирект на главную страницу при успешном входе
     * либо возврат на предыдущую страницу при неудачной попытке.
     *
     * @throws \Illuminate\Validation\ValidationException Если данные запроса не проходят валидацию.
     */
    public function login(Request $request): RedirectResponse
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()
                -> route('index');
        }

        return redirect() -> back();
    }

    /**
     * Завершает сеанс аутентификации пользователя и перенаправляет на главную страницу.
     *
     * @return \Illuminate\Http\RedirectResponse Ответ с перенаправлением на маршрут 'index'.
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()
            -> route('index');
    }
}
