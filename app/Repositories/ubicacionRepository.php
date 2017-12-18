<?php

namespace App\Repositories;

use App\Models\ubicacion;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ubicacionRepository
 * @package App\Repositories
 * @version December 14, 2017, 10:04 pm UTC
 *
 * @method ubicacion findWithoutFail($id, $columns = ['*'])
 * @method ubicacion find($id, $columns = ['*'])
 * @method ubicacion first($columns = ['*'])
*/
class ubicacionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ubicacion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ubicacion::class;
    }
}
