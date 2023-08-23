<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Admin\ProductsRepository;
use App\Http\Controllers\ProductClientController;

class HomeController extends Controller
{
    /**
     * @var ProductClientController
     */
    protected $productClientController;

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
        ProductClientController $productClientController,
        ProductsRepository $productsRepository
    )
    {
        $this->productClientController = $productClientController;
        $this->productsRepository = $productsRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function welcome(Request $request)
    {
        $newProduct = $this->productClientController->getNewProduct();
        $notedProducts = $this->productsRepository->getNoted();
        $isAdmin = false;

        if($request->user() && $request->user()->role_as && $request->user()->role_as == 1)
        {
            $isAdmin = true;
        }

        return view('welcome')->with([
            'isAdmin' => $isAdmin,
            'newProduct' => $newProduct,
            'notedProducts' => $notedProducts
        ]);
    }
}
