@extends('layouts.principal')





@section ('csslinks')

  <link href="{{env('ROUTE_CSSJS') }}css/responsive.bootstrap.min.css" rel="stylesheet">

  <link href="{{env('ROUTE_CSSJS') }}css/jquery.dataTables.min.css" rel="stylesheet">



  <style type="text/css">

    

    td.details-control {

        background: url('{{env('ROUTE_CSSJS') }}images/details_open.png') no-repeat center center;

        cursor: pointer;

    }

    tr.shown td.details-control {

        background: url('{{env('ROUTE_CSSJS') }}images/details_close.png') no-repeat center center;

    }



  </style>



    



@stop 







@section('menu')    

    @if ($tipomenu == '2')

      @include('layouts.menu1')  

    @else 

      @include('layouts.menu_user3')  

    @endif 

@stop



@section('usuario')    

    @include ('layouts.usuariotoolbar')

@stop





@section ('contenido')



  <div class="col-md-12 col-sm-12 col-xs-12">

      <div class="x_panel">

        <div class="x_title">

          <h2>Relacion de Ingresos por Inmueble</h2>

          <div class="clearfix"></div>

        </div>

        <div class="x_content">

        <h2>Ingresos Ordinarios</h2>

         <table id="ordinarios" class="table table-striped table-bordered" cellspacing="0" width="100%">

             <thead>

                  <tr>

                    <th tabindex="0" width="3%"></th>

                    <th>Inmueble</th>                                

                    <th>Monto</th>

                    <th>%</th>

                  </tr>

              </thead>

              <tbody>

                <tr>

                    <th tabindex="0" width="3%"></th>

                    <th>Inmueble</th>                                

                    <th>Monto</th>

                    <th>%</th>

                  </tr>

              </tbody>

          </table>

        </div>

        <div class="x_content">

         <table id="extraordinarios" class="table table-striped table-bordered" cellspacing="0" width="100%">

             <thead>

                  <tr>

                    <th tabindex="0" width="3%"></th>

                    <th>Inmueble</th>                                

                    <th>Monto</th>

                    <th>%</th>

                  </tr>

              </thead>

              <tbody>

                <tr>

                    <th tabindex="0" width="3%"></th>

                    <th>Inmueble</th>                                

                    <th>Monto</th>

                    <th>%</th>

                  </tr>

              </tbody>

          </table>

        </div>



      </div>

  </div>



  



@stop









@section ('jsscripts')  

    <script src="{{env('ROUTE_CSSJS') }}js/jquery.dataTables.min.js"></script>

    <script src="{{env('ROUTE_CSSJS') }}js/numeric-comma.js"></script>

    

    <script type="text/javascript">

        function format ( d ) {

            // `d` is the original data object for the row



            var string = '<table style="padding-left:100px;">'+

                        '<thead><th>Fecha</th><th>Detalle</th><th>Periodo</th><th>Monto</th></thead><tbody>'



            $.each(d.detalle, function (key,value) {

              string =string +  '<tr><td>'+fechamask(value.fecha)+'</td><td>'+value.detalle+'</td><td>'+value.periodocobrado+'</td><td>'+value.monto+'</td></tr>';

            })



            string = string+ '</tbody></table>';



            return string;

                

        }

         

        $(document).ready(function() {



            getnombrecondominio();

            //http://localhost/condosoft/public/

            var route = "{{env('URL_JSON')}}ingresosordinarios/2";

            var table = $('#ordinarios').DataTable({

                

            "order": [[ 1, "desc" ]],

              "ajax": {

                "url": route,

                "type": "get",

                "dataSrc": ""

                

              },

             

              /*"render": function ( data, type, full, meta ) {

                                                                            return currency(data,2,[',', "'", '.']);*/

              "columns": [

                    {

                        "className":      'details-control',

                        "orderable":      false,

                        "data":           null,

                        "defaultContent": ''

                    },

                    { "data": "inmueble" ,"orderData":0,"targets": 0},

                    { "data": "monto" ,"orderData":0,"targets": 0},

                    { "data": "porc" ,"orderData":0,"targets": 0}

                    

                    ],





              language: {

                    search: "Buscar:"

                }

                 

            });



            $('#ordinarios tbody').on('click', 'td.details-control', function () {

                var tr = $(this).closest('tr');

                var row = table.row( tr );

         

                if ( row.child.isShown() ) {

                    // This row is already open - close it

                    row.child.hide();

                    tr.removeClass('shown');

                }

                else {

                    // Open this row

                    row.child( format(row.data()) ).show();

                    tr.addClass('shown');

                }

            } );







            $(".dataTables_length select").addClass("form-control input-sm");

            $(".dataTables_filter input").addClass("form-control input-sm");



            



        } );



       

    </script>

    @include ('common_js.getnombrecondominio')

  

@stop 