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
            <h2>Medios de Pago y Cobranzas</h2>
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
                    <th class="column-title"></th>
                  </tr>
                </thead>                
                  <tr class="even pointer">

                    @if (count($formaspago) > 0 )
                      @foreach ($formaspago as $formapago)
                          <tbody>
                            <tr>
                              <td>{{ $formapago -> descripcion }}</td>
                              <td>  
                                <div class="checkbox checkbox-success" style="margin-top: 0;margin-bottom: 0">
                                  <input type="checkbox" class="styled" disabled="disabled" name="xxx" @if (($formapago -> activo) == '1') checked @endif>
                                  <label></label>
                                </div>
                              </td>
                              <td>
                                  <div class="btn btn-primary btn-xs">
                                    <a href="{{URL::to('/') }}/formaspago/{{ $formapago -> id}}/edit" style="color: white;">Modificar</a>
                                  </div>
                                  @if ($formapago->activo == '1')
                                    <div class="btn btn-warning btn-xs">
                                      <a href="{{URL::to('/') }}/formaspago/desactivar/{{$formapago->id}}" style="color: white;">Desactivar</a>
                                    </div>
                                  @else
                                    <div class="btn btn-success btn-xs">
                                      <a href="{{URL::to('/') }}/formaspago/activar/{{$formapago->id}}" style="color: white;">Activar</a>
                                    </div>
                                  @endif 
                              </td>
                            </tr>
                          </tbody>  
                      @endforeach
                    @endif 
                  </tr>                
               
              </table>
              
            </div>
          </div>
        </div>
      </div>

  

@stop

@section ('jsscripts')  

@stop 