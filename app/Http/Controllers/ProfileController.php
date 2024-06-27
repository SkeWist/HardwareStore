<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    // Профиль пользователя
    public function profile() {
        $user = auth()->user();

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'surname' => $user->surname,
            'phone' => $user->phone_number,
            'updated_at' => $user->updated_at,
            'created_at' => $user->created_at,
        ]);
    }

    // Редактирование профиля пользователя
    public function update(UserUpdateRequest $request) {
        $user = auth()->user();
        $user->update($request->all());

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'surname' => $user->surname,
            'phone' => $user->phone_number,
            // не рекомендуется возвращать пароль напрямую
            'updated_at' => $user->updated_at,
            'created_at' => $user->created_at,
        ])->setStatusCode(200, 'Изменено');
    }
}
