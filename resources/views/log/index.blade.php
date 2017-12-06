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
          <h2>Log de Auditoria</h2>
          <ul class="nav navbar-right panel_toolbox">
              <div class="x_content">
                  <select class="btn btn-primary dropdown-toggle btn-sm" id='idPeriodo'>
                    @foreach($periodos as $periodo)
                      <option value="{{$periodo->id}}" @if ($periodo->periodo_actual == '1') selected @endif>{{$periodo->periodo}}</option>
                    @endforeach 
                    
                  </select>

                </div>
            </ul>
          <div class="clearfix"></div>

        </div>
        <div class="x_content">
         <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
             <thead>
                  <tr>
                      <th width="20%">Tipo</th>
                      <th width="60%">Concepto</th>
                      <th width="10%">Fecha</th>
                      <th>Hora</th>                                
                  </tr>
              </thead>
              <tbody>
                <th></th>
              </tbody>
          </table>
        </div>
      </div>
  </div>

  

@stop




@section ('jsscripts')  
    <script src="{{env('ROUTE_CSSJS') }}js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">

      var table = '';

      $("#idPeriodo").change(function(){     
          table.ajax.reload();     
      });

      $(document).ready(function(){    
        getnombrecondominio();
        buscalog();
      });

      function buscalog(){


          var route = "{{env('URL_JSON')}}log/getlogperiodo";
          table = $('#example').DataTable( {
                         "pageLength": 50,
                         "ajax": {
                          "url": route,
                          "type": "get", 
                          "data"   : function( d ) {
                            d.id_periodo= $("#idPeriodo").val();
                          },
                           "dataSrc": ""               
                          },
                          "bSort": false,
                          @include('common_js.languagedatatables')
                          
                          columns: [
                              { data: 'tipo' },
                              { data: 'mensaje' },
                              { data: 'created_at',"render": function ( data, type, full, meta ) {
                                                                            return fechamask(data);} }, 
                              { data: 'time_at',"render": function ( data, type, full, meta ) {
                                                                            return hourmask(data);}  }
                          ]
          } );
          
      }

        


        


       
       
    </script>
    @include ('common_js.getnombrecondominio')

  
@stop 

