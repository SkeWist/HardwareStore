<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Создание товара
    public function create(ProductCreateRequest $request) {
        $product = Product::create($request->all());
        return response()->json($product)->setStatusCode(201);
    }

    // Просмотр всех товаров
    public function index() {
        $products = Product::all();
        return response()->json($products)->setStatusCode(200, 'Успешно');
    }

    // Просмотр всех товаров по категории
    public function showByCategory($id){
        $products = Product::where('category_id', $id)->get();

        return response(Product::collection($products));
    }

    // Редактирование товара
    public function update(ProductUpdateRequest $request, $id) {
        $product = Product::find($id);

        if (!$product) {
            return response()->json('Товар не найден')->setStatusCode(404, 'Not found');
        }

        $product->update($request->all());
        return response()->json($product)->setStatusCode(200, 'Изменено');
    }

    // Удаление товара
    public function destroy($id) {
        $product = Product::find($id);

        if (!$product) {
            return response()->json('Товар не найден')->setStatusCode(404, 'Not found');
        }

        Product::destroy($id);
        return response()->json('Товар удалён')->setStatusCode(200, 'Удалено');
    }
}
