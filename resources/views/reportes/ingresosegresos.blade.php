@extends('layouts.principal')

@section ('csslinks')
  <link href="{{env('ROUTE_CSSJS') }}css/tableexport.min.css" rel="stylesheet">
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
            <h2>Relacion de Ingresos y Egresos</h2>
            <ul class="nav navbar-right panel_toolbox">
              <div class="x_content">
                  <select class="btn btn-primary dropdown-toggle btn-sm" id='idPeriodo'>
                    
                  </select>
                  <button id="exportButton" class="btn btn-danger dropdown-toggle btn-sm">
                    <i class="fa fa-file-pdf-o"></i> Exportar a PDF
                  </button>
              </div>
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
            <div class="">
              <table id='exportTable' class="table table-striped jambo_table bulk_action">
                <thead>
                  <tr class="headings">
                    <th class="column-title">Concepto</th>
                    <th class="column-title">Monto</th>
                    <th class="column-title">Porcentaje</th>
                  </tr>
                </thead>                
                  <tbody id='resumen'>
                    
                </tbody>  
                
                
              </table>
            </div>
          </div>
        </div>
      </div>

</div>

  

@stop



@section('jsscripts')

  

  <script type="text/javascript">
    
    $(document).ready(function(){    

      route = "{{env('URL_JSON')}}periodoscerrados";
      $.ajax({
            url: route,
            type: 'get',
            dataType: 'json',
            success: function (rta) {
              $("#idPeriodo").empty();

              $.each(rta, function (key,value) {
              if (@if (isset($idPeriodo)) value.id == {{$idPeriodo}} @else key == 0 @endif ) {                  
                $('#idPeriodo').append('<option value="'+ value.id +'" selected>'+ value.periodo +'</option>');

              }else {
                $('#idPeriodo').append('<option value="'+ value.id +'">'+ value.periodo +'</option>');
              } 
              })
              buscaDatos();

              getnombrecondominio();



            }
         });


      

      $("#idPeriodo").change(function(){
          buscaDatos();
      });

    });

   

    function buscaDatos(){

      var idPeriodo = $("#idPeriodo").val();

      var route = "{{env('URL_JSON')}}getingresosyegresos/"+idPeriodo;

      $.ajax({
            url: route,
            type: 'get',
            dataType: 'json',
            success: function (rta) {
              $("#resumen").empty();
              var count = (Object.keys(rta).length)-3; //Lineas Adicionales en el Json             
              $.each(rta, function (key,value) {

                if (count== key ){
                    if (convert_strFloat(value[1]) >= 0 ) {
                      var clase = "ingegre-positivo" ;
                    }else {
                      var clase = "ingegre-negativo" ;
                    }
                }else {
                    var clase = "ingegre-numero"; 
                }

                $('#resumen').append('<tr><td>'+value[0]+'</td><td class ="'+ clase +'">'+numberWithCommas(value[1])+'</td><td>'+value[2]+'</td></tr>');
              })
            }
         });
    }

  </script>

  @include ('common_js.getnombrecondominio')


  <!-- Export TABLE TO  -->

<link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/jszip.min.js"></script>
  
  <script type="text/javascript">
    jQuery(function ($) {
        $("#exportButton").click(function () {
            // parse the HTML table element having an id=exportTable
            var dataSource = shield.DataSource.create({
                data: "#exportTable",
                schema: {
                    type: "table",
                    fields: {
                        Concepto: { type: String },
                        Monto: { type: String },
                        Porcentaje: { type: String }
                    }
                }
            });

            // when parsing is done, export the data to PDF
            dataSource.read().then(function (data) {
                var pdf = new shield.exp.PDFDocument({
                    author: "netus.com.ve",
                    created: new Date()
                });

                pdf.addPage("a4", "portrait");

                pdf.table(
                    50,
                    50,
                    data,
                    [
                        { field: "Concepto", title: "Concepto", width: 300 },
                        { field: "Monto", title: "Monto", width: 100 },
                        { field: "Porcentaje", title: "%", width: 50 }
                    ],
                    {
                        margins: {
                            top: 50,
                            left: 50
                        }
                    }
                );

                pdf.saveAs({
                    fileName: "Ingresos_y_Egresos"
                });
            });
        });
    });
</script>
  
  
  
  

@stop 