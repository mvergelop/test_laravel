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
                            <h1>CONTRASEÑA CAMBIADA CON EXITO</h1>
                            <div>
                              Su contraseña se ha cambiado con exito
                            </div>
                        </section>
                      </div>
                  </div>                    
                </div>
            </div>
        </div>
    </div>               

@stop

 

