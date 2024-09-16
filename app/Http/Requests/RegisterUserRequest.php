<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'required|string',
            'sobrenome' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'modulo' => 'required|string',
            'password' => 'required|string',
            'whatsapp' => 'required|string|unique:users,telefone',
            'password_confirm' => 'required|string',
        ];
    }
    
    public function messages(){
        return [
            'nome.required' => 'Nome é obrigatório',
            'sobrenome.required' => 'Sobrenome é obrigatório',
            'email.required' => 'E-mail é obrigatório',
            'email.unique' => 'E-mail já cadastrado em nosso sistema',
            'whatsapp.unique' => 'Telefone já cadastrado em nosso sistema',
            'modulo.required' => 'Modulo é obrigatório',
            'whatsapp.required' => 'Whatsapp é obrigatório',
            'password.required' => 'Senha é obrigatória',
            'password_confirm.required' => 'Confirmação de senha é obrigatória',
        ];
    }
}
