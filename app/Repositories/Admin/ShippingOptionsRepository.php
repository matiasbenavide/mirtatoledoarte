<?php


namespace App\Repositories\Admin;

use Prettus\Repository\Eloquent\BaseRepository;

class ShippingOptionsRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return 'App\\Models\\Admin\\ShippingOption';
    }

}
