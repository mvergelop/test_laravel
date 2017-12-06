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
             <h2>Registro de Usuarios</small></h2>
            <ul class="nav navbar-right panel_toolbox">
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            @include ('alerts.request')

            @if (Auth::check())
              @if (Auth::user()->tipo == '1')
                @include ('usuarios.tipo1')
              @else
                @include ('usuarios.tipo2')
              @endif 
            @else 
              @include ('usuarios.tipo2')
            @endif 
          </div>
        </div>
      </div>


@stop

@if (Auth::check())
        @if (Auth::user()->tipo =='1')
          @section ('jsscripts')  

            <script>
               
                      $.fn.datepicker.defaults.format = "dd/mm/yyyy";
                      $(document).ready(function() {
                        @if (isset($user->login))



                          $('#vencimiento').datepicker('setDate', '{{$vencimiento}}');
                        @else 
                          $('#vencimiento').datepicker('setDate', new Date());
                        @endif 
                        
                        
                      });
                </script>
  
          @stop 
        @endif
    @endif



  