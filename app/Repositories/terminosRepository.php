<?php

namespace App\Repositories;

use App\Models\terminos;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class terminosRepository
 * @package App\Repositories
 * @version December 11, 2017, 2:33 am UTC
 *
 * @method terminos findWithoutFail($id, $columns = ['*'])
 * @method terminos find($id, $columns = ['*'])
 * @method terminos first($columns = ['*'])
*/
class terminosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return terminos::class;
    }
}
