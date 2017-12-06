<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Condominios;
use Auth;
use Validator;

class InmuebleRequest extends Request
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

    /*'id_legal.required'          => '<b>Rif / C.I</b> es requerido',*/

    public function messages()
    {
        return ['tipo.required'          => '<b>Tipo Inmueble</b> es requerido',                
                'ocupante.required'          => '<b>Ocupante / Inquilino</b> es requerido',                
                'identificador.required' => '<b>Identificador</b> es requerido',
                'identificador.unique'         => '<b>Indentificador</b> ya se encuentra registrado, intente uno diferente',
                'saldo_inicial.required'         => '<b>Saldo Inicial</b> es requerido',
                'saldo_inicial.numeric'          => '<b>Saldo Inicial</b> debe contener solo numeros',
                'saldo_inicial.same'         => 'Los <b>Saldos Iniciales</b> deben coincidir',
                'porc_cuota.required' => '<b>Porcentaje de Cuotas</b> es requerido',
                'porc_cuota.greater_than' => '<b>Porcentaje de Cuotas</b> debe ser mayor o igual a "0"',
                'porc_cuota.lower_than' => '<b>Porcentaje de Cuotas</b> debe ser menor o igual a "100"',

            ];
    }

    


    public function rules()
    {

        Validator::extend('greater_than', function($attribute, $value, $parameters)
                {
                return intval($value) >= intval($parameters[0]);
                }
        );

        Validator::extend('lower_than', function($attribute, $value, $parameters)
                {
                return intval($value) <= intval($parameters[0]);
                }
        );
            
        

        if (!$this->has('id')){
            
            $rules = ['tipo'         => 'required',
                        'identificador'    => 'required|unique:inmuebles,identificador,'.$this->id.',id,id_condominio,'. Auth::user()->id_condominio,
                      'ocupante'         => 'required',
                      'id_legal'         => 'required',
                      'porc_cuota'       => 'required|greater_than:0|lower_than:100',
                      'saldo_inicial' => 'required|same:saldo_inicial2'];

        }else {
            $rules = ['ocupante'         => 'required',
                      'id_legal'         => 'required',
                      'porc_cuota'       => 'required|greater_than:0|lower_than:100',
                      'saldo_inicial' => 'required|numeric|same:saldo_inicial2'];
        }


        return $rules;
        

        
    }
}
