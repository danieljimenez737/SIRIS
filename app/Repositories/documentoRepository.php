<?php

namespace App\Repositories;

use App\Models\documento;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class documentoRepository
 * @package App\Repositories
 * @version December 11, 2017, 3:01 am UTC
 *
 * @method documento findWithoutFail($id, $columns = ['*'])
 * @method documento find($id, $columns = ['*'])
 * @method documento first($columns = ['*'])
*/
class documentoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'titulo',
        'link',
        'fecha',
        'ubicacion',
        'contenido'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return documento::class;
    }
}
