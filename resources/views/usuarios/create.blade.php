@extends('layouts.principal')

@section('menu')    
    @include('layouts.menu1')  
@stop



@section('nombre_accion')
    <span>Registro de Usuario</span>
@stop

@section('usuario')    
    @include ('layouts.usuariotoolbar')
@stop

@section ('contenido')

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Registro de Usuario</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            @include ('alerts.request')

                {!!Form::open(['route'=>'usuarios.store', 'method'=>'POST','class' => 'form-horizontal form-label-left'])!!}

                    <div class="form-group">
                        {!!Form::label('login','Login:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('login',null,['class'=>'form-control col-md-7 col-xs-12'])!!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!!Form::label('nombre','Nombre:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('name',null,['class'=>'form-control col-md-7 col-xs-12'])!!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!!Form::label('correo','Correo:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('email',null,['class'=>'form-control col-md-7 col-xs-12'])!!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!!Form::label('password','Contraseña:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::password('password',array('class'=>'form-control col-md-7 col-xs-12'))!!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!!Form::label('password2','Repetir Contraseña:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::password('password2',array('class'=>'form-control col-md-7 col-xs-12'))!!}
                        </div>
                    </div>
              
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            {!!Form::submit('Registrar',['class'=>'btn btn-success'])!!}
                        </div>
                    </div>
             
            {!!Form::close()!!}
          </div>
        </div>
      </div>


@stop