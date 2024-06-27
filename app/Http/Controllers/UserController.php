<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Просмотр всех пользователей
    public function index()
    {
        $users = User::all()->map(function ($user) {
            return [
                'id' => $user->id,
                'surname' => $user->surname,
                'name' => $user->name,
                'phone' => $user->phone_number,
                'password' => $user->password, // Важно: обычно не следует возвращать пароль напрямую в JSON-ответе
                'updated_at' => $user->updated_at,
                'created_at' => $user->created_at,
            ];
        });

        return response()->json($users)->setStatusCode(200, 'Успешно');
    }

    // Просмотр пользователя
    public function show($id) {
        $user = User::find($id);

        if (!$user) {
            return response()->json('Пользователь не найден')->setStatusCode(404, 'Not found');
        }

        return response()->json($user)->setStatusCode(200, 'Успешно');
    }

    // Редактирование пользователя
    public function update(UserUpdateRequest $request, $id) {
        $user = User::find($id);

        if (!$user) {
            return response()->json('Пользователь не найден')->setStatusCode(404, 'Not found');
        }

        $user->update($request->all());
        return response()->json(($user))->setStatusCode(200, 'Изменено');
    }

    // Удаление пользователя
    public function destroy($id) {
        $user = User::find($id);

        if (!$user) {
            return response()->json('Пользователь не найден')->setStatusCode(404, 'Not found');
        }

        User::destroy($id);
        return response()->json('Пользователь удалён')->setStatusCode(200, 'Удалено');
    }
}
