<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Admin\ProductsRepository;

class ProductClientController extends Controller
{
    /**
     * @var ProductsRepository
     */
    protected $productsRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ProductsRepository $productsRepository
    )
    {
        $this->productsRepository = $productsRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function productDetail(Request $request)
    {
        $product = $this->productsRepository->find($request->id);
        dd($product);

        return view('product-detail')->with([
            'product' => $product
        ]);
    }
}
