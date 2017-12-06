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
            <h2>Listado de Inmuebles</h2>
            <ul class="nav navbar-right panel_toolbox">
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
            <div class="">
              <table class="table table-striped jambo_table bulk_action">
                <thead>
                  <tr class="headings">
                    <th class="column-title">Identificador</th>
                    <th class="column-title">Propietario/Inquilino</th>
                    <th class="column-title">Rif / C.I</th>
                    <th class="column-title">Correo Electronico</th>
                    <th class="column-title no-link last"><span class="nobr"></span></th>
                  </tr>
                </thead>                
                  <tr class="even pointer">
                    @foreach ($inmuebles as $inmueble)
                        <tbody>
                            <tr>
                                <td>
                                @if (($inmueble -> nivel) == '0')
                                    {{ $inmueble -> identificador}}
                                @else
                                  {{ $inmueble -> nivel}}  / {{ $inmueble -> identificador}}
                                @endif 
                                
                                </td>
                                <td>{{ $inmueble -> ocupante}}</td>
                                <td>{{ $inmueble -> id_legal}}</td>
                                <td>{{ $inmueble -> email}}</td>
                                <td>
                                  <div class="btn btn-primary btn-xs">
                                    <a href="{{URL::to('/') }}/inmuebles/{{ $inmueble -> id}}/edit" style="color: white;">Modificar</a>
                                  </div>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                  </tr>                
               
              </table>
              <div style="text-align: center;">{!! $inmuebles -> render() !!}</div>
            </div>
          </div>
        </div>
      </div>

  

@stop