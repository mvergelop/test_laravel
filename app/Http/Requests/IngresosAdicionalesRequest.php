<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class IngresosAdicionalesRequest extends Request
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
                'tipogasto.required'            => '<b>Tipo de Gastos</b> es requerido',
                'descripcion.required'          => '<b>Descripcion</b> es requerido',
                'descripcion.unique'            => '<b>Descripcion</b> ya se encuentra registrado, intente uno diferente'
            ];
    }
    public function rules()
    {
        return ['descripcion' => 'required|unique:ingresos_adicionales,descripcion,'.$this->id.',id,id_condominio,'. Auth::user()->id_condominio];
    }
}
