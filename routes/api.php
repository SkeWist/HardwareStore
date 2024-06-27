<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Регистрация
Route::post('/reg', [\App\Http\Controllers\AuthController::class, 'regist']);
// Авторизация
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);

// Просмотр всех категорий
Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index']);

// Просмотр всех товаров
Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index']);
// Просмотр всех товаров по категории
Route::get('/products/category/{id}', [\App\Http\Controllers\ProductController::class, 'showByCategory']);

// Роуты для авторизированных пользователей
Route::middleware('auth:api')->group(function () {
    // Выход
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);

    // Профиль пользователя
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'profile']);
    // Редактирование профиля пользователя
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update']);
});

// Функционал админа
Route::middleware(['auth:api', 'role:admin'])->group(function () {
    // Просмотр всех ролей
    Route::get('/roles', [\App\Http\Controllers\RoleController::class, 'index']);
    // Добавление роли
    Route::post('/roles', [\App\Http\Controllers\RoleController::class, 'create']);
    // Редактирование роли
    Route::patch('/roles/{id}', [\App\Http\Controllers\RoleController::class, 'update']);
    // Удаление роли
    Route::delete('/roles/{id}', [\App\Http\Controllers\RoleController::class, 'destroy']);

    // Просмотр всех пользователей
    Route::get('/users', [\App\Http\Controllers\UserController::class, 'index']);
    // Просмотр пользователя
    Route::get('/users/{id}', [\App\Http\Controllers\UserController::class, 'show']);
    // Редактирование пользователя
    Route::patch('/users/{id}', [\App\Http\Controllers\UserController::class, 'update']);
    // Удаление пользователя
    Route::delete('/users/{id}', [\App\Http\Controllers\UserController::class, 'destroy']);

    // Добавление категории
    Route::post('/categories', [\App\Http\Controllers\CategoryController::class, 'create']);
    // Редактирование категории
    Route::patch('/categories/{id}', [\App\Http\Controllers\CategoryController::class, 'update']);
    // Удаление категории
    Route::delete('/categories/{id}', [\App\Http\Controllers\CategoryController::class, 'destroy']);

    // Добавление товара
    Route::post('/products', [\App\Http\Controllers\ProductController::class, 'create']);
    // Редактирование товара
    Route::patch('/products/{id}', [\App\Http\Controllers\ProductController::class, 'update']);
    // Удаление товара
    Route::delete('/products/{id}', [\App\Http\Controllers\ProductController::class, 'destroy']);
});
