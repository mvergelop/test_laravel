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
            <h2>Datos Condominio</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            @include ('alerts.request')

            {!!Form::open(['route'=>'condominio.store', 'method'=>'POST','class' => 'form-horizontal form-label-left'])!!}


                    <div class="form-group">
                        {!!Form::label('nombre','Nombre:',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('nombre',null,['class'=>'form-control col-md-7 col-xs-12', 'onkeyup' => 'llenaUrl();', 'id' => 'nombre' ])!!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!!Form::label('direccion','Direccion:',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('direccion',null,['class'=>'form-control col-md-7 col-xs-12'])!!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                          {!!Form::label('administrador','Administrador:',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('administrador',null,['class'=>'form-control col-md-7 col-xs-12'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                          {!!Form::label('tipo','Tipo:',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::select('tipo', ['1' => 'Edificio', '2' => 'Conjunto Recidencial','3' => 'Centro Comercial'], '1',
                            ['class'=>'form-control col-md-7 col-xs-12'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                          {!!Form::label('cant_inmuebles','Numero de Inmuebles:',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('cant_inmuebles',null,['class'=>'form-control col-md-7 col-xs-12'])!!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                          {!!Form::label('cant_niveles','Numero de Niveles:',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('cant_niveles',null,['class'=>'form-control col-md-7 col-xs-12'])!!}
                        </div>
                    </div>

                   <div class="form-group">
                       {!!Form::label('lb_tipocobro','Tipo cuota por Defecto:',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="btn btn-success">
                            <input name="tipo_cuota" type="radio" value="1" id="rb_monto_fijo"> Monto Fijo  
                          </label>
                          <label class="btn btn-success">
                            <input name="tipo_cuota" type="radio" value="2" id="rb_porcentaje"> Porcentaje
                          </label>
                        </div>
                    </div>
                    
                           
                    <div class="form-group">
                        {!!Form::label('lb_periodo','Periodo Inicial *',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                          <div class="col-md-2 col-sm-6 col-xs-12">
                            <select class="form-control col-md-4 col-xs-12'" name="periodo">
                              @foreach($cuotasordinarias as $cuotaordinaria)
                                <option value="{{$cuotaordinaria->id}}">{{$cuotaordinaria->periodo}}</option>
                              @endforeach
                            </select>                            
                          </div>
                          {!!Form::label('lb_periodo','*Una vez guardado no es posible cambiarlo',['class' => 'control-label col-md-4 col-sm-3 col-xs-12'])!!}
                    </div>
                    
                      
                     <div class="form-group">
                        {!!Form::label('url','Url de Acceso www.netus.com.ve/',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('url',null,['class'=>'form-control col-md-7 col-xs-12', 'id' => 'url','disabled' => 'true'])!!}
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

@section ('jsscripts')  


@stop 