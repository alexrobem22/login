<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreCadastroUserAdmRequest extends FormRequest
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

        return [
            'name' => 'required|min:4',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|min:4|max:10',
            'password_confirmation' => 'required|min:4|max:10|same:password',
            'user_image' => 'required|numeric|between:1,8',
            'nivel_acesso' => 'required|in:adm,usuario',
            'status' => 'required|in:ativado,desativado'
        ];

            

        

    }
    public function messages(){

        return [
            'nivel_acesso.in' => 'the :attribute field can only be adm or usuario',
            'status.in' => 'the :attribute field can only be ativado or desativado'

        ];

    }
    
}
