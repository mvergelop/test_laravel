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
          <h2>Cuentas por Cobrar</h2>
          <ul class="nav navbar-right panel_toolbox">
              <div class="x_content">
                  <button id="exportButton" class="btn btn-danger dropdown-toggle btn-sm">
                    <i class="fa fa-file-pdf-o"></i> Exportar a PDF
                  </button>
              </div>
            </ul>
          <div class="clearfix">
            
          </div>
        </div>

        <div class="x_content">

         <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
             <thead>
                  <tr>
                      <th>Inmueble</th>
                      <th>Saldo Ant.</th>
                    @for ($i = 0; $i < (6-count($periodos)); $i++)
                        <th>-</th>
                    @endfor
                    @foreach ($periodos as $periodo)
                      <th>{{$periodo->periodo}}</th>
                    @endforeach
                    
                    <th>Total</th>
                    <th>%</th>                                
                  </tr>
              </thead>
              <tbody>
                <th>
                </th>
                  
              </tbody>
              <tfoot>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>

                </tr>
              </tfoot>
          </table>
        </div>
      </div>
  </div>

  

@stop




@section ('jsscripts')  
    <script src="{{env('ROUTE_CSSJS') }}js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">


        $(document).ready(function() {

            getnombrecondominio();


            var route = "{{env('URL_JSON')}}inmueblecobranza";
            var table = $('#example').DataTable( {
                           "ajax": {
                            "url": route,
                            "type": "get", 
                             "dataSrc": ""               
                            },
                            "language": {
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
                                    "previous":   "Anterior"
                                },
                            },
                            columns: [
                                { data: 0 },
                                { data: 1, className: "sum" ,"render": function ( data, type, full, meta ) {
                                                                            return currency_cob(data,2,[',', "'", '.']);}},
                                { data: 2, className: "sum" ,"render": function ( data, type, full, meta ) {
                                                                            return currency_cob(data,2,[',', "'", '.']);}},
                                { data: 3, className: "sum" ,"render": function ( data, type, full, meta ) {
                                                                            return currency_cob(data,2,[',', "'", '.']);}},
                                { data: 4, className: "sum" ,"render": function ( data, type, full, meta ) {
                                                                            return currency_cob(data,2,[',', "'", '.']);}},
                                { data: 5, className: "sum" ,"render": function ( data, type, full, meta ) {
                                                                            return currency_cob(data,2,[',', "'", '.']);}},
                                { data: 6, className: "sum" ,"render": function ( data, type, full, meta ) {
                                                                            return currency_cob(data,2,[',', "'", '.']);}},
                                { data: 7, className: "sum" ,"render": function ( data, type, full, meta ) {
                                                                            return currency_cob(data,2,[',', "'", '.']);}},
                                { data: 8, className: "sum" ,"render": function ( data, type, full, meta ) {
                                                                            return currency_cob(data,2,[',', "'", '.']);}},
                                { data: 9, className: "sum" ,"render": function ( data, type, full, meta ) {
                                                                            return currency_cob(data,2,[',', "'", '.']);}}
                                //{ data: 9, className: "sum"}
                            ]
                            ,
                            "footerCallback": function(row, data, start, end, display) {
                                  var api = this.api();

                                  api.columns('.sum', { page: 'current' }).every(function () {
                                      var sum = api
                                          .cells( null, this.index(), { page: 'current'} )
                                          .render('display')
                                          .reduce(function (a, b) {
                                              //console.log(' a =' + a ,' | b =' +  b);
                                              var x = convert_strFloat(a) || 0;
                                              var y = convert_strFloat(b) || 0;

                                              //console.log(' x =' + x ,' | y =' +  y);
                                              //console.log('-----------------');


                                              return x+y;
                                          }, 0);
                                      
                                      $(this.footer()).html(currency_cob(sum.toFixed(2)));
                                  });
                              }

            } );

            

            
        } );


       
       
    </script>


  <!-- Export TABLE TO  -->

<link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/jszip.min.js"></script>


 
  <script type="text/javascript">
    jQuery(function ($) {
        $("#exportButton").click(function () {
            // parse the HTML table element having an id=exportTable
            var dataSource = shield.DataSource.create({
                data: "#example",
                schema: {
                    type: "table",
                    fields: {
                        Inmueble: { type: String },
                        "Saldo Ant.": { type: String },
                        @for ($i = 0; $i < (6-count($periodos)); $i++)
                            "-": { type: String },
                        @endfor
                        @foreach ($periodos as $periodo)
                          "{{$periodo->periodo}}": { type: String },
                        @endforeach
                        "Total": { type: String },
                        "%": { type: String }
                    }
                }
            });

            // when parsing is done, export the data to PDF
            dataSource.read().then(function (data) {
                var pdf = new shield.exp.PDFDocument({
                    author: "netus.com.ve",
                    created: new Date()
                });

                pdf.addPage("a3", "landscape");

                pdf.table(
                    50,
                    50,
                    data,
                    [
                        { field: "Inmueble", title: "Inmueble", width: 100 },
                        { field: "Saldo Ant.", title: "Saldo Anterior", width: 100 },
                        @for ($i = 0; $i < (6-count($periodos)); $i++)
                            { field: "-", title: "-", width: 10 },
                        @endfor
                        @foreach ($periodos as $periodo)
                          { field: "{{$periodo->periodo}}", title: "{{$periodo->periodo}}", width: 100 },
                        @endforeach
                        { field: "Total", title: "Total", width: 100 },
                        { field: "%", title: "Porcentaje", width: 100 }
                    ],
                    {
                        margins: {
                            top: 50,
                            left: 50
                        }
                    }
                );

                pdf.saveAs({
                    fileName: "Cuentas_por_Cobrar"
                });
            });
        });
    });
</script>
  
  @include ('common_js.getnombrecondominio')

  
@stop 

