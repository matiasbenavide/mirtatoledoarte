<?php


namespace App\Repositories\Admin;

use Prettus\Repository\Eloquent\BaseRepository;

class SalesRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return 'App\\Models\\Admin\\Sale';
    }

    public function getSales()
    {
        return $this->select('sales.*', 'shipping_options.name as shipping')
            ->leftJoin('shipping_options', 'sales.shipping_option', 'shipping_options.id')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
    }

}
