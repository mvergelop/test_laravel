<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdatePasswordRequest extends Request
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


    public function messages()
    {
        return [
                'password.required'          => '<b>Contraseña</b> es requerido',
                'password2.required'          => '<b>Contraseña</b> es requerido',
                'password.same'          => 'Las <b>Contraseñas</b> deben ser iguales'

            ];
    }

    public function rules()
    {
        return ['password' => 'required|same:password2'];
    }
}
