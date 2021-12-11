<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RecursosController;
use App\Model\Categoria;
use App\Model\Producto;
use App\Model\Ubigeo;
use App\User;
use Helpers\CodebelHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class panelController extends Controller
{

    public function __construct()
    {
        $this->recursos = new RecursosController();
    }

    public function index()
    {

        $data['title'] = 'Bienvenido';
        $data['categorias'] = Categoria::where('estado', 1)->get();
        $data['header'] = view('pages.header', $data);
        $data['footer'] = view('pages.footer', $data);
        return view('pages.panel', $data);
    }

    public function perfil()
    {

        $recursos = new RecursosController();
        $data['title'] = 'Bienvenido' . Auth::user()->name;
        $data['usuario'] = User::find(Auth::user()->id);
        $data['departamentos'] = Ubigeo::whereRaw('codubigeo <> "00990000" and flag = "D"')->get();
        if (!empty($data['usuario']->ubigeo))
            $data['ubigeo'] = $recursos->_getUbigeo($data['usuario']->ubigeo);
        $data['categorias'] = Categoria::where('estado', 1)->get();
        $data['header'] = view('pages.header', $data);
        $data['footer'] = view('pages.footer', $data);
        return view('pages.perfil', $data);
    }

    public function cambiarPassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ], [
            'password.requerid' => 'La contraseña es obligatorio',
            'password.confirmed' => 'Las contraseñas no son iguales',
            'password.min' => 'La contraseña debe tener como mínimo 6 carácteres'
        ]);

        $data = User::find(Auth::user()->id);
        $data->password = Hash::make($request->password);
        $data->save();
        return redirect()->back()->with('success', 'contraseña actualizado correctamente');

    }

    public function actualizarDatos(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'direccion' => 'required',
            'departamento' => 'required',
            'provincia' => 'required',
            'distrito' => 'required'

        ], [
            'name.requerid' => 'Nombres son obligatorios',
            'direccion.requerid' => 'Direcicón es obligatorio',
            'departamento.requerid' => 'Departamento es obligatorio',
            'provincia.requerid' => 'Provincia es obligatorio',
            'distrito.requerid' => 'Distrito es obligatorio',
        ]);

        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->direccion = $request->direccion;
        $data->ubigeo = $request->departamento . $request->provincia . $request->distrito;
        $data->telefono = $request->telefono;
        $data->save();
        return redirect()->back()->with('success', 'Datos actualizados correctamente');

    }

    public function filter(Request $request)
    {
        $res = Producto::where('estado', 1);
        $res->select('titulo as title','imagenes');
        $data = $res->get();
        foreach ($data as $datum) {
            $datum->date = CodebelHelpers::generateMinutosCompra();
            $datum->image = $this->recursos->getExplodeImagenes($datum->imagenes);
        }
        return response()->json($data);
    }
}
