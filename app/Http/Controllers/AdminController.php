<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Model\Categoria;
use App\Model\Colecciones;
use App\Model\Producto;
use App\Model\Color;
use App\Model\Talla;
use App\Model\ShoppingCart;
use App\Model\ShoppingProduct;
use DB;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Helpers\CodebelHelpers;

class AdminController extends Controller
{

    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        $this->middleware('auth:administrator');
    }

    public function index()
    {
        $data['header'] = view('admin/layout/header');
        return view('admin/layout/home', $data);
    }

    public function all_clientes()
    {
        $data['clientes'] = Cliente::where('ESTADO', 1)->paginate(15);
        $data['header'] = view('admin/layout/header');
        return view('admin/layout/clientes', $data);
    }

    public function formColeccion($id = null)
    {
        $recursos = new RecursosController();
        if (!is_null($id)) {
            $data['coleccion'] = Colecciones::find($id);
            $data['imagenes'] = $recursos->getExplodeImagenes($data['coleccion']->imagen);
            $data['listProductos'] = $recursos->getExplodeProductos($data['coleccion']->productos);
        }
        $data['header'] = view('admin/layout/header');
        $data['productos'] = Producto::where('estado', 1)->orderBy('created_at', 'desc')->limit(20)->get();
        return view('admin/layout/form_coleccion', $data);
    }

    public function allCategorias()
    {
        $data['categorias'] = Categoria::where('estado', 1)->get();
        $data['header'] = view('admin/layout/header');
        return view('admin/layout/categorias', $data);
    }

    public function allColor()
    {
        $data['color'] = Color::where('estado', 1)->get();
        $data['header'] = view('admin/layout/header');
        return view('admin/layout/colores', $data);
    }

    public function allTalla()
    {
        $data['talla'] = Talla::where('estado', 1)->get();
        $data['header'] = view('admin/layout/header');
        return view('admin/layout/tallas', $data);
    }


    public function allProductos()
    {
        $data['productos'] = Producto::where('estado', 1)->paginate(10);
        $data['header'] = view('admin/layout/header');
        return view('admin/layout/productos', $data);
    }

    public function formCategoria(Request $request, $id = null)
    {
        if (!is_null($id))
            $data['categoria'] = Categoria::where('id', $id)->first();
        $data['header'] = view('admin/layout/header');
        return view('admin/layout/formCategoria', $data);
    }

    public function formColor(Request $request, $id = null)
    {
        if (!is_null($id))
            $data['color'] = Color::where('id', $id)->first();
        $data['header'] = view('admin/layout/header');
        return view('admin/layout/formColor', $data);
    }

    public function verVenta(Request $request, $id = null)
    {

        // $empresas = ShoppingCart::get_shopping_cart();
        // return response()->json($empresas);
        $data['ventas'] = ShoppingCart::get_shopping_cart();
        $data['header'] = view('admin/layout/header');
        return view('admin/layout/verVenta', $data);
    }

    public function allVenta($tipo = null){      
        try {
          $ventas = ShoppingCart::get_shopping_cart();

          foreach($ventas as $item){
              if($item->created_at != null)
                $item->created_at =  date("Y/m/d",strtotime($item->created_at));
              if($item->TotalAmount != null)
                $item->TotalAmount = $item->TotalAmount/100;
          }

          return response()->json($ventas);
        } catch (\Exception $e) {
          return response()->json([
            'ventas' => null,
            'status' => false,
            'error' => $e->getMessage()
          ], 500);
        }
      }

    public function extraVenta(Request $request){      
        try {
          $empresas = ShoppingCart::get_shopping_extra($request->id_venta);
          return response()->json($empresas);
        } catch (\Exception $e) {
          return response()->json([
            'empresas' => null,
            'status' => false,
            'error' => $e->getMessage()
          ], 500);
        }
      }

    public function productosVenta(Request $request){      
        try {
          $productos = ShoppingProduct::get_shopping_productos($request->id_venta);
          foreach($productos as $item){
            if($item->productAmount != null)
              $item->productAmount = $item->productAmount/100;
        }
          return response()->json($productos);
        } catch (\Exception $e) {
          return response()->json([
            'productos' => null,
            'status' => false,
            'error' => $e->getMessage()
          ], 500);
        }
      }

    public function formTalla(Request $request, $id = null)
    {
        if (!is_null($id))
            $data['talla'] = Talla::where('id', $id)->first();
        $data['header'] = view('admin/layout/header');
        return view('admin/layout/formTalla', $data);
    }

    public function saveCategoria(Request $request)
    {
        try {
            switch ($request->status) {
                case 'new':
                    $data = new Categoria;
                    $data->nombre = $request->nombre;
                    $data->alias = Str::slug($request->nombre, '-');
                    $data->save();
                    return Redirect::route('allCategorias')->with(['type' => 'success', 'message' => 'Categoria guardado correctamente']);
                    break;
                case 'edit':
                    $data = Categoria::find($request->id);
                    $data->nombre = $request->nombre;
                    $data->alias = Str::slug($request->nombre, '-');
                    $data->save();
                    return Redirect::route('allCategorias')->with('status', 'Categoria guardado correctamente');
                    break;
            }
        } catch (\Exception $e) {
            dd($e->getMessage());   // insert query
        }
    }

    public function saveColor(Request $request)
    {
        try {
            switch ($request->status) {
                case 'new':
                    $data = new Color;
                    $data->nombre = $request->nombre;
                    $data->codigo_hexa = $request->codigoColor;
                    $data->save();
                    return Redirect::route('allColor')->with(['type' => 'success', 'message' => 'Color guardado correctamente']);
                    break;
                case 'edit':
                    $data = Color::find($request->id);
                    $data->nombre = $request->nombre;
                    $data->codigo_hexa = $request->codigoColor;
                    $data->save();
                    return Redirect::route('allColor')->with('status', 'Color guardado correctamente');
                    break;
            }
        } catch (\Exception $e) {
            dd($e->getMessage());   // insert query
        }
    }


    public function saveTalla(Request $request)
    {
        try {
            switch ($request->status) {
                case 'new':
                    $data = new Talla;
                    $data->medida = $request->medida;
                    $data->save();
                    return Redirect::route('allTalla')->with(['type' => 'success', 'message' => 'Talla guardado correctamente']);
                    break;
                case 'edit':
                    $data = Talla::find($request->id);
                    $data->medida = $request->medida;
                    $data->save();
                    return Redirect::route('allTalla')->with('status', 'Talla guardado correctamente');
                    break;
            }
        } catch (\Exception $e) {
            dd($e->getMessage());   // insert query
        }
    }

    public function saveColeccion(Request $request)
    {
        try {
            \DB::beginTransaction();
            if ($request->id !== "0") {
                $data = Colecciones::find($request->id);
            } else {
                $data = new Colecciones();
            }
            $data->titulo = $request->titulo;
            $data->descripcion = $request->descripcion;
            $data->productos = $request->productos;
            $data->imagen = $request->imagen;
            $data->estado = 1;
            $data->slug = Str::slug($request->titulo, '-');
            $data->save();
            \DB::commit();
            return response()->json(['ok' => true, 'message' => 'Producto guardado correctamente'], 200);
        } catch (\Exception $e) {
            \DB::rollback();
            dd($e->getMessage());   // insert query
        }
    }

    public function _NumeroOrden($result = null)
    {
        $nunero = \DB::table('numerador')->select(\DB::raw("LPAD(max(orden)+1,8,'0') as codigo"))->get();
        $result = \DB::table('numerador')->insertGetId(
            [
                'ORDEN' => $nunero[0]->codigo,
                'SERIE' => '001'
            ]
        );
        return $result;
    }

    public function formProducto($id = null)
    {
        $recursos = new RecursosController();
        if (!is_null($id)) {
            $data['producto'] = Producto::find($id);
            $data['imagenes'] = $recursos->getExplodeImagenes($data['producto']->imagenes);
        }
        $data['colores'] = Color::where('estado', 1)->get();
        $data['tallas'] = Talla::where('estado', 1)->get();
        $data['categorias'] = Categoria::where('estado', 1)->get();
        $data['header'] = view('admin/layout/header');
        return view('admin/layout/formProducto', $data);
    }


    public function saveProducto(Request $request)
    {
        
        
        try {
            \DB::beginTransaction();
            if ($request->id !== "0") {
                $data = Producto::find($request->id);
            } else {
                $data = new Producto();
            }
            $data->titulo = $request->titulo;
            $data->idCategoria = $request->categoria;
            $data->despachoDomicilio = $request->DespachoDomicilio;
            $data->despachoTienda = $request->DespachoTienda;
            $data->descripcion = $request->descripcion;
            $data->descripcionCompleta = $request->descripcionCompleta;
            $data->precio = $request->precio;
            $data->tallas = CodebelHelpers::addSeparador($request->tallas, '|');
            $data->imagenes = $request->fotos;
            $data->colores = CodebelHelpers::addSeparador($request->colores, '|');
            $data->tags = $request->tags;
            $data->estado = 1;
            $data->slug = Str::slug($request->titulo, '-');
            $data->save();
            \DB::commit();
            return response()->json(['ok' => true, 'message' => 'Producto guardado correctamente'], 200);
        } catch (\Exception $e) {
            \DB::rollback();
            dd($e->getMessage());   // insert query
        }
    }

    public function deleteProducto(Request $request)
    {
        \DB::beginTransaction();
        try {
            $data = Producto::find($request->id);
            $data->estado = 0;
            $data->save();
            \DB::commit();
            return response()->json(['ok' => true, 'message' => 'Producto eliminado correctamente'], 200);
        } catch (\Exception $e) {
            \DB::rollback();
            dd($e->getMessage());
        }
    }

    public function deleteCategoria(Request $request)
    {
        \DB::beginTransaction();
        try {
            $data = Categoria::find($request->id);
            $data->estado = 0;
            $data->save();
            \DB::commit();
            return response()->json(['ok' => true, 'message' => 'Categoría eliminado correctamente'], 200);
        } catch (\Exception $e) {
            \DB::rollback();
            dd($e->getMessage());
        }
    }

    public function deleteColor(Request $request)
    {
        \DB::beginTransaction();
        try {
            $data = Color::find($request->id);
            $data->estado = 0;
            $data->save();
            \DB::commit();
            return response()->json(['ok' => true, 'message' => 'Color eliminado correctamente'], 200);
        } catch (\Exception $e) {
            \DB::rollback();
            dd($e->getMessage());
        }
    }

    public function deleteTalla(Request $request)
    {
        \DB::beginTransaction();
        try {
            $data = Talla::find($request->id);
            $data->estado = 0;
            $data->save();
            \DB::commit();
            return response()->json(['ok' => true, 'message' => 'Talla eliminado correctamente'], 200);
        } catch (\Exception $e) {
            \DB::rollback();
            dd($e->getMessage());
        }
    }

    public function deleteColeccion(Request $request)
    {
        \DB::beginTransaction();
        try {
            $data = Colecciones::find($request->id);
            $data->estado = 0;
            $data->save();
            \DB::commit();
            return response()->json(['ok' => true, 'message' => 'Producto eliminado correctamente'], 200);
        } catch (\Exception $e) {
            \DB::rollback();
            dd($e->getMessage());
        }
    }


    public function allColecciones(Request $request)
    {
        $data['colecciones'] = Colecciones::where('estado', 1)->paginate(10);
        $data['header'] = view('admin/layout/header');
        return view('admin/layout/colecciones', $data);
    }

    public function productoById(Request $request)
    {
        $recursos = new RecursosController();
        $id = $request->id;
        $data = Producto::find($id);
        $data->nameCategoria = Categoria::find($data->idCategoria)->nombre;
        $data->urlImagenCopleta = $recursos->getExplodeImagenes($data->imagenes);
        return response()->json(['ok' => true, 'result' => $data], 200);

    }

}
