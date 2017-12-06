@extends('layouts.principal')






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
            <h2>Ingresos Adicionales</h2>
            <ul class="nav navbar-right panel_toolbox">
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
            <div class="">
              <table class="table table-striped jambo_table bulk_action">
                <thead>
                  <tr class="headings">
                    <th class="column-title">Descripcion</th>
                    <th class="column-title">Activo</th>
                    <th class="column-title no-link last"><span class="nobr"></span></th>
                  </tr>
                </thead>                
                  <tr class="even pointer">


                    @foreach ($ingresosadicionales as $ingresoadicional)
                        <tbody>
                          <tr>
                            <td>{{ $ingresoadicional -> descripcion }}</td>
                            <td>  

                                 <div class="checkbox checkbox-success" style="margin-top: 0;margin-bottom: 0">
                                    <input type="checkbox" class="styled" disabled="disabled" name="xxx" @if (($ingresoadicional->activo) == '1') checked @endif>
                                    <label></label>
                                  </div>
                            </td>
                            <td>
                              <div class="btn btn-primary btn-xs">
                                <a href="{{URL::to('/') }}/ingresosadicionales/{{ $ingresoadicional -> id}}/edit" style="color: white;">Modificar</a>
                              </div>

                              @if ($ingresoadicional->activo == '1')
                                <div class="btn btn-warning btn-xs">
                                  <a href="{{URL::to('/') }}/ingresosadicionales/desactivar/{{$ingresoadicional->id}}" style="color: white;">Desactivar</a>
                                </div>
                              @else
                                <div class="btn btn-success btn-xs">
                                  <a href="{{URL::to('/') }}/ingresosadicionales/activar/{{$ingresoadicional->id}}" style="color: white;">Activar  ({{$ingresoadicional->activo}})</a>
                                </div>
                              @endif 
                            </td>
                          </tr>
                        </tbody>  
                    @endforeach
                  </tr>                
               
              </table>
              <div style="text-align: center;">{!! $ingresosadicionales -> render() !!}</div>
            </div>
          </div>
        </div>
      </div>

  

@stop


@section ('jsscripts')  
  
@stop 