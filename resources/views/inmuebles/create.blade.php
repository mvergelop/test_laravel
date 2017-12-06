@extends('layouts.principal')

@section('menu')    
    @include('layouts.menu1')  
@stop



@section('nombre_accion')
    <span>Registro de Inmuebles</span>
@stop

@section('usuario')    
    @include ('layouts.usuariotoolbar')
@stop

@section ('contenido')

  <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
             <h2>Datos Inmueble</h2>
            <ul class="nav navbar-right panel_toolbox">
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            @include ('alerts.request')

                {!!Form::open(['route'=>'inmuebles.store', 'method'=>'POST','class' => 'form-horizontal form-label-left'])!!}

                    <div class="form-group">
                        {!!Form::label('lb_id','Identificador:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('identificador',null,['class'=>'form-control col-md-7 col-xs-12'])!!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!!Form::label('lb_ocupante','Propietario / Inquilino:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('ocupante',null,['class'=>'form-control col-md-7 col-xs-12'])!!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!!Form::label('lb_idlega','Rif / C.I :',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('id_legal',null,['class'=>'form-control col-md-7 col-xs-12'])!!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!!Form::label('correo','Correo:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('email',null,['class'=>'form-control col-md-7 col-xs-12'])!!}
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