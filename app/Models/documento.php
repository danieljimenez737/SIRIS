<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class documento
 * @package App\Models
 * @version December 11, 2017, 3:01 am UTC
 *
 * @property string titulo
 * @property string link
 * @property string fecha
 * @property string ubicacion
 * @property string contenido
 */
class documento extends Model
{
    use SoftDeletes;

    public $table = 'documentos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'titulo',
        'link',
        'fecha',
        'ubicacion',
        'contenido'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'titulo' => 'string',
        'link' => 'string',
        'fecha' => 'string',
        'ubicacion' => 'string',
        'contenido' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'titulo' => 'required',
        'link' => 'required',
        'fecha' => 'required',
        'ubicacion' => 'required',
        'contenido' => 'required'
    ];

    
}
