<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Admin\ProductsRepository;
use App\Repositories\Admin\ParametersRepository;
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
     * @var ParametersRepository
     */
    protected $parametersRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ProductClientController $productClientController,
        ProductsRepository $productsRepository,
        ParametersRepository $parametersRepository
    )
    {
        $this->productClientController = $productClientController;
        $this->productsRepository = $productsRepository;
        $this->parametersRepository = $parametersRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function welcome(Request $request)
    {
        $vacations = $this->parametersRepository->first()->vacations;
        $newProduct = $this->productClientController->getNewProduct();
        $notedProducts = $this->productsRepository->getNoted();
        $isAdmin = false;

        if($request->user() && $request->user()->role_as && $request->user()->role_as == 1)
        {
            $isAdmin = true;
        }

        return view('welcome')->with([
            'vacations' => $vacations,
            'isAdmin' => $isAdmin,
            'newProduct' => $newProduct,
            'notedProducts' => $notedProducts
        ]);
    }

    public function RefundPolicies()
    {
        $vacations = $this->parametersRepository->first()->vacations;
        return view('pages.refund-policies')->with([
            'vacations' => $vacations
        ]);
    }

    public function FrequentQuestions()
    {
        $vacations = $this->parametersRepository->first()->vacations;
        return view('pages.frequent-questions')->with([
            'vacations' => $vacations
        ]);
    }

    public function ShippingGuarantee()
    {
        $vacations = $this->parametersRepository->first()->vacations;
        return view('pages.shipping-guarantee')->with([
            'vacations' => $vacations
        ]);
    }

    public function Contact()
    {
        $vacations = $this->parametersRepository->first()->vacations;
        return view('pages.contact')->with([
            'vacations' => $vacations
        ]);
    }
}
