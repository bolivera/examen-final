<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
     */

    use SendsPasswordResetEmails;

    // Añadimos las respuestas JSON, ya que el Frontend solo recibe JSON
    // public function sendResetLinkEmail(Request $request)
    // {
    //     $this->validate($request, ['email' => 'required|email']);

    //     $response = $this->broker()->sendResetLink(
    //         $request->only('email')
    //     );
    //     //  dd($response);
    //     switch ($response) {
    //         case \Password::INVALID_USER:
    //             return response()->error($response, 422);
    //             break;

    //         case \Password::INVALID_TOKEN:
    //             return response()->error($response, 422);
    //             break;

    //         case \Password::RESET_THROTTLED:
    //             return response()->error($response, 422);
    //             break;
    //         default:
    //             return response()->json($response, 200);
    //     }
    // }

}
