<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use Illuminate\Database\Seeder;
use function Laravel\Prompts\password;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   //РОЛИ
        $admin = Role::create (['name' => 'Админ', 'code' => 'admin'])->id;
        $manager = Role::create (['name' => 'Менеджер', 'code' => 'manager'])->id;
        $user = Role::create (['name' => 'Пользователь', 'code' => 'user'])->id;
        $guest = Role::create (['name' => 'Гость', 'code' => 'quest'])->id;
        //ПОЛЬЗОВАТЕЛИ
        $denis = \App\Models\User::create ([ 'name' => 'Анимеl', 'surname' => 'Денискаl', 'phone' => 89991112231, 'password' => 'zxczxc123', 'role_id' => $admin]);
        $vsevolod = \App\Models\User::create ([ 'name' => 'Дмитрий','surname' => 'Всеволод', 'phone' => 89991112232, 'password' => 'zxczxc321', 'role_id' => $user]);
        $janka = \App\Models\User::create ([ 'name' => 'Жанка','surname' => 'Плющева', 'phone' => 89991112233, 'password' => '123123', 'role_id' => $user]);
        $aleksei = \App\Models\User::create ([ 'name' => 'Алексей','surname' => 'Калымченко', 'phone' => 89991112234, 'password' => '321321', 'role_id' => $manager]);
        //КАТЕГОРИИ
        $vidio = Category::create (['id' => 1, 'name' => 'Видеокарты']);
        $cpu = Category::create (['id' => 2, 'name' => 'Процессоры']);
        $kuler = Category::create (['id' => 3, 'name' => 'Кулеры']);
        //ПРОДУКТЫ
        $viduxa1 = Product::create (['name' => 'Видеокарта AEROCOOL', 'description' => 'Ну крутая, холодная всегда', 'cost' => 39000, 'photo' => '', 'category_id' => $vidio->id]);
        $viduxa2 = Product::create (['name' => 'Видеокарта KSAS', 'description' => 'Бомбическая карта за свои деньги', 'cost' => 1000, 'photo' => '', 'category_id' => $vidio->id]);
    }
}
