<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Admin\ProductsRepository;

class HomeController extends Controller
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

    public function welcome(Request $request)
    {
        $notedProducts = $this->productsRepository->getNoted();
        $isAdmin = false;

        if($request->user() && $request->user()->role_as && $request->user()->role_as == 1)
        {
            $isAdmin = true;
        }

        return view('welcome')->with([
            'isAdmin' => $isAdmin,
            'notedProducts' => $notedProducts
        ]);
    }
}
