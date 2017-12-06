@extends('layouts.principal')

@section('menu')    
    @include('layouts.menu1')  
@stop



@section('nombre_accion')
    <span>Iniciar Sesion</span>
@stop

@section('usuario')    
    @include ('layouts.usuariotoolbar')
@stop

@section ('contenido')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-user">
                  <div class="login_wrapper">
                      <div class="animate form login_form">
                        <section class="login_content">
                            <h1>Contraseña Enviada</h1>
                            <div>
                              Se ha enviado un correo electronico a la siguiente direccion <b>{{$mail}}</b> con instrucciones como recuperar su contraseña 
                            </div>
                        </section>
                      </div>
                  </div>                    
                </div>
            </div>
        </div>
    </div>               

@stop

 

