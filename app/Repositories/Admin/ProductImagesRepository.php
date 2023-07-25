<?php


namespace App\Repositories\Admin;

use App\Models\Admin\ProductsImages;
use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductImagesRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return 'App\\Models\\Admin\\ProductsImages';
    }

    public function getProductImages($productId)
    {
        return $this->select('products_images.*')
            ->where('products_images.product_id', $productId)
            ->get();
    }

}
