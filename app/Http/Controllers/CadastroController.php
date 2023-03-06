<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreCadastroUserRequest;
use App\Http\Requests\UpdateCadastroUserRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CadastroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCadastroUserRequest $request)
    {
        //
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $nivel_acesso = $request->input('nivel_acesso');
        $status = $request->input('status');
        $platform = $request->input('platform');
        $idTokenGoogle = $request->input('id_token_google');
        $user_image = $request->input('user_image');

        if($platform == 'desktop'){

            $cadastro = User::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
                'id_token_google' => 'null' ,
                'nivel_acesso' => ($nivel_acesso) ? $nivel_acesso : 'usuario',
                'status' => ($status) ? $status : 'ativado',
                'platform' => 'desktop',
                'user_image' => ($user_image) ? $user_image : '1'
            ]);

        }elseif($platform == 'app'){

            $cadastro = User::create([
                'name' => ($name) ? $name : 'null',
                'email' => ($email) ? $email : 'null',
                'id_token_google' => $idTokenGoogle ,
                'password' => ($password) ? bcrypt($password) : 'null',
                'nivel_acesso' => ($nivel_acesso) ? $nivel_acesso : 'usuario',
                'status' => ($status) ? $status : 'ativado',
                'platform' => 'app',
                'user_image' => ($user_image) ? $user_image : '1'
            ]);

        }

        return response()->json(['msg' => 'Registered successfully'], Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCadastroUserRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
