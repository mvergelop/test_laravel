<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CondominioRequest extends Request
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
                'nombre.required'          => '<b>Nombre</b> es requerido',                
                'ciudad.required'          => '<b>Ciudad</b> es requerido',                
                'periodo.required'          => 'El <b>Periodo Inicial</b> es requerido',
                'periodo.same'          => 'Los <b>Periodos Iniciales</b> deben ser iguales'

            ];
    }

    public function rules()
    {
          $rules = ['nombre'     => 'required',
                    'ciudad'     => 'required'];


        if (!$this->has('id')){

            $rules += ['periodo' => 'required|same:periodo2',
                       'periodo2'=> 'required'];

        }


        return $rules;
    }
}
