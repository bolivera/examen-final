<?php

namespace App\Http\Controllers;

use App\Model\Categoria;
use App\Model\Colecciones;
use App\Model\Producto;
use Illuminate\Http\Request;
use App\Http\Controllers\RecursosController;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $fecha_actual = date('Y-m-d');
        $fecha_inicio = date("Y-m-d",strtotime($fecha_actual."- 15 days")); 

        $recursos = new RecursosController();
        $data['colecciones'] = Colecciones::where('estado',1)->get();
        foreach ($data['colecciones'] as $coleccione) {
            $coleccione->urlCompleta = $recursos->getExplodeImagenes($coleccione->imagen)[0]['urlCompleta'];
        }

        // $query = Producto::whereBetween('created_at', [$fecha_inicio, $fecha_actual]);
        $data['productos'] = Producto::where('estado',1)->orderBy('id', 'desc')->take(4)->get();
        foreach($data['productos'] as $productos ){
            $productos->urlCompleta = $recursos->getExplodeImagenes($productos->imagenes)[0]['urlCompleta'];
            $productos->categoria = Categoria::find($productos->idCategoria);
        }
        $data['title'] = 'Home';
        $data['categorias'] = Categoria::where('estado',1)->get();
        $data['header'] = view('pages.header',$data);
        $data['footer'] = view('pages.footer',$data);
        return view('home',$data);
    }
}
