@extends('layouts.principal')




@include('alerts.success')

@section('menu')    
    @include('layouts.menu1')  
@stop

@section('nombre_accion')
    <span>Usuarios</span>
@stop

@section('usuario')    
    @include ('layouts.usuariotoolbar')
@stop


@section ('contenido')

  <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Listado de Gastos</h2>
            <ul class="nav navbar-right panel_toolbox">
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
            <div class="">
              <table class="table table-striped jambo_table bulk_action">
                <thead>
                  <tr class="headings">
                    <th class="column-title">Tipo</th>
                    <th class="column-title">Descripcion</th>
                    <th class="column-title">Activo</th>
                    <th class="column-title no-link last"><span class="nobr"></span></th>
                  </tr>
                </thead>                
                  <tr class="even pointer">
                    @foreach ($gastos as $gasto)
                        <tbody>
                            <tr>
                                <td>{{ $gasto -> des_tipo }}</td>
                                <td>{{ $gasto -> descripcion}}</td>

                                <td>
                                  <div class="checkbox checkbox-success" style="margin-top: 0;margin-bottom: 0">
                                      <input type="checkbox" class="styled" disabled="disabled" name="xxx" @if (($gasto -> activo) == '1') checked @endif>
                                      <label></label>

                                  </div>

                                </td>
                                <td>
                                  <div class="btn btn-primary btn-xs">
                                    @if (Auth::user()->tipo == '1')
                                      <a href="{{URL::to('/') }}/gastos/{{$gasto->id}}/edit" style="color: white;">Modificar</a>
                                    @else
                                      <a href="{{URL::to('/') }}/gastos/{{$gasto->id}}" style="color: white;">Consultar</a>
                                    @endif 
                                  </div>
                                  @if (Auth::user()->tipo == '1')
                                    @if ($gasto->activo == '1')
                                      <div class="btn btn-warning btn-xs">
                                        <a href="{{URL::to('/') }}/gastos/desactivar/{{$gasto->id}}" style="color: white;">Desactivar</a>
                                      </div>
                                    @else
                                      <div class="btn btn-success btn-xs">
                                        <a href="{{URL::to('/') }}/gastos/activar/{{$gasto->id}}" style="color: white;">Activar</a>
                                      </div>
                                    @endif 
                                  @endif 
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                  </tr>                
               
              </table>
              <div style="text-align: center;">{!! $gastos -> render() !!}</div>
            </div>
          </div>
        </div>
      </div>

  

@stop

@section ('jsscripts')

@stop 