<?php

namespace App\Http\Controllers;

use App\Model\Categoria;
use App\Model\Colecciones;
use App\Model\Imagenes;
use App\Model\Producto;
use App\Model\Ubigeo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Str;
use DB;
class RecursosController extends Controller
{


    public function subir_imagenes(Request $request)
    {
        try {
            $date = Carbon::now();
            if ($request->file('file0') != null) {
                $file = $request->file0;
                $ext = $file->getClientOriginalExtension();
                $name = 'galerias/' . $date->year . '/' . $date->toDateString() . '_' . time() . '.' . $ext;
                $url = $name;
                Storage::disk('public')->put($url, file_get_contents($file));

                $ima = new Imagenes;
                $ima->name = $url;
                $ima->save();
                $ima->id;

                return response()->json([
                    'ok' => true,
                    'urlCompleta' => url(Storage::url($url)),
                    'name' => $name,
                    'imgId' => $ima->id
                ], 200);
            } else {
                return response()->json(['ok' => false, 'message' => 'Error al subir el archivo'], 500);
            }
        } catch (\Exception $ex) {
            return response()->json(['ok' => false, 'message' => $ex->getMessage()], 500);
        }
    }

    public function ajax_get_provincias(Request $request)
    {
        $iddepa = $request->iddepa;
        $provincia = Ubigeo::where(['coddep' => $iddepa, 'flag' => 'P'])->get();
        return Response()->json($provincia);
    }

    public function ajax_get_distritos(Request $request)
    {
        $idprov = $request->idprov;
        $iddepa = $request->iddepa;
        $distrito = Ubigeo::where(['coddep' => $iddepa, 'codprov' => $idprov, 'flag' => 'T'])->get();
        return Response()->json($distrito);
    }


    public function _getUbigeo($ubigeo)
    {
        $str = str_split($ubigeo, 2);
        if (count($str) == 4) {
            $ubig[] = \DB::table('ubigeo')->where(['flag' => 'D', 'coddep' => $str[1]])->first();
            $ubig[] = \DB::table('ubigeo')->where(['flag' => 'P', 'coddep' => $str[1], 'codprov' => $str[2]])->first();
            $ubig[] = \DB::table('ubigeo')->where(['flag' => 'T', 'coddep' => $str[1], 'codprov' => $str[2], 'coddist' => $str[3]])->first();
        } else {
            $ubig[] = \DB::table('ubigeo')->where(['flag' => 'D', 'coddep' => $str[0]])->first();
            $ubig[] = \DB::table('ubigeo')->where(['flag' => 'P', 'coddep' => $str[0], 'codprov' => $str[1]])->first();
            $ubig[] = \DB::table('ubigeo')->where(['flag' => 'T', 'coddep' => $str[0], 'codprov' => $str[1], 'coddist' => $str[2]])->first();
        }
        return $ubig;
    }

    public function departamentos()
    {
        return Ubigeo::where(['flag' => 'D'])->orderBy('nmbubigeo', 'asc')->get();
    }

    public function getExplodeImagenes($data)
    {
        $explode = explode('|', $data);
        $result = array();
        for ($i = 0; $i < count($explode); $i++) {
            if (!empty($explode[$i])) {
                $res = Imagenes::find($explode[$i]);
                if (!empty($res)) {
                    $result[$i]['name'] = $res->name;
                    $result[$i]['id'] = $res->id;
                    $result[$i]['urlCompleta'] = $this->getUrlStorage($res->name);
                } else {
                    $result = [];
                }

            }
        }
        return $result;
    }

    public function getExplodeProductos($data)
    {
        $explode = explode('|', $data);
        $result = array();
        for ($i = 0; $i < count($explode); $i++) {
            if (!empty($explode[$i])) {
                $res = Producto::find($explode[$i]);
                if (!empty($res)) {
                    $result[$i]['titulo'] = $res->titulo;
                    $result[$i]['id'] = $res->id;
                    $result[$i]['categoria'] = Categoria::find($res->idCategoria)->nombre;
                    $result[$i]['slug'] = $res->slug;
                } else {
                    $result = [];
                }
            }
        }
        return $result;
    }

    public function getUrlStorage($url)
    {
        if (Storage::disk('public')->exists($url)) {
            $urlCompleta = url(Storage::url($url));
        } else {
            $urlCompleta = url(Storage::url('default.png'));
        }
        return $urlCompleta;
    }

