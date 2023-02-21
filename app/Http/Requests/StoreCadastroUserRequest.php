<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreCadastroUserRequest extends FormRequest
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
        $platform = $request->input('platform');

        if($platform == 'desktop'){

            return [
                'name' => 'required|min:4',
                'email' => 'email:rfc,dns|required|unique:users,email',
                'password' => 'required|min:4|max:10',
                'password_confirmation' => 'required|min:4|max:10|same:password'
            ];

        }elseif($platform == 'app'){

            return [
                'id_token_google' => 'required',
                'email' => 'email:rfc,dns|required|unique:users,email',

            ];

        }else{

            return [
                'platform' => 'required'
            ];



        }

    }
    public function messages(){
        return [
            'platform.required' => 'the :attribute field is mandatory'
        ];
    }
}
