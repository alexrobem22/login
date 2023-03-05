<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateCadastroUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $id = $this->route()->parameter('id');

        $password = $request->input('password');

        if($password){
            return [
                'name' => 'min:4',
                'email' => 'email:rfc,dns|unique:users,email,'.$id,
                'password' => 'min:4|max:10',
                'password_confirmation' => 'min:4|max:10|same:password',
                'user_image' => 'numeric|between:1,8',
                'nivel_acesso' => 'in:adm,usuario',
                'status' => 'in:ativado,desativado'
            ];
        }else{
            return [
                'name' => 'min:4',
                'email' => 'email:rfc,dns|unique:users,email,'.$id,
                'user_image' => 'numeric|between:1,8',
                'nivel_acesso' => 'in:adm,usuario',
                'status' => 'in:ativado,desativado'
            ];
        }


    }
    // essa function eu posso personalizar a mensagem da resposta do rules
    public function messages(){
        return [
            'nivel_acesso.in' => 'the :attribute field can only be adm or usuario',
            'status.in' => 'the :attribute field can only be ativado or desativado'
        ];
    }
}
