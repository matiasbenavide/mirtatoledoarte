<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Constants;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\ColorsRepository;
use App\Repositories\Admin\CombosRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Admin\ProductsRepository;
use Illuminate\Validation\ValidationException;
use App\Repositories\Admin\CategoriesRepository;
use App\Repositories\Admin\ComboImagesRepository;
use App\Repositories\Admin\ProductImagesRepository;

class ProductsController extends Controller
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
     * @var ProductImagesRepository
     */
    protected $productImagesRepository;

    /**
     * @var ComboImagesRepository
     */
    protected $comboImagesRepository;

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
        CombosRepository $combosRepository,
        ProductImagesRepository $productImagesRepository,
        ComboImagesRepository $comboImagesRepository,
        CategoriesRepository $categoriesRepository,
        ColorsRepository $colorsRepository
    )
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
        $this->productsRepository = $productsRepository;
        $this->combosRepository = $combosRepository;
        $this->productImagesRepository = $productImagesRepository;
        $this->comboImagesRepository = $comboImagesRepository;
        $this->categoriesRepository = $categoriesRepository;
        $this->colorsRepository = $colorsRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showProducts(Request $request)
    {
        $task = 'products';
        $products = $this->productsRepository->allProducts($request->searchData);
        $combos = $this->combosRepository->allCombos($request->searchData);

        $total = $products->count();
        $totalProducts = $products->count();
        $totalCombos = $combos->count();

        return view('pages.admin.products-list')->with([
            'task' => $task,
            'products' => $products,
            'combos' => $combos,
            'total' => $total,
            'totalProducts' => $totalProducts,
            'totalCombos' => $totalCombos
        ]);
    }

    public function showProductCreation($categoryId, $productId)
    {
        $task = 'product-create';

        if ($categoryId == Category::INDIVIDUAL) {
            $product = $this->productsRepository->findOrNull($productId);
            $productImages = $this->productImagesRepository->getProductImages($product->id);
        }
        else
        {
            $product = $this->combosRepository->findOrNull($productId);
            $productImages = $this->comboImagesRepository->getComboImages($productId);
            if ($product) {
                $product->products = json_decode($product->products);
            }
        }

        $products = $this->productsRepository->all();
        $categories = $this->categoriesRepository->all();
        $colors = $this->colorsRepository->all();
        $formUrl = url('/administracion/productos/creacion-edicion');

        return view('pages.admin.product-creation')->with([
            'task' => $task,
            'formUrl' => $formUrl,
            'product' => $product,
            'productImages' => $productImages,
            'products' => $products,
            'categories' => $categories,
            'colors' => $colors,
        ]);
    }

    public function saveData(Request $request)
    {
        if ($request->category_id == Category::INDIVIDUAL) {
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
                    'images' => 'nullable|array',
                    'images.*' => 'file|mimes:png,jpg,jpeg',
                ]);
            } catch (ValidationException $e) {
                Log::error($e->getMessage(), $e->errors());
                return redirect()->back()->with('error', Constants::ERROR);
            }
        }
        else
        {
            try {
                $this->validate($request, [
                    'name' => 'required|string',
                    'price' => 'required|numeric',
                    'productsSelect' => 'required|array',
                    'productsSelect.*' => 'required|numeric',
                    'description' => 'required|string',
                    'material' => 'required|string',
                    'size' => 'required|string',
                    'max_weight' => 'required|numeric',
                    'category_id' => 'required|numeric',
                    'color_id' => 'required|numeric',
                    'images' => 'nullable|array',
                    'images.*' => 'file|mimes:png,jpg,jpeg',
                ]);
            } catch (ValidationException $e) {
                Log::error($e->getMessage(), $e->errors());
                return redirect()->back()->with('error', Constants::ERROR);
            }
        }

        if ($request->hasFile('images')) {
            $files = $request->file('images');
        }
        else {
            $files = null;
        }

        if ($request->productId) {
            $productImages = $this->productImagesRepository->getProductImages($request->productId);
            $comboImages = $this->productImagesRepository->getProductImages($request->productId);
        }

        try {
            DB::beginTransaction();
            if ($request->productId != 0){
                if ($request->category_id == Category::INDIVIDUAL)
                {
                    $product = $this->productsRepository->update($this->mapDataForProduct($request),$request->productId);

                    if ($files) {
                        foreach ($files as $file) {
                            $this->productImagesRepository->create($this->mapDataForImages($file, $product->id, false));
                        }
                    }
                }
                else
                {
                    $combo = $this->combosRepository->update($this->mapDataForCombo($request),$request->productId);

                    if ($files) {
                        foreach ($files as $file) {
                            $this->productImagesRepository->create($this->mapDataForImages($file, $combo->id, true));
                        }
                    }
                }
            }
            else
            {
                if ($request->category_id == Category::INDIVIDUAL) {
                    $product = $this->productsRepository->create($this->mapDataForProduct($request));

                    if ($files) {
                        foreach ($files as $file) {
                            $this->productImagesRepository->create($this->mapDataForImages($file, $product->id, false));
                        }
                    }
                }
                else
                {
                    $combo = $this->combosRepository->create($this->mapDataForCombo($request));

                    if ($files) {
                        foreach ($files as $file) {
                            $this->comboImagesRepository->create($this->mapDataForImages($file, $combo->id, true));
                        }
                    }
                }
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

    private function mapDataForProduct(Request $request)
    {
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

    private function mapDataForCombo(Request $request)
    {
        $dataMapped = [
            'name' => $request->name,
            'price' => $request->price,
            'products' => json_encode($request->productsSelect),
            'description' => $request->description,
            'material' => $request->material,
            'size' => $request->size,
            'max_weight' => $request->max_weight,
            'category_id' => $request->category_id,
            'color_id' => $request->color_id,
        ];
        return $dataMapped;
    }

    private function mapDataForImages($image, $productId, $isCombo)
    {
        if ($isCombo)
        {
            $imagesDataMapped = [
                'combo_id' => $productId,
                'image' => time(). '_' . $image->getClientOriginalName(),
            ];
        }
        else
        {
            $imagesDataMapped = [
                'product_id' => $productId,
                'image' => time(). '_' . $image->getClientOriginalName(),
            ];
        }

        $image->move(\public_path("images/products-images/"), $imagesDataMapped['image']);

        return $imagesDataMapped;
    }
}
