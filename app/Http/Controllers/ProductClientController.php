<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Constants;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Admin\ShippingOption;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Repositories\Admin\SalesRepository;
use App\Repositories\Admin\CombosRepository;
use App\Repositories\Admin\ProductsRepository;
use App\Repositories\Admin\ReceiptsRepository;
use Illuminate\Validation\ValidationException;
use App\Repositories\Admin\CategoriesRepository;
use App\Repositories\Admin\ParametersRepository;
use App\Repositories\Admin\ComboImagesRepository;
use App\Repositories\Admin\ProductImagesRepository;
use App\Repositories\Admin\ShippingOptionsRepository;

class ProductClientController extends Controller
{
    /**
     * @var CategoriesRepository
     */
    protected $categoriesRepository;

    /**
     * @var ShippingOptionsRepository
     */
    protected $shippingOptionsRepository;

    /**
     * @var ProductsRepository
     */
    protected $productsRepository;

    /**
     * @var ProductImagesRepository
     */
    protected $productImagesRepository;

    /**
     * @var CombosRepository
     */
    protected $combosRepository;

    /**
     * @var ComboImagesRepository
     */
    protected $comboImagesRepository;

    /**
     * @var SalesRepository
     */
    protected $salesRepository;

    /**
     * @var ReceiptsRepository
     */
    protected $receiptsRepository;

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
        CategoriesRepository $categoriesRepository,
        ShippingOptionsRepository $shippingOptionsRepository,
        ProductsRepository $productsRepository,
        ProductImagesRepository $productImagesRepository,
        CombosRepository $combosRepository,
        ComboImagesRepository $comboImagesRepository,
        SalesRepository $salesRepository,
        ReceiptsRepository $receiptsRepository,
        ParametersRepository $parametersRepository
    )
    {
        $this->categoriesRepository = $categoriesRepository;
        $this->shippingOptionsRepository = $shippingOptionsRepository;
        $this->productsRepository = $productsRepository;
        $this->productImagesRepository = $productImagesRepository;
        $this->combosRepository = $combosRepository;
        $this->comboImagesRepository = $comboImagesRepository;
        $this->salesRepository = $salesRepository;
        $this->receiptsRepository = $receiptsRepository;
        $this->parametersRepository = $parametersRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function productList(Request $request)
    {
        $vacations = $this->parametersRepository->first()->vacations;
        $newProduct = $this->getNewProduct();

        $combosAndProducts = $this->combosRepository->allCombosWithProducts($request)->paginate(20)->withQueryString();

        if ($request->categorySelector)
        {
            $title = $this->categoriesRepository->find($request->categorySelector)->name;
        }
        else
        {
            $title = 'Todos los productos';
        }

        return view('pages.products-list')->with([
            'vacations' => $vacations,
            'newProduct' => $newProduct,
            'title' => $title,
            'combosAndProducts' => $combosAndProducts,
            'productName' => $request->productName ? $request->productName : null,
            'categorySelector' => $request->categorySelector ? $request->categorySelector : null,
            'lowerPrice' => $request->lowerPrice ? $request->lowerPrice : null,
            'highestPrice' => $request->highestPrice ? $request->highestPrice : null,
            'withColor' => $request->withColor ? $request->withColor : null,
            'withoutColor' => $request->withoutColor ? $request->withoutColor : null

        ]);
    }

    public function productDetail(Request $request)
    {
        $vacations = $this->parametersRepository->first()->vacations;
        $newProduct = $this->getNewProduct();

        if ($request->categoryId == Category::INDIVIDUAL) {
            $product = $this->productsRepository->find($request->id);
            $images = $this->productImagesRepository->getProductImages($product->id);

            return view('pages.product-detail')->with([
                'vacations' => $vacations,
                'newProduct' => $newProduct,
                'product' => $product,
                'images' => $images
            ]);
        }
        else
        {
            $combo = $this->combosRepository->find($request->id);
            foreach (json_decode($combo->products) as $product) {
                $products[] = $this->productsRepository->find($product);
            }
            $images = $this->comboImagesRepository->getComboImages($combo->id);

            return view('pages.combo-detail')->with([
                'vacations' => $vacations,
                'newProduct' => $newProduct,
                'combo' => $combo,
                'products' => $products,
                'images' => $images
            ]);
        }
    }

    public function addToCart(Request $request, $categoryId, $productId)
    {
        if ($categoryId == Category::INDIVIDUAL)
        {
            $product = $this->productsRepository->findOrNull($productId);
        }
        else
        {
            $product = $this->combosRepository->findOrNull($productId);
        }

        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);

        if ($product->category_id == Category::INDIVIDUAL)
        {
            $cart->addProduct($product, $product->id);
        }
        else
        {
            $cart->addCombo($product, $product->id);
        }

        $request->session()->put('cart', $cart);

        return redirect()->back();
    }

    public function removeFromCart(Request $request, $categoryId, $productId)
    {
        if ($categoryId == Category::INDIVIDUAL)
        {
            $product = $this->productsRepository->findOrNull($productId);
        }
        else
        {
            $product = $this->combosRepository->findOrNull($productId);
        }

        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);

        if ($product->category_id == Category::INDIVIDUAL)
        {
            $cart->removeProduct($product, $product->id);
        }
        else
        {
            $cart->removeCombo($product, $product->id);
        }

        $request->session()->put('cart', $cart);

        return redirect()->back();
    }

    public function deleteFromCart(Request $request, $categoryId, $productId)
    {
        if ($categoryId == Category::INDIVIDUAL)
        {
            $product = $this->productsRepository->findOrNull($productId);
        }
        else
        {
            $product = $this->combosRepository->findOrNull($productId);
        }

        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);

        if ($product->category_id == Category::INDIVIDUAL)
        {
            $cart->deleteProduct($product->id);
        }
        else
        {
            $cart->deleteCombo($product->id);
        }

        $request->session()->put('cart', $cart);

        if (!Session::get('cart') || Session::get('cart')->totalQuantity <= 0) {
            return redirect()->route('home');
        }
        else {
            return redirect()->back();
        }
    }

    public function shoppingCart()
    {
        if (!Session::get('cart') || Session::get('cart')->totalQuantity <= 0)
        {
            return redirect()->back()->with('error', Constants::EMPTY_CART);
        }
        $newProduct = $this->getNewProduct();

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return view('pages.shopping-cart', ['products' => $cart->products, 'combos' => $cart->combos, 'totalPrice' => $cart->totalPrice])->with([
            'newProduct' => $newProduct
        ]);
    }

    public function buyDetail()
    {
        if (Session::has('cart'))
        {
            $shippingOptions = $this->shippingOptionsRepository->all();
            $cart = Session::get('cart');

            return view('pages.buy-detail', ['cart' => $cart, 'products' => $cart->products, 'combos' => $cart->combos])->with([
                'shippingOptions' => $shippingOptions
            ]);
        }
        else
        {
            return redirect()->back()->with('error', Constants::EMPTY_CART);
        }
    }

    public function saveShop(Request $request)
    {
        if ($request->shippingSelect == ShippingOption::SHIP) {
            try {
                $this->validate($request, [
                    'name' => 'required|string',
                    'phoneNumber' => 'required|numeric',
                    'email' => 'required|string',
                    'documentNumber' => 'required|numeric',
                    'products' => 'required|string',
                    'totalAmount' => 'required|numeric',
                    'shippingSelect' => 'required|numeric',
                    'direction' => 'required|string',
                    'province' => 'required|string',
                    'locality' => 'required|string',
                    'zipCode' => 'required|numeric',
                    'receipt' => 'required|file|mimes:pdf,png,jpg,jpeg',
                    'referenceCode' => 'required|string',
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
                    'phoneNumber' => 'required|numeric',
                    'email' => 'required|string',
                    'documentNumber' => 'required|numeric',
                    'products' => 'required|string',
                    'totalAmount' => 'required|numeric',
                    'shippingSelect' => 'required|numeric',
                    'receipt' => 'required|mimes:pdf,png,jpg,jpeg',
                    'referenceCode' => 'required|string',
                ]);
            } catch (ValidationException $e) {
                Log::error($e->getMessage(), $e->errors());
                return redirect()->back()->with('error', Constants::ERROR);
            }
        }

        if ($request->products == '') {
            return redirect()->back()->with('error', Constants::BUY_ERROR);
        }

        $newReceipt = collect();
        $requestReceiptFile = $request->file('receipt');

        $newReceipt[] = [
            "file" => $requestReceiptFile->get(),
            "file_name" => $requestReceiptFile->getClientOriginalName(),
            "mime" => $requestReceiptFile->getMimeType(),
            "hash" => sha1_file($requestReceiptFile),
        ];

        try {
            DB::beginTransaction();

            foreach (json_decode($request->products) as $product) {
                $this->deleteFromCart($request, $product->product_category_id, $product->product_id);
            }

            $sale = $this->salesRepository->create($this->mapDataForSale($request));
            $this->receiptsRepository->create($this->mapDataForReceipt($sale->id, $newReceipt));

            $message = Constants::SUCCESSFUL_BUY;

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', Constants::BUY_ERROR);
        }

        return redirect('/')->with('success', $message);
    }

    public function mapDataForSale(Request $request)
    {
        $dataMapped = [
            'name' => $request->name,
            'phone_number' => $request->phoneNumber,
            'email' => $request->email,
            'document_number' => $request->documentNumber,
            'products' => $request->products,
            'total_amount' => $request->totalAmount,
            'shipping_option' => $request->shippingSelect,
            'direction' => $request->direction ? $request->direction : null,
            'province' => $request->province ? $request->province : null,
            'locality' => $request->locality ? $request->locality : null,
            'zip_code' => $request->zipCode ? $request->zipCode : null,
            'reference_code' => $request->referenceCode,
        ];

        return $dataMapped;
    }

    public function mapDataForReceipt($saleId, $file)
    {
        $dataMapped = [
            'sale_id' => $saleId,
            'file' => $file[0]["file"],
            'file_name' => $file[0]["file_name"],
            'mime' => $file[0]["mime"],
            'hash' => $file[0]["hash"],
        ];

        return $dataMapped;
    }

    public function getNewProduct()
    {
        return $this->combosRepository->latestProduct();
    }
}
