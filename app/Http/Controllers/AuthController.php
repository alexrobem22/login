<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCadastroUserRequest;
use App\Models\User;

class AuthController extends Controller
{
    //

    public function login(Request $request){

        $email = $request->input('email');

        $user = User::where('email', $email)->where('status', 'ativado')->first();

        $credenciais = $request->all(['email','password']);

        // autenticação (email e senha)
        $token = auth('api')->attempt($credenciais);

        if($token){

            return response()->json(['token' => $token], 200);

        }else{

            return response()->json(['error' => 'Invalid username or password'], 403);
            // 401 = Unauthorized -> não autorixado
            // 403 = forbidden -> proibido (login invalido)
        }
    }

    public function logout(){
        dd('logout');
    }

    public function store(StoreCadastroUserRequest $request){

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $nivel_acesso = $request->input('nivel_acesso');
        $status = $request->input('status');
        $platform = $request->input('platform');
        $idTokenGoogle = $request->input('id_token_google');

        if($platform == 'desktop'){

            $cadastro = User::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
                'id_token_google' => 'null' ,
                'nivel_acesso' => ($nivel_acesso) ? $nivel_acesso : 'usuario',
                'status' => ($status) ? $status : 'ativado',
                'platform' => 'desktop'
            ]);

        }elseif($platform == 'app'){

            $cadastro = User::create([
                'name' => ($name) ? $name : 'null',
                'email' => ($email) ? $email : 'null',
                'id_token_google' => $idTokenGoogle ,
                'password' => ($password) ? bcrypt($password) : 'null',
                'nivel_acesso' => ($nivel_acesso) ? $nivel_acesso : 'usuario',
                'status' => ($status) ? $status : 'ativado',
                'platform' => 'app'
            ]);

        }

        return response()->json(['message' => 'Cadastrado com Sucesso'], 200);


    }
    public function adm(){

        $user = auth()->user();

        dd('adm',$user);
    }

    public function usuario(){

        $user = auth()->user();

        dd('usuario', $user);
    }
}
