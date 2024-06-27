<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    // Регистрация
    public function regist(RegisterRequest $request) {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']); // Хэширование пароля

        User::create($data);

        return response()->json('Регистрация успешна')->setStatusCode(201);
    }

    // Авторизация
    public function login(LoginRequest $request) {
        $user = User::where('phone', $request->phone)
            ->where('password', $request->password)
            ->first();

        if (!$user) {
            throw new ApiException(401, 'Ошибка аутентификации');
        }

        // Создание токена
        $newToken = Hash::make(microtime(true) * 1000);
        $user->api_token = $newToken;
        $user->save();

        return response()->json([
            'data' => [
                'api_token' => $user->api_token,
                'name' => $user->name,
                'surname' => $user->surname,
                'phone' => $user->phone_number,
                'password' => $user->password,
                'role_id' => $user->role_id,
            ]
        ]);
    }
    // Выход
    public function logout(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            throw new ApiException(401, 'Пользователь не аутентифицирован');
        }

        $user->api_token = null;
        $user->save();

        return response()->json([
            'data' => [
                'message' => 'Вы вышли из системы',
            ]
        ])->setStatusCode(200);
    }
}
