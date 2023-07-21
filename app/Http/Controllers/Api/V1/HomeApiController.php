<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ProductRepository;
use App\Http\services\kes;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeApiController extends Controller
{
    /**
     * @OA\Get(
     ** path="/api/v1/home",
     *  tags={"Home Page"},
     *  description="get home page data",
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function home()
    {
        return response()->json([
            'result' => true,
            'message' => 'application home page',
            'data' => [
                kes::sliders => Slider::getSliders(),
                kes::categories => Category::getAllCategories(),
                kes::amazing_products => ProductRepository::get6AmazingProducts(),
                kes::banner => Slider::query()->inRandomOrder()->first(),
                kes::most_seller_products => ProductRepository::get6MostSellerProducts(),
                kes::newest_products => ProductRepository::get6NewestProducts(),
            ]
        ], 200);
    }
}
