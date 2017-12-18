<?php

namespace App\Repositories;

use App\Models\users;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class usersRepository
 * @package App\Repositories
 * @version December 11, 2017, 12:51 am UTC
 *
 * @method users findWithoutFail($id, $columns = ['*'])
 * @method users find($id, $columns = ['*'])
 * @method users first($columns = ['*'])
*/
class usersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'password'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return users::class;
    }
}
