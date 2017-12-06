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
                                {!!Form::open(['route'=>'lostpassword.update', 'method'=>'PUT'])!!}

                                  <h1>Olvido su Contraseña</h1>
                                  <div>
                                    <input type="hidden" name="email" value="{{$usuario->email}}"></input>
                                    {!!Form::label('password','Contraseña:')!!}
                                    {!!Form::password('password',null,['class'=>'form-control'])!!}
                                  </div>
                                  <div>
                                    {!!Form::label('password','Repetir contraseña:')!!}
                                    {!!Form::password('password2',null,['class'=>'form-control'])!!}
                                  </div>
                                  <div align="center">
                                    
                                    
                                  </div>

                                  <div class="clearfix" align="center">
                                    {!!Form::submit('Aceptar',['class'=>'btn btn-primary'])!!}
                                  </div>

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

 

