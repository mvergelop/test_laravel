<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Validator;

use Auth;

class UserCreateRequest extends Request
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
  

    public function messages()
    {
        return [
                'name.required'          => '<b>Nombre</b> es requerido',                
                'tipo.required'          => '<b>Tipo Usuario</b> es requerido',
                'tipo_licencia.required' => '<b>Tipo Licencia</b> es requerido',
                'login.required'         => '<b>Usuario</b> es requerido',
                'login.without_spaces'          => '<b>Usuario</b> no debe poseer espacios',
                'login.size'             => '<b>Usuario</b> debe tener almenos (5) caracteres',
                'login.unique'         => '<b>Usuario</b> ya se encuentra registrado, intente uno diferente',
                'email.required'         => '<b>E-Mail</b> es requerido',
                'email.unique'         => '<b>E-Mai</b> ya se encuentra registrado, intente uno diferente',
                'email.email'         => '<b>E-Mai</b> debe tener un formato valido, Ej. <b>info@netus.com.ve</b>',
                'password.required'          => '<b>Contraseña</b> es requerida',
                'password.same'          => 'Las <b>Contraseñas</b> deben ser iguales'

            ];
    }

    public function rules()
    {
        Validator::extend('without_spaces', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });

        if (Auth::check()) {

            if (Auth::user()->tipo == '1'){
                $rules = ['name'     => 'required',
                          'tipo'     => 'required',
                          'tipo_licencia' => 'required'];

            } else {
                $rules = ['name'     => 'required'];

            }
        }else {
            $rules = ['name'     => 'required'];            
        }

        


        if (!$this->has('id')){

            $rules += ['email'    => 'required|email|unique:usuarios,email',
                       'password' => 'required|same:password2'];

        }


        return $rules;
        
    }
}
