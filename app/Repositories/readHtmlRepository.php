<?php

namespace App\Repositories;

use App\Models\readHtml;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class readHtmlRepository
 * @package App\Repositories
 * @version November 21, 2017, 11:18 pm UTC
 *
 * @method readHtml findWithoutFail($id, $columns = ['*'])
 * @method readHtml find($id, $columns = ['*'])
 * @method readHtml first($columns = ['*'])
*/
class readHtmlRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return readHtml::class;
    }
}
