@extends('layouts.principal')

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
            <h2>Ultimas Cuotas Generadas</h2>
            <ul class="nav navbar-right panel_toolbox">
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
            <div class="">
              <table class="table table-striped jambo_table bulk_action">
                <thead>
                  <tr class="headings">
                    <th class="column-title">Periodo</th>
                    <th class="column-title">Inmueble</th>
                    <th class="column-title">Ocupante</th>
                    <th class="column-title">Monto</th>
                    <th class="column-title">Fecha Registro</th>
                    <th class="column-title"></th>
                  </tr>
                </thead>                
                  <tr class="even pointer">

                    @if (count($cuotas) > 0 )
                      @foreach ($cuotas as $cuota)
                          <tbody>
                            <tr>
                              <td>{{ $cuota -> periodo }}</td>
                              <td>{{ $cuota -> inmueble }}</td>
                              <td>{{ $cuota -> ocupante }}</td>
                              <td>{{ $cuota -> monto }}</td>
                              <td>{{ getFechaStr($cuota -> created_at) }}</td>
                              <td></td>
                            </tr>
                          </tbody>  
                      @endforeach
                    @endif 
                  </tr>                
               
              </table>
              <div style="text-align: center;">{!! $cuotas -> render() !!}</div>
            </div>
          </div>
        </div>
      </div>

  

@stop

@section ('jsscripts')  

@stop 