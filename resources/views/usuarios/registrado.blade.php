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
            <ul class="nav navbar-right panel_toolbox">
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
            <h2>Estimado <b>{{$nombre}}</b>, se ha registrado correctamente en netus.com.ve, el siguiente paso sera validar su cuenta a traves de un correo electronico que le llegara en los proximos minutos a la siguiente direccion <b>{{$email}}</b></h2>
              
          </div>
            
                        

            
        </div>
      </div>
</div>

  

@stop

@section ('jsscripts')  

@stop 