<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\SalesRepository;
use App\Repositories\Admin\CombosRepository;
use App\Repositories\Admin\ProductsRepository;
use App\Repositories\Admin\ShippingOptionsRepository;

class SalesController extends Controller
{
    /**
     * @var SalesRepository
     */
    protected $salesRepository;

    /**
     * @var ShippingOptionsRepository
     */
    protected $shippingOptionsRepository;

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
        SalesRepository $salesRepository,
        ShippingOptionsRepository $shippingOptionsRepository,
        ProductsRepository $productsRepository,
        CombosRepository $combosRepository
    )
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
        $this->salesRepository = $salesRepository;
        $this->shippingOptionsRepository = $shippingOptionsRepository;
        $this->productsRepository = $productsRepository;
        $this->combosRepository = $combosRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showSales()
    {
        $task = 'sales';

        $sales = $this->salesRepository->getSales();

        foreach ($sales as $sale) {
            foreach (json_decode($sale->products) as $product) {
                if ($product->product_category_id == Category::INDIVIDUAL) {
                    $productsData[] = $this->productsRepository->find($product->product_id);
                }
                else
                {
                    $productsData[] = $this->combosRepository->find($product->product_id);
                }
            }
            $sale->products_data = $productsData;
            $productsData = [];
        }

        return view('pages.admin.sales')->with([
            'task' => $task,
            'sales' => $sales
        ]);
    }
}
