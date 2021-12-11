<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RecursosController;
use App\Model\Categoria;
use App\Model\Colecciones;
use App\Model\Color;
use App\Model\Producto;
use App\Model\Talla;
use Illuminate\Http\Request;
use DB;

class productosController extends Controller
{
    public $recursos;

    public function __construct()
    {
        $this->recursos = new RecursosController();
    }

    public function productos($categoria = null, $talla = null, $color = null, $precio_min = null, $precio_max = null, $despacho = null, $coleccion = null, $orden = null, $search = null, $page = null)
    {
        // PARAMETOS Y VALORES DE LA RUTA
        $criterias = request()->only(['categoria', 'talla', 'color', 'precio_min', 'precio_max', 'despacho', 'coleccion', 'orden','search', 'page']);

        // FILTRAMOS EL PAGE DE LOS DEMAS PARAMETROS
        // CALCULAMOS EL SALTO
        $jump = null;
        $page = 1;
        if (isset($criterias["page"])) {
            $page = $criterias["page"];
            $jump = 9 * ($criterias["page"] - 1);
            unset($criterias["page"]);
        }

        // FORMATO PARA EXPORTAR LOS VALORES DE LA RUTA A LA VISTA
        $filters = [];
        $i = 0;
        foreach ($criterias as $key => $value) {
            $i++;
            $filters[$i]['name'] = $key;
            $filters[$i]['value'] = $value;
        }
        
        $data['filtros'] = (object)$filters;

        // LISTA DE ANUNCIO FILTRADOS
        $result = $this->recursos->get_producto($filters, $jump);
        $data['productos'] = $result[0];
        $data['cantidad_productos'] = round($result[1] / 9);
        $data['current_page'] = $page;
        $recursos = new RecursosController();
        $data['title'] = 'Todos los productos';
        $data['categorias'] = Categoria::where('estado', 1)->get();
        $data['colecciones'] = Colecciones::where('estado', 1)->get();
        $data['colores'] = Color::where('estado', 1)->get();
        $data['tallas'] = Talla::where('estado', 1)->get();
        foreach ($data['productos'] as $item) {
            $item->photos = $recursos->getExplodeImagenes($item->imagenes);
            $item->categoria = Categoria::find($item->idCategoria);
        }

        $data['header'] = view('pages.header', $data);
        $data['footer'] = view('pages.footer', $data);
        // dd($data['productos']);
        return view('pages.productos')->with($data);
    }

    public function prodcutosByCategoria(Request $request, $id = null, $slug = null)
    {
        $data['title'] = 'Bienvenido';
        $data['categorias'] = Categoria::where('estado', 1)->get();
        $data['header'] = view('pages.header', $data);
        $data['footer'] = view('pages.footer', $data);
        return view('pages.productos', $data);
    }

    public function productoDetalle(Request $request, $id = null, $slug = null)
    {
        $validate = Producto::where(['id' => $id, 'slug' => $slug])->exists();
        if ($validate) {
            $producto = Producto::where(['id' => $id, 'slug' => $slug])->first();
            $producto->categoria = Categoria::find($producto->idCategoria);
            $data['fotos'] = $this->recursos->getExplodeImagenes($producto->imagenes);
            $data['categorias'] = Categoria::where('estado', 1)->get();
            $data['sugerencias'] = $this->productosSugerencias($producto->tags, $producto->id);
            $data['titulo'] = $producto->titulo;
            $data['descripcion'] = $producto->Descripcion;
            $data['producto'] = $producto;
            $data['header'] = view('pages.header', $data);
            $data['footer'] = view('pages.footer', $data);
            return view('pages.detalle', $data);
        } else {
            return response()->view('errors.404', 404);
        }
    }

    public function productosSugerencias($tags = null, $id = null)
    {
        $data = DB::table('productos');
        $data->whereRaw('MATCH (tags) AGAINST  (? IN BOOLEAN MODE)', [$tags]);
        $data->whereNotIn('id', [$id]);
        $data->where('estado',1);
        $data->limit(6);
        $data = $data->get();
        foreach ($data as $item) {
            $item->photo = $this->recursos->getExplodeImagenes($item->imagenes);
            $item->categoria = Categoria::find($item->idCategoria);
        }
        return $data;
    }
}
