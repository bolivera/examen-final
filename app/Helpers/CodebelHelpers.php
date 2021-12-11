<?php

namespace Helpers;

use App\Http\Controllers\RecursosController;
use Illuminate\Support\Str;
use App\Model\Color;
use App\Model\Talla;
use Carbon\Carbon;
use DB;

class CodebelHelpers
{


    public static function getTalla($item, $id)
    {
        if (!empty($item)) {
            $tallasProducto = explode('|', $item);
            if (!empty($item)) {
                foreach ($tallasProducto as $item) {
                    if ($item == $id)
                        return $item;
                }
            }
        }
    }

    public static function getColor($item, $id)
    {
        if (!empty($item)) {
            $colores = explode('|', $item);
            if (!empty($item)) {
                foreach ($colores as $item) {
                    if ($item == $id)
                        return $item;
                }
            }
        }
    }

    public static function addSeparador($items, $condicion = ',')
    {
        if (!empty($items)) {
            $data = implode($condicion, $items);
            return $data;
        }
    }

    public static function comasBarras($items): string
    {
        if (!empty($items)) {
            $data = explode('|', $items);
            $res = '';
            foreach ($data as $datum) {
                if (!empty($datum))
                    $res[] = $datum;
            }
            return implode('|', $res);
        }
    }

    public static function getTallasBD($id)
    {
        return Talla::find($id);
    }

    public static function getColoresDB($id)
    {
        return Color::find($id);
    }

    public static function generateMinutosCompra()
    {
        $minutos = ' Hace ' . rand(1, 30) . ' minutos';
        return $minutos;
    }

    public static function getEtiquetas($item)
    {
        $hoy = Carbon::now();
        $fecha  = Carbon::parse($item->created_at)->format('Y-m-d');
        $dias = Carbon::createMidnightDate($fecha);
        $data['reciente'] = ($hoy->diffInDays($dias) <= 10) ? 1 : 0;
        return view('pages.etiquetas', $data);
    }

    public static function unique_code($limit = 9){
        return Str::random($limit);
    }
}
