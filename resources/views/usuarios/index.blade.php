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
            <h2>{{$titulo}}</h2>
            <ul class="nav navbar-right panel_toolbox">
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
            <div class="">
              <table class="table table-striped jambo_table bulk_action">
                <thead>
                  <tr class="headings">
                    <th class="column-title">Login / Condominio</th>
                    <th class="column-title">Nombre</th>
                    <th class="column-title">Correo</th>
                    <th class="column-title">Activo</th>
                    <th class="column-title no-link last"><span class="nobr">Acciones</span></th>
                    <th class="bulk-actions" colspan="7">
                      <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                    </th>
                  </tr>
                </thead>                
                  <tr class="even pointer">
                    @foreach ($users as $user)
                        <tbody>
                            <tr>
                                <td>@if ($user->nombre_condominio != '' || $user->nombre_condominio != null)  
                                          {{ $user->nombre_condominio}}
                                    @else 
                                        {{ $user->login}}
                                    @endif 


                                </td>
                                <td>{{ $user -> name}}</td>
                                <td>{{ $user -> email}}</td>
                                <td>
                                  <div class="checkbox checkbox-success" style="margin-top: 0;margin-bottom: 0">
                                    <input type="checkbox" class="styled" disabled="disabled" name="xxx" @if (($user -> activo) == '1') checked @endif>
                                    <label></label>
                                  </div>  
                                <td>
                                  <div class="btn btn-primary btn-xs">
                                    <a href="{{URL::to('/') }}/usuarios/{{ $user -> login}}/edit" style="color: white;">Modificar</a>
                                  </div>

                                  @if ($user->activo == '1')
                                    <div class="btn btn-warning btn-xs">
                                      <a href="{{URL::to('/') }}/usuarios/desactivar/{{$user->login}}" style="color: white;">Desactivar</a>
                                    </div>
                                  @else
                                    <div class="btn btn-success btn-xs">
                                      <a href="{{URL::to('/') }}/usuarios/activar/{{$user->login}}" style="color: white;">Activar</a>
                                    </div>
                                  @endif 
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                  </tr>                
               
              </table>
              <div style="text-align: center;">{!! $users -> render() !!}</div>
            </div>
          </div>
        </div>
      </div>

  

@stop