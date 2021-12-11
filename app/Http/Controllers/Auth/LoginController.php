<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;
class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      // dd(Auth::camping()->name);
        // $this->middleware('guest:administrator')->except('logout');
    }

    public function login(Request $data)
    {
        try {
            $user = DB::table('users')->where(['email' => $data->email])->first();
            if (empty($user)) {
                return Redirect::back()->withErrors(['email', 'Usuario no existe']);
            } else {
                $userdata = array(
                    'email' => $data->email,
                    'password' => $data->password
                );
                if (Auth::guard('administrator')->attempt($userdata, false, false)) {
                     return Redirect::to('/admin');
                } else {
                    return redirect('login')->withErrors(['email' => 'Contraseña incorrecta']);
                }
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }

}
