<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ConfigRequest extends Request
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
        return ['contacto.email'         => '<b>Contacto</b> debe tener un formato valido, Ej. <b>info@netus.com.ve</b>',
                'contacto.required'         => '<b>Contacto</b> es requerido, Ej. <b>info@netus.com.ve</b>'];
    }
     
    
    public function rules()
    {
        return ['contacto'    => 'required|email'];
    }
}
