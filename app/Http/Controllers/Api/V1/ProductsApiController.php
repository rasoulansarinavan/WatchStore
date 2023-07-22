<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ProductRepository;
use App\Http\services\kes;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductsApiController extends Controller
{
    public function most_sold_products()
    {
        return response()->json([
            'result' => true,
            'message' => 'application home page',
            'data' => [
                kes::categories => Category::getAllCategories(),
                kes::most_seller_products => ProductRepository::getMostSellerProducts()->response()->getDate(true),
            ]
        ], 200);
    }

    public function most_viewed_products()
    {
        return response()->json([
            'result' => true,
            'message' => 'application home page',
            'data' => [
                kes::categories => Category::getAllCategories(),
                kes::most_viewed_products => ProductRepository::getMostViewedProducts()->response()->getDate(true),
            ]
        ], 200);
    }

    public function newest_products()
    {
        return response()->json([
            'result' => true,
            'message' => 'application home page',
            'data' => [
                kes::categories => Category::getAllCategories(),
                kes::newest_products => ProductRepository::getNewestProducts()->response()->getDate(true),
            ]
        ], 200);
    }

    public function cheapest_products()
    {
        return response()->json([
            'result' => true,
            'message' => 'application home page',
            'data' => [
                kes::categories => Category::getAllCategories(),
                kes::cheapest_products => ProductRepository::getCheapestProducts()->response()->getDate(true),
            ]
        ], 200);
    }

    public function most_expensive_products()
    {
        return response()->json([
            'result' => true,
            'message' => 'application home page',
            'data' => [
                kes::categories => Category::getAllCategories(),
                kes::most_expensive_products => ProductRepository::getMostExpensiveProducts()->response()->getDate(true),
            ]
        ], 200);
    }
}
