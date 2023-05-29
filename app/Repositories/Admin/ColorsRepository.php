<?php


namespace App\Repositories\Admin;

use App\Models\Admin\AgreementType;
use App\Models\Status;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;

class ColorsRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return 'App\\Models\\Admin\\Color';
    }

}
