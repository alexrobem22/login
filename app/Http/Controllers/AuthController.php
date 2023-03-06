<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //

    public function login(Request $request){

        $email = $request->input('email');
        $password = $request->input('password');
        $id_token_google = $request->input('id_token_google');

        $userDesktop = User::where('email', $email)->where('status', 'ativado')->first();
        $userMobile = User::where('id_token_google', $id_token_google)->where('status', 'ativado')->first();

        if($userDesktop && $userMobile == null && $password){

            $credenciais = $request->all(['email','password']);

            // autenticação (email e senha)
            $token = auth('api')->attempt($credenciais);

            if($token){

                return response()->json(['token' => $token, 'user' => $userDesktop], Response::HTTP_OK);

            }else{

                return response()->json(['error' => 'Invalid username or password'], Response::HTTP_FORBIDDEN);
                // 401 = Unauthorized -> não autorixado
                // 403 = forbidden -> proibido (login invalido) 

            }

        }elseif($userMobile){

            $token = JWTAuth::fromUser($userMobile);
            // dd('userMobile',$token,$userMobile);
            if($token){

                return response()->json(['token' => $token, 'usuario' => $userMobile], Response::HTTP_OK);

            }else{

                return response()->json(['error' => 'Invalid username or password'], Response::HTTP_FORBIDDEN);
                // 401 = Unauthorized -> não autorixado
                // 403 = forbidden -> proibido (login invalido) 

            }

        }else{

            return response()->json(['error' => 'some parameter to be passed is missing or your account is deactivated'], Response::HTTP_FORBIDDEN);
            // 401 = Unauthorized -> não autorixado
            // 403 = forbidden -> proibido (login invalido) 

        }

    }

    public function logout(){

        auth('api')->logout();
        return response()->json(['msg' => 'Logout was successful'], Response::HTTP_OK);

    }

}
