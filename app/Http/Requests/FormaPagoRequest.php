<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class FormaPagoRequest extends Request
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
                'descripcion.required'          => '<b>Descripcion</b> es requerido',
                'descripcion.unique'            => '<b>Descripcion</b> ya se encuentra registrado, intente uno diferente',
                'saldo_inicial.required'          => '<b>Saldo Inicial</b> es requerido',
                'saldo_inicial.numeric'          => '<b>Saldo Inicial</b> debe contener solo numeros',
                'saldo_inicial.same'         => 'Los <b>Saldos Iniciales</b> deben coincidir'
            ];
    }
    public function rules()
    {
        return ['descripcion' => 'required|unique:formas_pago,descripcion,'.$this->id.',id,id_condominio,'. Auth::user()->id_condominio,
                'saldo_inicial' => 'required|numeric|same:saldo_inicial2'
            
        ];
    }
}
