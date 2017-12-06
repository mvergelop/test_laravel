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
            <h2>FAQ</h2>
            <ul class="nav navbar-right panel_toolbox">
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
            <div class="">
              <table class="table table-striped jambo_table bulk_action">
                <thead>
                  <tr class="headings">
                    <th class="column-title">Posicion</th>
                    <th class="column-title">Pregunta</th>
                    <th class="column-title">Respuesta</th>
                    <th class="column-title">Mostrar</th>
                    <th class="column-title no-link last"><span class="nobr"></span></th>
                  </tr>
                </thead>                
                  <tr class="even pointer">


                    @foreach ($FAQS as $FAQ)
                        <tbody>
                          <tr>
                            <td>{{$FAQ->posicion}}</td>
                            <td>{{ $FAQ -> pregunta }}</td>
                            <td>{{ $FAQ -> respuesta }}</td>
                            <td>  
                                 <div class="checkbox checkbox-success" style="margin-top: 0;margin-bottom: 0">
                                    <input type="checkbox" class="styled" disabled="disabled" name="xxx" @if (($FAQ -> mostrar) == '1') checked @endif>
                                    <label></label>
                                  </div>
                            </td>
                            <td>
                              <div class="btn btn-primary btn-xs">
                                <a href="{{URL::to('/') }}/faq/{{ $FAQ -> id}}/edit" style="color: white;">Modificar</a>
                              </div>

                              @if ($FAQ->mostrar == '1')
                                <div class="btn btn-warning btn-xs">
                                  <a href="{{URL::to('/') }}/faq/ocultar/{{$FAQ->id}}" style="color: white;">Ocultar</a>
                                </div>
                              @else
                                <div class="btn btn-success btn-xs">
                                  <a href="{{URL::to('/') }}/faq/mostrar/{{$FAQ->id}}" style="color: white;">Mostrar</a>
                                </div>
                              @endif 
                            </td>
                          </tr>
                        </tbody>  
                    @endforeach
                  </tr>                
               
              </table>
              
            </div>
          </div>
        </div>
      </div>

  

@stop


@section ('jsscripts')  
  
@stop 