



<?php









use App\GastosMov;

use App\CuotasInmuebles;

use App\ViewSaldosCuotasInmuebles;

use App\IngresosAdicionalesMov;

use App\Sesiones;







function getIdCondominio(){



    if (Auth::check()){

        $id_condominio = Auth::user()->id_condominio;

        $tipomenu = '2';

    }

    else {

        $sesion = Sesiones:: where ('sesion_id',Session::getId())

                          -> first();

        if (isset($sesion->id_condominio)){

            $id_condominio = $sesion->id_condominio;

            $tipomenu = '3';

        }else {

            $id_condominio = 0;

        }



    } 





    return array($id_condominio, $tipomenu);





}



	







	

function resumenGastosCondominio($idCondominio,$periodo){







    $gastos = GastosMov:: select (DB::raw("IFNULL(sum(monto),0) AS monto, 'Egresos' as titulo"))

                           -> where ('id_condominio',$idCondominio)

                           -> where ('fecha_proceso','>=', 

                                    DB::raw('(SELECT fecha_inicio FROM periodos_w  

                                    WHERE id = '.$periodo.' )'))

                           -> where ('fecha_proceso','<=',

                                  DB::raw('(SELECT fecha_final FROM periodos_w  

                                    WHERE id = '.$periodo.' )'))

                           -> first ();



    return $gastos;





}



function resumenCobrosCondominio($idCondominio,$periodo){



    



    $cobros = CuotasInmuebles:: select(DB::raw("IFNULL(sum(monto)*-1,0) AS monto, 'Cuotas Ordinarias Cobradas' as titulo"))

                                -> where ('id_condominio',$idCondominio)

                                -> where ('fecha_doc','>=', 

                                            DB::raw('(SELECT fecha_inicio FROM periodos_w  

                                            WHERE id = '.$periodo.' )'))

                                -> where ('fecha_doc','<=',

                                          DB::raw('(SELECT fecha_final FROM periodos_w  

                                            WHERE id = '.$periodo.' )'))

                                -> where ('monto','<',0)

                                -> where ('extra','0')

                                -> first ();



    return $cobros;







}



function resumenCobrosExtraCondominio($idCondominio,$periodo){



    



    $cobros = CuotasInmuebles:: select(DB::raw("IFNULL(sum(monto),0) AS monto, 'Ingresos por Cuotas Extraordinarias' as titulo"))

                                -> where ('id_condominio',$idCondominio)

                                -> where ('fecha_doc','>=', 

                                            DB::raw('(SELECT fecha_inicio FROM periodos_w  

                                            WHERE id = '.$periodo.' )'))

                                -> where ('fecha_doc','<=',

                                          DB::raw('(SELECT fecha_final FROM periodos_w  

                                            WHERE id = '.$periodo.' )'))

                                -> where ('monto','>',0)

                                -> where ('extra','1')

                                -> first ();



    return $cobros;







}















function resumenCobrosExtra($idCondominio,$periodo){



    



    $cobros = CuotasInmuebles:: select(DB::raw("IFNULL(sum(monto)*-1,0) AS monto, 'Ingresos por Cuotas Ordinarias' as titulo"))

                                -> where ('id_condominio',$idCondominio)

                                -> where ('fecha_doc','>=', 

                                            DB::raw('(SELECT fecha_inicio FROM periodos_w  

                                            WHERE id = '.$periodo.' )'))

                                -> where ('fecha_doc','<=',

                                          DB::raw('(SELECT fecha_final FROM periodos_w  

                                            WHERE id = '.$periodo.' )'))

                                -> where ('monto','<',0)

                                -> where ('extra','1')

                                -> first ();



    return $cobros;







}



function resumenMontoDevengado ($idCondominio,$periodo){



    $devengado = CuotasInmuebles:: select(DB::raw("IFNULL(sum(monto),0) AS monto, 'Ingresos Devengados' as titulo"))

                                -> where ('id_condominio',$idCondominio)

                                -> where ('id_periodo',$periodo)
                                -> where ('monto','>',0)

                                -> first ();



    return $devengado;



}





function getSaldoPeriodo($idCondominio,$periodo,$inmueble){



    

     

    if ($inmueble == 0 ){

        $saldo = ViewSaldosCuotasInmuebles:: select (DB::raw('sum(monto) as monto'))

                                -> where ('id_condominio',$idCondominio)

                                -> where ('cerrado',1)

                                -> first();

        

    }else {



        $saldo = ViewSaldosCuotasInmuebles:: select (DB::raw('sum(monto) as monto'))

                                -> where ('id_condominio',$idCondominio)

                                -> where ('id_periodo',$periodo)

                                -> where ('id_inmueble',$inmueble)

                                -> first();

    }



    

    return $saldo->monto;

    /*

    if (isset($saldo->monto))

        {}

    else 

        {return '0';}



   */



   

    

}





function totalGastoPeriodo($gasto,$periodo,$idCondominio){



  $gasto = GastosMov:: select (DB::raw("IFNULL(sum(monto),0) AS monto"))

                     -> where ('id_condominio',$idCondominio)

                     -> where ('fecha_doc','>=', 

                              DB::raw('(SELECT fecha_inicio FROM periodos_w  

                              WHERE id = '.$periodo.' )'))

                     -> where ('fecha_doc','<=',

                            DB::raw('(SELECT fecha_final FROM periodos_w  

                              WHERE id = '.$periodo.' )'))

                     -> where ('id_gasto',$gasto)

                     -> first ();



  return $gasto->monto;





}





?>