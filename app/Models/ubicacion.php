<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ubicacion
 * @package App\Models
 * @version December 14, 2017, 10:04 pm UTC
 *
 * @property string ubicacion
 */
class ubicacion extends Model
{
    use SoftDeletes;

    public $table = 'ubicacion';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'ubicacion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'ubicacion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ubicacion' => 'required'
    ];

    
}
