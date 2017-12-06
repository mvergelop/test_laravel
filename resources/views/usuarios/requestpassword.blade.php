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
                    
                       @include ('alerts.error')
                       @include ('alerts.request')

                        <div class="login_wrapper">
                            <div class="animate form login_form">
                              <section class="login_content">
                                {!!Form::open(['route'=>'lostpassword.store', 'method'=>'POST'])!!}
                                  <h1>Olvido su Contraseña</h1>
                                  <div>
                                    {!!Form::label('login','E-Mail:')!!}
                                    {!!Form::text('email',null,['class'=>'form-control'])!!}
                                  </div>
                                  <div>
                                    {!!Form::submit('Recuperar su Contraseña',['class'=>'btn btn-primary'])!!}
                                    
                                  </div>

                                  <div class="clearfix"></div>

                                  <div class="separator">
                                    <p class="change_link">
                                    </p>

                                    <div class="clearfix"></div>
                                    <br />
                                  </div>
                                {!!Form::close()!!}
                              </section>
                            </div>
                        </div>                    
                </div>
            </div>
        </div>
    </div>               

@stop

 

