@extends('layouts.principal')

@section('menu')    
    @include('layouts.menu1')  
@stop



@section('nombre_accion')
    <span>Editar Usuario</span>
@stop

@section('usuario')    
    @include ('layouts.usuariotoolbar')
@stop


@section ('contenido')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Modificar Usuario</h4>
                    </div>
                    <div class="content">
                        {!!Form::model($user,['route'=>['usuarios.update'], $user->login,'method'=>'PUT'])!!}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!!Form::label('login','Login:')!!}
                                        {!!Form::text('login',null,['class'=>'form-control'])!!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!!Form::label('nombre','Nombre:')!!}
                                        {!!Form::text('name',null,['class'=>'form-control'])!!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!!Form::label('correo','Correo:')!!}
                                        {!!Form::text('email',null,['class'=>'form-control'])!!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!!Form::label('password','Contraseña:')!!}
                                        {!!Form::text('password',null,['class'=>'form-control'])!!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!!Form::label('password2','Repita Contraseña:')!!}
                                        {!!Form::text('password2',null,['class'=>'form-control'])!!}
                                    </div>
                                </div>
                            </div>
                        {!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>



    

        
            
                                

@stop