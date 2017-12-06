<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Validator;

class GeneraCuotaExtraRequest extends Request
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
                'cuotaordinaria.required'            => '<b>Cuota</b> es requerida',
                'cuotaordinaria.greater_than' => '<b>Cuota Extra</b> debe ser mayor a cero',
                'cantcuotas.required'            => '<b>Cantidad de Cuotas</b> es requerida',
                'cantcuotas.greater_than' => '<b>Cantidad de Cuotas</b> debe ser mayor a cero',
                
            ];
    }

   


    public function rules()
    {

        Validator::extend('greater_than', function($attribute, $value, $parameters)
            {
            return intval($value) > intval($parameters[0]);
            }
        );
        
        return [ 'cuotaordinaria' => 'required|greater_than:0',
                 'cantcuotas'     => 'required|greater_than:0'];
    }
}
