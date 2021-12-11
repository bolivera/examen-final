<?php

namespace App\Model;

use DB;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
//    protected $dates = ['created_at'];

//    public $colores;
    public function categoria($id)
    {
        return Categoria::find($id);
    }


}
