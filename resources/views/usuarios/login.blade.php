@extends('layouts.principal')

@section('menu')    
    @include('layouts.menu1')  
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
                                {!!Form::open(['route'=>'login.store', 'method'=>'POST'])!!}
                                  <h1>Iniciar Session</h1>
                                  <div>
                                    {!!Form::label('login','E-Mail:')!!}
                                    {!!Form::text('login',null,['class'=>'form-control'])!!}
                                  </div>
                                  <div>
                                    {!!Form::label('password','Contraseña:')!!}
                                    {!!Form::password('password',array('class'=>'form-control'))!!}
                                  </div>
                                  <div>
                                    {!!Form::submit('Iniciar Sesion',['class'=>'btn btn-primary'])!!}
                                    <a class="#" href="#">Olvido su Contraseña?</a>
                                  </div>

                                  <div class="clearfix"></div>

                                  <div class="separator">
                                    <p class="change_link">
                                      <a href="/usuarios/create" >Registrate en Netus</a>
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

 

