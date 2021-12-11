<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use DB;

class ShoppingCart extends Model
{
    protected $table = 'shopping_cart';
    protected $primaryKey = 'id';

    static public function get_shopping_cart(){
        return DB::table('shopping_cart')
        ->select('id','ordenCompra', 'created_at','TotalAmount','fullName','email','phoneNumber','distrito','provincia','departamento')
        ->orderBy('id','DESC')
        ->get();
    }

    static public function get_shopping_extra($idCompra){
        return DB::table('shopping_cart')
        ->select('ipAddress','browserUserAgent')
        ->where('id','=',$idCompra)
        ->get();
    }



}