    public function deleteImagen(Request $request)
    {
        $url = $request->name;
        if (Storage::disk('public')->exists($url)) {
            Storage::disk('public')->delete($url);
            Imagenes::find($request->id)->delete();
            return response()->json(['ok' => true, 'message' => 'Imagen eliminado correctamente'], 200);
        } else {
            return response()->json(['ok' => false, 'message' => 'Imagen eliminado correctamente'], 200);
        }
    }

    function generateRandomString($length = 5)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    public function numberShopping($data){
        $result = DB::table('shopping_cart')->where('ordenCompra',$data)->exists();
        return $result;
    }

    public function get_producto($filters, $jump)
    {
        $query = DB::table('productos');
        $query->where('productos.estado', '=', 1);
        $query_two = DB::table('colecciones');
        $query_two->where('colecciones.estado', '=', 1);

        foreach ($filters as $key => $value) {

            if ($value['name'] == 'coleccion') {
                $query_two->where('colecciones.id', '=', $value['value']);
                $aux = $query_two->get();
                $this->explode = explode('|', $aux[0]->productos);
    
                $query->where(function ($q) {
                    $q->where('productos.id', '=', $this->explode[0]);
                    if (count($this->explode) >= 2){
                        for($i=1; $i < count($this->explode) ; $i++ ){ 
                            $q->orWhere('productos.id', '=', $this->explode[$i]);
                        }
                    }
                });
            }

            if ($value['name'] == 'categoria') {
                $query->where('productos.idCategoria', '=', $value['value']);
            }

            // if ($value['name'] == 'search') {
            //     $query->where('productos.tags', 'like', '%'. $value['value'] .'%');
            // }

            if ($value['name'] == 'despacho') {
                if($value['value'] =='1') 
                    $query->where('productos.despachoDomicilio', '=','1' );

                if($value['value'] =='0') 
                    $query->where('productos.despachoTienda', '=','1' );
            }
            if ($value['name'] == 'precio_min') {
                if ($value['value'] !== null) {
                    $query->whereRaw('CONVERT(productos.precio, SIGNED INTEGER) >= ?', (int)$value['value']);
                }
            } elseif ($value['name'] == 'precio_max') {
                if ($value['value'] !== null) {
                    $query->whereRaw('CONVERT(productos.precio, SIGNED INTEGER) <= ?', (int)$value['value']);
                }
            }

            if ($value['name'] == 'talla') {
                $this->tallas = explode(',', $value['value']);
                $query->where(function ($q) {
                    $q->where('productos.tallas', 'like', '%'.$this->tallas[0].'%');
                    if (count($this->tallas) >= 2){
                        for($i=1; $i < count($this->tallas); $i++ ){ 
                            $q->orWhere('productos.tallas', 'like', '%'.$this->tallas[$i].'%');
                        }
                    }
                });
            }

            if ($value['name'] == 'color') {
                //SELECT * FROM `productos` WHERE (colores like '%Blanco%') OR (colores like '%Marron%')
                $this->colores = explode(',', $value['value']);
                $query->where(function ($q) {
                    $q->where('productos.colores', 'like', '%'.$this->colores[0].'%');
                    if (count($this->colores) >= 2){
                        for($i=1; $i < count($this->colores); $i++ ){ 
                            $q->orWhere('productos.colores', 'like', '%'.$this->colores[$i].'%');
                        }
                    }
                });
            }


            if ($value['name'] == 'orden') {
                switch ($value['value']) {
                    case '1':
                        $query->orderBy( DB::raw("CONVERT(productos.precio, INT)"), 'ASC');
                    break;
                    case '2':
                        $query->orderBy( DB::raw("CONVERT(productos.precio, INT)"), 'DESC');
                    break;
                    case '3':
                        $query->orderBy('productos.titulo','ASC');
                    break;
                    case '4':
                        $query->orderBy('productos.titulo','DESC');
                    break;
                    default:
                        $query->orderBy('productos.titulo','ASC');
                        break;
                }
            }
        }

        foreach ($filters as $key => $value) {            
            if ($value['name'] == 'search') {
                $this->palabra_cl = $value['value'];
                $query->where(function ($q) {
                    $q->where('productos.titulo', 'like', '%' . $this->palabra_cl . '%')
                    ->orwhere('productos.Descripcion', 'like', '%' . $this->palabra_cl . '%')
                    ->orwhere('productos.tags', 'like', '%' . $this->palabra_cl . '%');
                });
            }
        }

        $numrows = $query->count();
        $result = $query->skip($jump)->take(9)->get();

        //dd($numrows);
        return [$result, $numrows];
    }

}
