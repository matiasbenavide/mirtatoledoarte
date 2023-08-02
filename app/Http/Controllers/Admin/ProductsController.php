<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use App\Models\Admin\Constants;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\ColorsRepository;
use App\Repositories\Admin\ProductsRepository;
use App\Repositories\Admin\CategoriesRepository;
use App\Repositories\Admin\ProductImagesRepository;

class ProductsController extends Controller
{

    /**
     * @var ProductsRepository
     */
    protected $productsRepository;

    /**
     * @var ProductImagesRepository
     */
    protected $productImagesRepository;

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
        ProductImagesRepository $productImagesRepository,
        CategoriesRepository $categoriesRepository,
        ColorsRepository $colorsRepository
    )
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
        $this->productsRepository = $productsRepository;
        $this->productImagesRepository = $productImagesRepository;
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

        $total = $products->count();
        $totalProducts = $products->where('category_id', 1)->count();
        $totalCombos = $products->where('category_id', 2)->count();

        return view('pages.admin.products-list')->with([
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
        $products = $this->productsRepository->all();
        $categories = $this->categoriesRepository->all();
        $colors = $this->colorsRepository->all();
        $formUrl = url('/administracion/productos/creacion-edicion');

        $images = new Collection();

        if ($product) {
            $productImages = $this->productImagesRepository->getProductImages($product->id);

            foreach ($productImages as $image) {
                $images[] = [
                    'title' => $image->title,
                    'mime' => $image->mime,
                    'image' => base64_encode($image->image),
                ];
            }
        }

        return view('pages.admin.product-creation')->with([
            'task' => $task,
            'formUrl' => $formUrl,
            'product' => $product,
            'productImages' => $images,
            'products' => $products,
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
                // 'images' => 'nullable|array',
                // 'images.*' => 'file|mimes:png,jpg,jpeg',
            ]);
        } catch (ValidationException $e) {
            Log::error($e->getMessage(), $e->errors());
            return redirect()->back()->with('error', Constants::ERROR);
        }

        // $newImages = collect();
        // $requestImages = $request->file('images') ?? [];

        // foreach ($requestImages as $image) {
        //     $newImages[] = [
        //         "title" => $image->getClientOriginalName(),
        //         "mime" => $image->getMimeType(),
        //         "image" => $image->get(),
        //     ];
        // }

        // if ($request->productId) {
        //     $actualImages = $this->productImagesRepository->getProductImages($request->productId);

        //     if ($actualImages) {
        //         $actualImages = $actualImages->keyBy('id');
        //     }

        //     foreach ($newImages as $key => $image) {
        //         $inDB = $actualImages->firstWhere('image', $image["image"]);

        //         if ($inDB) {
        //             $actualImages->forget($inDB->id);
        //             $newImages->forget($key);
        //         }
        //     }
        // }

        try {
            DB::beginTransaction();
            if ($request->productId != 0){
                if ($request->category_id == 1)
                {
                    $product = $this->productsRepository->update($this->mapDataForProduct($request),$request->productId);
                }
                else
                {
                    $product = $this->productsRepository->update($this->mapDataForCombo($request),$request->productId);
                }

                // foreach ($actualImages as $image) {
                //     $this->productImagesRepository->delete($image->id);
                // }

                // foreach ($newImages as $image) {
                //     $this->productImagesRepository->create($this->mapDataForImages($request->productId, $image));
                // }
            }
            else
            {
                if ($request->category_id == 1) {
                    $product = $this->productsRepository->create($this->mapDataForProduct($request));
                }
                else
                {
                    $product = $this->productsRepository->create($this->mapDataForCombo($request));
                }

                // foreach ($newImages as $image) {
                //     $this->productImagesRepository->create($this->mapDataForImages($product->id, $image));
                // }
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
            'description' => $request->description,
            'material' => $request->material,
            'size' => $request->size,
            'max_weight' => $request->max_weight,
            'category_id' => $request->category_id,
            'color_id' => $request->color_id,
        ];
        return $dataMapped;
    }

    private function mapDataForImages($productId, $image)
    {
        $imagesDataMapped = [
            'product_id' => $productId,
            'title' => $image['title'],
            'mime' => $image['mime'],
            'image' => $image['image'],
        ];

        return $imagesDataMapped;
    }
}
