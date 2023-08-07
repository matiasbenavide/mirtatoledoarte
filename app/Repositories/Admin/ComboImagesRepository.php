<?php


namespace App\Repositories\Admin;

use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ComboImagesRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return 'App\\Models\\Admin\\ComboImage';
    }

    public function getComboImages($comboId)
    {
        return $this->select('combos_images.*')
            ->where('combos_images.combo_id', $comboId)
            ->get();
    }

}
