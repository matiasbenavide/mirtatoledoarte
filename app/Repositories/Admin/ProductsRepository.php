<?php


namespace App\Repositories\Admin;

use App\Models\Admin\Product;
use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductsRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return 'App\\Models\\Admin\\Product';
    }

    public function allProducts()
    {
        return $this->select('products.*', 'categories.name as category', 'colors.color as color')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->leftJoin('colors', 'products.color_id', 'colors.id')
            // ->where(function ($query) use ($searchData) {
            //     if ($searchData) {
            //         $query->where('agreements.number', $searchData);
            //         $query->orWhere('agreements.signatory_parties', 'LIKE', '%' . $searchData . '%');
            //         $query->orWhere('agreements.signature_year', $searchData);
            //         $query->orWhereHas('updated_user', function (Builder $query) use ($searchData) {
            //             $query->where('username', 'LIKE', '%' . $searchData . '%');
            //         });
            //     }
            // })
            ->orderBy('updated_at', 'DESC')
            // ->paginate($pagination);
            ->get();
    }

    public function findOrNull($id) {
        try {
            $product = Product::select('products.*')
            ->where('id','=',$id)
            ->first();
            return $product;
        } catch(ModelNotFoundException $e) {
            return null;
        }
    }

}
