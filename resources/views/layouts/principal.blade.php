<!DOCTYPE html>

<html lang="en">



  



  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- Meta, title, CSS, favicons, etc. -->

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">





    <title id="title">



        @section ('titulo') 

          @if (Auth::check())

            @if (isset(Auth::user()->nombre_condominio))

              NETUS.COM.VE - {{Auth::user()->nombre_condominio}}

            @else 

              NETUS.COM.VE 

            @endif 

          @else

            NETUS.COM.VE 

          @endif 

          





        @show





    </title>



    <!-- Bootstrap -->

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">    

    <!-- NProgress -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" rel="stylesheet">





    



    <!-- bootstrap-progressbar -->

    <link href="{{env('ROUTE_CSSJS') }}vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">   

    <!-- bootstrap-daterangepicker -->

    <link href="{{env('ROUTE_CSSJS') }}vendors/bootstrap-daterangepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet"> 



    



    <!-- Custom Theme Style -->



    <link href="{{env('ROUTE_CSSJS') }}build/css/custom.min.css" rel="stylesheet">

    <link href="{{env('ROUTE_CSSJS') }}css/custom.css" rel="stylesheet">

    <link href="{{env('ROUTE_CSSJS') }}css/bootstrap-checkbox.css" rel="stylesheet">



    <link href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css" rel="stylesheet">



    



    @section ('csslinks')

    @show 



    <link href="{{env('ROUTE_CSSJS') }}css/pnotify.custom.min.css" rel="stylesheet">

    

    

  </head>



  <body class="nav-md">

    <div class="container body">

      <div class="main_container" style="height: 850px;">

        <div class="col-md-3 left_col">

          @section('menu')

          @show

        </div>



        <!-- top navigation -->

        <div class="top_nav">

          @section ('usuario')

          @show

        </div>

        <!-- /top navigation -->



        <!-- page content -->
        

          <div style="padding: 10px 20px 0;margin-left: 230px;background: #F7F7F7;min-height:  100%">

            <!-- top tiles -->

              @section ('contenido')

              @show

          </div>
        

        <!-- /page content -->



        <!-- footer content -->

        

          <footer class="footernetus">

            <div class="col-md-2 col-sm-3 col-xs-6"><a style="color: #e1e1e2;" href="{{env('ROUTE_CSSJS') }}storage/Terminos_y_Condiciones.pdf">Terminos y Condiciones</a></div>

            <div class="col-md-2 col-sm-3 col-xs-6"><a style="color: #e1e1e2;" href="{{env('ROUTE_CSSJS') }}contacto">Contacto</a></div>

            <div class="col-md-2 col-sm-3 col-xs-6"><a style="color: #e1e1e2;" href="{{env('ROUTE_CSSJS') }}ayuda">Preguntas Frecuentes</a></div>

            @if(Auth::check())

              @if (Auth::user()->tipo == '2')

                @if (Auth::user()->dias_licencia > 0)

                  @if (Auth::user()->dias_licencia > 15)

                    <div class="col-md-4 col-sm-3 col-xs-12">Licencia {{Auth::user()->tipo_licencia}} (Hasta {{Auth::user()->max_inmuebles}} Inmuebles) - Vencimiento : {{Auth::user()->dias_licencia}} dias</div>

                  @else

                    <div class="col-md-4 col-sm-3 col-xs-12">Licencia {{Auth::user()->tipo_licencia}} (Hasta {{Auth::user()->max_inmuebles}} Inmuebles) - Vencimiento : <b style="color: #FFA500;">{{Auth::user()->dias_licencia}} dias</b></div>

                  @endif 

                @else 

                  <div class="col-md-4 col-sm-3 col-xs-12">Licencia {{Auth::user()->tipo_licencia}} (Hasta {{Auth::user()->max_inmuebles}} Inmuebles) - Vencimiento : <b style="color: red;">Vencida</b></div>

                @endif 

              @endif 

             

            @endif 

            </div>   

            </div>

            <div class="clearfix"></div>

          </footer>

          

        <!-- /footer content -->

      </div>

    </div>



    <!-- jQuery -->



    

    

    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <!-- Bootstrap -->

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- NProgress -->

    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>

    

    

    <!-- bootstrap-progressbar -->



    

    

    <!-- bootstrap-daterangepicker -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>

    <script src="{{env('ROUTE_CSSJS') }}vendors/bootstrap-daterangepicker/dist/js/bootstrap-datepicker.js"></script>



    <!-- Custom Theme Scripts -->

    <script src="{{env('ROUTE_CSSJS') }}build/js/custom.min.js"></script>   





    <script src="{{env('ROUTE_CSSJS') }}js/common.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>



    

    

    



    <!-- Flot -->

    @section ('jsscripts')

    @show

    <script src="{{env('ROUTE_CSSJS') }}js/pnotify.custom.min.js"></script>



    @section ('jspnotify')

    @show

    <script type="text/javascript">
        $(document).ready(function (){
            PNotify.prototype.options.styling = "fontawesome";
        });
    </script>

    

    @if (Session::has('notify-body'))

      <script type="text/javascript">



        $(document).ready(function(){



          new PNotify({

                  title: '<b>{{ Session::get('notify-head')}}</b>',

                  text: '{{ Session::get('notify-body')}}',

                  type: 'success'

              });

        });

        

      </script>



    @endif 



    @if (Session::has('notify-body-error'))

      <script type="text/javascript">



        $(document).ready(function(){



          new PNotify({

                  title: '<b>{{ Session::get('notify-head-error')}}</b>',

                  text: '{{ Session::get('notify-body-error')}}',

                  type: 'error'

              });

        });

        

      </script>



    @endif 



   



    

  </body>

</html>



