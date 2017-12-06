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
    @include('layouts.menu1')  
@stop

@section('usuario')    
    @include ('layouts.usuariotoolbar')
@stop


@section ('contenido')

  <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Preguntas Frecuentes</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
         <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
             <thead>
                  <tr>
                    <th tabindex="0" width="3%"></th>
                    <th>Pregunta</th>                                
                  </tr>
              </thead>
              <tbody>
                <tr>
                    <th tabindex="0"></th>
                    <th>Pregunta</th>                                
                  </tr>
              </tbody>
          </table>
        </div>
      </div>
  </div>

  

@stop




@section ('jsscripts')  
    <script src="{{env('ROUTE_CSSJS') }}js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        function format ( d ) {
            // `d` is the original data object for the row
            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                '<tr>'+
                    '<td>'+d.respuesta+'</td>'+
                '</tr>'+
            '</table>';
        }
         
        $(document).ready(function() {



            var route = "{{env('URL_JSON')}}faqinfo";
            var table = $('#example').DataTable({
                
            "order": [[ 1, "desc" ]],
              "ajax": {
                "url": route,
                "type": "get",
                "dataSrc": ""
                
              },
              
              "columns": [
                    {
                        "className":      'details-control',
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": ''
                    },
                    { "data": "pregunta" ,"orderData":0,"targets": 0},
                    
                    ],
              language: {
                     "lengthMenu": "Mostrar _MENU_ registros por pagina",
                                "zeroRecords": "No se encontraron registros",
                                "info": "Pagina _PAGE_ de _PAGES_",
                                "infoEmpty": "No hay registros",
                                "infoFiltered": "(filtrados de un total _MAX_ registros)",
                                "search" :'Buscar',
                                "paginate": {
                                    "first":      "Primero",
                                    "last":       "Ultimo",
                                    "next":       "Siguiente",
                                    "previous":   "Anterior"}
                }
                 
            });

            $('#example tbody').on('click', 'td.details-control', function () {
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



             

        } );

       
    </script>

  
@stop 