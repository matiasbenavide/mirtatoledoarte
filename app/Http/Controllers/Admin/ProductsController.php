<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Constants;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\ProductsRepository;
use App\Repositories\Admin\CategoriesRepository;
use App\Repositories\Admin\ColorsRepository;
use Illuminate\Validation\ValidationException;

class ProductsController extends Controller
{

    /**
     * @var ProductsRepository
     */
    protected $productsRepository;

    /**
     * @var CategoriesRepository
     */
    protected $categoriesRepository;

    /**
     * @var ColorsRepository
     */
    protected $colorsRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ProductsRepository $productsRepository,
        CategoriesRepository $categoriesRepository,
        ColorsRepository $colorsRepository
    )
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
        $this->productsRepository = $productsRepository;
        $this->categoriesRepository = $categoriesRepository;
        $this->colorsRepository = $colorsRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showProducts()
    {
        $task = 'products';
        $products = $this->productsRepository->allProducts();

        $total = $products->count();
        $totalProducts = $products->where('category_id', 1)->count();
        $totalCombos = $products->where('category_id', 2)->count();

        return view('pages.products-list')->with([
            'task' => $task,
            'products' => $products,
            'total' => $total,
            'totalProducts' => $totalProducts,
            'totalCombos' => $totalCombos
        ]);
    }

    public function showProductCreation($productId)
    {
        $task = 'product-create';
        $product = $this->productsRepository->findOrNull($productId);
        $categories = $this->categoriesRepository->all();
        $colors = $this->colorsRepository->all();

        return view('pages.product-creation')->with([
            'task' => $task,
            'product' => $product,
            'categories' => $categories,
            'colors' => $colors,
        ]);
    }

    public function saveData(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|string',
                'price' => 'required|numeric',
                'description' => 'required|string',
                'material' => 'required|string',
                'size' => 'required|string',
                'max_weight' => 'required|numeric',
                'category_id' => 'required|numeric',
                'color_id' => 'required|numeric',
            ]);
        } catch (ValidationException $e) {
            Log::error($e->getMessage(), $e->errors());
            return redirect()->back()->with('error', Constants::ERROR);
        }

        try {
            DB::beginTransaction();
            if ( $request->productId != 0 ){

                $this->productsRepository->update($this->mapData($request),$request->productId);
            }else{

                $this->productsRepository->create($this->mapData($request));
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', Constants::ERROR);
        }

        return redirect('/administracion/productos/listado')->with('success', Constants::PRODUCT_SUCCESS);
    }

    // public function delete($id){

    //     try {
    //         $this->agreementTypeRepository->delete($id);
    //     }
    //     catch (\Illuminate\Database\QueryException $e) {
    //         Log::error($e->getMessage());
    //         if($e->getCode() == Constants::CODE_INTEGRITY_DATABASE){
    //             $this->agreementTypeRepository->changeDeleteForStatusDisabled($id);
    //             return redirect()->back()->with('warning', '¡ La operación no se puede realizar, se ha cambiado el estado a Deshabilitado !');
    //         }
    //         return redirect()->back()->with('error', Constants::ERROR);
    //     }
    //     catch (\Exception $e) {
    //         Log::error($e->getMessage());
    //         return redirect()->back()->with('error', Constants::ERROR);
    //     }

    //     return redirect()->back()->with('success', Constants::PRODUCT_SUCCESS);
    // }

    private function mapData(Request $request){
        $dataMapped = [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'material' => $request->material,
            'size' => $request->size,
            'max_weight' => $request->max_weight,
            'category_id' => $request->category_id,
            'color_id' => $request->color_id,
        ];
        return $dataMapped;
    }
}
