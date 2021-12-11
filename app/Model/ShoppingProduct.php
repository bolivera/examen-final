<?php

namespace App\Model;
use DB;
use Illuminate\Database\Eloquent\Model;

class ShoppingProduct extends Model
{
    protected $table = 'shopping_product';
    protected $primaryKey = 'id';

    static public function get_shopping_productos($idCompra){
        return DB::table('shopping_detail')
        ->where('idShoppingCart','=',$idCompra)
        ->leftJoin('shopping_product', 'shopping_product.id', '=', 'shopping_detail.idShoppingproduct')
        ->select('shopping_product.productLabel','shopping_product.productRef','shopping_product.productQty','shopping_product.productAmount')
        ->get();


    }
}
