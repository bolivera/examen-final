<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\Categoria;
use Illuminate\Http\Request;

class LoginClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        $data['title'] = 'Iniciar sesión';
        $data['categorias'] = Categoria::where('estado', 1)->get();
        $data['header'] = view('pages.header',$data);
        $data['footer'] = view('pages.footer',$data);
        return view('pages.login', $data);
    }
}
