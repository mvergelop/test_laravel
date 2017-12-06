<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


//Librerias
use Mail;
use Storage;
use Url;
use DB;


//Tablas y Vistas 
use App\User;
use App\Condominios;
use App\ViewPeriodosCerrados;
use App\UltimosPeriodosCerrados;
use App\Config;
use App\Email;
use App\Gastos;
use App\Sesiones;
use App\Periodos;
use App\CuotasOrdinarias;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //Tarea de Correos 
        $schedule->call(function () {

            $emails= Email:: where ('enviado','0')                        
                          -> get();
  
            

            foreach ($emails as $email) {

                $idmail = 0;


                switch ($email->tipo) {
                    case '100':
                        
                        $usuario = User:: where ('login',$email->parms1)
                                       -> first(); 

                        $config = Config:: select ('adjunto1_filename','adjunto2_filename','adjunto1')
                                        -> first();

                        if (Mail::send('emails.userreg',['usuario'=>$usuario] , function ($message) use ($email,$usuario,$config) {
                            $message->from('info@netus.com.ve', 'Netus, Control de Condominio');
                            $message->subject('Validacion netus.com.ve');

                            $message->to($usuario->email);
                            $message->attach(env('ROUTE_CSSJS').'storage/'.$config->adjunto1_filename);
                            $message->attach(env('ROUTE_CSSJS').'storage/'.$config->adjunto2_filename);
                            Email:: where ('id',$email->id)
                                 -> update (['enviado' => '1']);
                        })) {
                          $idmail = $email->id;
                        }
                        break;
                    case '110':
                        if (Mail::send('emails.lostpassword',['email'=>$email] , function ($message) use ($email) {
                            $message->from('info@netus.com.ve', 'Netus, Control de Condominio');
                            $message->subject('Recuperar su Contraseña netus.com.ve');

                            $message->to($email->parms1);
                            
                        })) {
                          $idmail = $email->id;
                        }
                        
                        break;
                    case '120':
                        if (Mail::send('emails.cierreperiodo',['email'=>$email] , function ($message) use ($email) {
                            $message->from('info@netus.com.ve', 'Netus, Control de Condominio');
                            $message->subject($email->asunto);

                            $message->to('melvin.vergel@gmail.com');
                            
                        })) {
                          $idmail = $email->id;
                        }
                        
                        break;

                    case '130':
                        $contacto = Config:: select ('contacto')
                                          -> first()->contacto;
                        if (Mail::send('emails.contacto',['email'=>$email] , function ($message) use ($email,$contacto) {
                            $message->from('info@netus.com.ve', 'Netus, Control de Condominio');
                            $message->subject('Contacto : ' . $email->asunto);
                            $message->to($contacto); // Correo Contacto Netus Configuracion
                            //$message->replayTo($email->para , $email->parms1);
                            
                        })) {
                          $idmail = $email->id;
                        }
                        
                        break;
                }
                if ($idmail > 0 ){
                  Email:: where ('id',$idmail)
                                 -> update (['enviado' => '1']);
                }

            }   
        })->everyMinute();

        //Valida la informacion de los gastos del sistema y los copia a cada condominio 
        $schedule->call(function () {

          $gastos = Gastos:: where ('id_condominio',0)
                          -> get ();

          $condominios = Condominios:: select('id') 
                                     ->get();


          foreach ($gastos as $gasto) {

            Gastos:: where ('id_base',$gasto->id)
                  -> update(['id_tipogasto' => $gasto->id_tipogasto,
                             'descripcion'  => $gasto->descripcion,
                             'activo'       => $gasto->activo]);


            foreach ($condominios as $condominio) {

              $cant = 0;
              $cant = Gastos:: where ('id_base',$gasto->id)
                            -> where ('id_condominio',$condominio->id)
                            -> count();

              if ($cant == 0){
                Gastos:: create(['id_tipogasto'  => $gasto->id_tipogasto,
                                 'descripcion'   => $gasto->descripcion,
                                 'activo'        => $gasto->activo,
                                 'id_base'       => $gasto->id,
                                 'id_condominio' => $condominio->id]);
              }              
            }
          }
        })->dailyAt('02:00'); //->everyMinute();

        //Limpia Sesiones 
        $schedule->call(function () {

          Sesiones:: where (DB::RAW(' datediff(curdate(),created_at)'),'>',2)
                  -> delete ();


        })->dailyAt('04:00');

        //Crea Periodos Nuevos
        $schedule->call(function () {

            $aniomax = ViewPeriodosCerrados:: select (DB::RAW ('max(YEAR(fecha_inicio)) anio'))
                                           -> first()->anio;
            $cant = 0;
            $cant = ViewPeriodosCerrados:: where ('fecha_inicio',$aniomax.'1101')
                                        -> count();  

            if ($cant > 0 ){
                for ($i=1 ; $i <=12  ; $i++ ) { 

                    CuotasOrdinarias:: create([ 'aaaa' => $aniomax+1,
                                                'mes'  => $i
                                              ]);
                    
                }
            }
        })->dailyAt('04:30');

        

        
    }
}
