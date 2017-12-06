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
             <h2>Formulario de Contacto</small></h2>
            <ul class="nav navbar-right panel_toolbox">
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            @include ('alerts.request')

                {!!Form::open(['url'=> $action, 'method'=>'POST','class' => 'form-horizontal form-label-left'])!!}

                     <div class="form-group">
                        {!!Form::label('lb','Motivo:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name='motivo' id="motivo" class="form-control">
                                  <option value="1" selected>Información</option>
                                  <option value="2">Soporte</option>
                                  <option value="3">Aviso de Pago</option>
                                  <option value="4">Solicitud de Instructivos</option>
                            </select>

                        </div>
                    </div>


                    <div class="form-group">
                        {!!Form::label('lb','Nombre:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="nombre" class="form-control" value="{{$nombre}}" {{$readonly}}>
                        </div>
                    </div>

                    <div class="form-group">
                        {!!Form::label('lb','Correo Electronico:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="correo_electronico" class="form-control" value="{{$correo_electronico}}" {{$readonly}}>
                        </div>
                    </div>

                    <div class="form-group">
                        {!!Form::label('lb','Asunto:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('asunto',NULL,['class'=>'form-control col-md-7 col-xs-12'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('lb','Mensaje:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::textarea('mensaje',NULL,['class'=>'form-control col-md-7 col-xs-12'])!!}
                        </div>
                    </div>
                    

                   
                    
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success"><i class="fa fa-envelope-o"></i>Enviar</button>
                        </div>
                    </div>
             
            {!!Form::close()!!}
          </div>
        </div>
      </div>


@stop