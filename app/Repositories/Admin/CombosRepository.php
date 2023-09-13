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
                // ->where(function ($query) use ($searchData) {
                //     if ($searchData->lowerPrice) {
                //         $query->where('combos.price', '>=', $searchData->lowerPrice);
                //     }

                //     if ($searchData->highestPrice) {
                //         $query->where('combos.price', '<=', $searchData->highestPrice);
                //     }

                //     if ($searchData->withColor) {
                //         $query->where('combos.color_id', $searchData->withColor);
                //     }

                //     if ($searchData->withoutColor) {
                //         $query->where('combos.color_id', $searchData->withoutColor);
                //     }
                // })
                ->orderBy('updated_at', 'DESC')
                ->get();
        } catch(ModelNotFoundException $e) {
            return null;
        }
    }

    public function allCombosWithProducts($searchData)
    {
        $products = Product::select('products.id', 'products.name', 'products.price', DB::raw("NULL as products"), 'products.description', 'products.main_image', 'products.category_id', 'products.color_id', 'products.created_at', 'products.created_by', 'products.updated_at', 'products.updated_by', 'categories.name as category', 'colors.color as color')
        ->leftJoin('categories', 'products.category_id', 'categories.id')
        ->leftJoin('colors', 'products.color_id', 'colors.id')
        ->where(function($query) use ($searchData) {
            if ($searchData->categorySelector) {
                $query->where('products.category_id', $searchData->categorySelector);
            }

            if ($searchData->lowerPrice) {
                $query->where('products.price', '>=', $searchData->lowerPrice);
            }

            if ($searchData->highestPrice) {
                $query->where('products.price', '<=', $searchData->highestPrice);
            }

            if ($searchData->withColor) {
                $query->where('products.color_id', $searchData->withColor);
            }

            if ($searchData->withoutColor) {
                $query->where('products.color_id', $searchData->withoutColor);
            }
        });

        $combos = Combo::select('combos.*', 'categories.name as category', 'colors.color as color')
            ->leftJoin('categories', 'combos.category_id', 'categories.id')
            ->leftJoin('colors', 'combos.color_id', 'colors.id')
            ->where(function($query) use ($searchData) {
                if ($searchData->categorySelector) {
                    $query->where('combos.category_id', $searchData->categorySelector);
                }

                if ($searchData->lowerPrice) {
                    $query->where('combos.price', '>=', $searchData->lowerPrice);
                }

                if ($searchData->highestPrice) {
                    $query->where('combos.price', '<=', $searchData->highestPrice);
                }

                if ($searchData->withColor) {
                    $query->where('combos.color_id', $searchData->withColor);
                }

                if ($searchData->withoutColor) {
                    $query->where('combos.color_id', $searchData->withoutColor);
                }
            });

        $combosAndProducts = $combos
            ->union($products)
            ->orderBy('updated_at', 'DESC');

        return $combosAndProducts;
    }

    public function allCombosWithProductsWithoutSearch()
    {
        $products = Product::select('products.id', 'products.name', 'products.price', DB::raw("NULL as products"), 'products.description', 'products.main_image', 'products.category_id', 'products.color_id', 'products.created_at', 'products.created_by', 'products.updated_at', 'products.updated_by', 'categories.name as category', 'colors.color as color')
        ->leftJoin('categories', 'products.category_id', 'categories.id')
        ->leftJoin('colors', 'products.color_id', 'colors.id');

        $combos = Combo::select('combos.*', 'categories.name as category', 'colors.color as color')
            ->leftJoin('categories', 'combos.category_id', 'categories.id')
            ->leftJoin('colors', 'combos.color_id', 'colors.id');

        $combosAndProducts = $combos
            ->union($products)
            ->orderBy('updated_at', 'DESC')
            ->get();

        return $combosAndProducts;
    }

    public function latestProduct()
    {
        $products = Product::select('products.id', 'products.name', 'products.price', DB::raw("NULL as products"), 'products.description', 'products.main_image', 'products.category_id', 'products.color_id', 'products.created_at', 'products.created_by', 'products.updated_at', 'products.updated_by', 'categories.name as category', 'colors.color as color')
        ->leftJoin('categories', 'products.category_id', 'categories.id')
        ->leftJoin('colors', 'products.color_id', 'colors.id');

        $combos = Combo::select('combos.*', 'categories.name as category', 'colors.color as color')
            ->leftJoin('categories', 'combos.category_id', 'categories.id')
            ->leftJoin('colors', 'combos.color_id', 'colors.id');

        $combosAndProducts = $combos
            ->union($products)
            ->orderBy('updated_at', 'DESC')
            ->first();

        return $combosAndProducts;
    }

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
