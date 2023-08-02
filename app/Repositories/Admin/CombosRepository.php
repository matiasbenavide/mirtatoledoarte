<?php


namespace App\Repositories\Admin;

use App\Models\Admin\Combo;
use App\Models\Admin\Product;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CombosRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return 'App\\Models\\Admin\\Combo';
    }

    public function allCombos($searchData)
    {
        try {
            return $this->select('combos.*', 'categories.name as category', 'colors.color as color')
                ->leftJoin('categories', 'combos.category_id', 'categories.id')
                ->leftJoin('colors', 'combos.color_id', 'colors.id')
                ->where(function ($query) use ($searchData) {
                    if ($searchData) {
                        $query->where('combos.id', $searchData);
                        $query->orWhere('combos.name', 'LIKE', '%' . $searchData . '%');
                        $query->orWhere('combos.price', $searchData);
                    }
                })
                ->orderBy('updated_at', 'DESC')
                ->get();
        } catch(ModelNotFoundException $e) {
            return null;
        }
    }

    // public function allCombosWithProducts()
    // {
    //     $products = Product::select('products.*', DB::raw("NULL as products "), 'categories.name as category', 'colors.color as color')
    //     ->leftJoin('categories', 'products.category_id', 'categories.id')
    //     ->leftJoin('colors', 'products.color_id', 'colors.id');

    //     $combos = Combo::select('combos.*', 'categories.name as category', 'colors.color as color')
    //         ->leftJoin('categories', 'combos.category_id', 'categories.id')
    //         ->leftJoin('colors', 'combos.color_id', 'colors.id');

    //     $combosAndProducts = $combos
    //         ->union($products)
    //         ->orderBy('updated_at', 'DESC')
    //         ->get();

    //     return $combosAndProducts;
    // }

    public function findOrNull($id) {
        try {
            $combo = Combo::select('combos.*')
            ->where('id','=',$id)
            ->first();
            return $combo;
        } catch(ModelNotFoundException $e) {
            return null;
        }
    }

}
