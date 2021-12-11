<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Socialite;
use Str;
use Hash;

class SocialAuthController extends Controller
{

    public function iniciar(Request $request)
    {
        $this->authAndRedirect($request);
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $token = csrf_token();
            $social_user = Socialite::driver($provider)->stateless()->user();
            if ($user = User::where('email', $social_user->email)->first()) {
                return $this->authAndRedirect($user, $token);
            } else {
                if ($social_user->getName() == null) {
                    $social_user->name = $social_user->nickname;
                }
                $user = User::create([
                    'name' => $social_user->name,
                    'email' => $social_user->email,
                    'avatar' => $social_user->avatar,
                    'password' => Hash::make(Str::random(24)),
                    'provider' => $provider
                ]);
                return $this->authAndRedirect($user,$token);
            }

        } catch (\Exception $e) {
            return redirect()
                ->route('loginCliente')
                ->with('mensaje_error', '¡Autenticación fallida. Por favor intente de nuevo!');
        }
    }

    public function authAndRedirect($user, $token = null)
    {
        try {

            $userdata = array(
                'email' => $user->email,
                'password' => $user->password
            );
            Auth::login($user, true);
            if (Auth::check()) {
                return redirect()->to('/mi-panel#');
            } else {
                return redirect()
                    ->route('loginCliente')
                    ->with('mensaje_error', '¡Autenticación fallida. Por favor intente de nuevo!');
            }
        } catch (\Exception $e) {
            return redirect()
                ->route('loginCliente')
                ->with('mensaje_error', '¡Autenticación fallida. Por favor intente de nuevo!');
        }
    }


}
