<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Admin\CombosRepository;
use App\Repositories\Admin\ProductsRepository;

class ProductClientController extends Controller
{
    /**
     * @var ProductsRepository
     */
    protected $productsRepository;

    /**
     * @var CombosRepository
     */
    protected $combosRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ProductsRepository $productsRepository,
        CombosRepository $combosRepository
    )
    {
        $this->productsRepository = $productsRepository;
        $this->combosRepository = $combosRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function productList(Request $request)
    {
        $products = $this->productsRepository->all();
        $combos = $this->combosRepository->all();

        return view('pages.products-list')->with([
            'products' => $products,
            'combos' => $combos
        ]);
    }

    public function productDetail(Request $request)
    {
        $product = $this->productsRepository->find($request->id);

        return view('pages.product-detail')->with([
            'product' => $product
        ]);
    }
}
