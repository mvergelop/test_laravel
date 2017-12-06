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
            @include ('alerts.request')
                          
              {!!Form::open(['url'=>$action, 'method'=>$method,'class' => 'form-horizontal form-label-left'])!!}

                <input type="hidden" name="_token" value ="{{ csrf_token()}}" id= 'token'>
                <input type="hidden" name="id" value ="{{ $condominio->id}}" id= 'id'>

                <div class="form-group">
                    {!!Form::label('nombre','Nombre:',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!!Form::text('nombre',$condominio->nombre,['class'=>'form-control col-md-7 col-xs-12', 'onkeyup' => 'llenaUrl();', 'id' => 'nombre' ])!!}
                    </div>
                </div>
                
                <div class="form-group">
                    {!!Form::label('direccion','Direccion:',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!!Form::text('direccion',$condominio->direccion,['class'=>'form-control col-md-7 col-xs-12'])!!}
                    </div>
                </div>

                <div class="form-group">
                    {!!Form::label('ciudad','Ciudad:',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        
                        <select name='ciudad' id="ciudad" class="form-control">
                          <option value="" selected style="display: none;">Ciudad</option>
                          @foreach ($ciudades as $ciudad)
                            <option value="{{$ciudad->ciudad}}_{{$ciudad->id_ciudad}}" @if ($ciudad->ciudad.'_'.$ciudad->id_ciudad == $condominio->ciudad) selected @endif>{{$ciudad->ciudad}}</option>
                          @endforeach 
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                      {!!Form::label('administrador','Administrador:',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {!!Form::text('administrador',$condominio->administrador,['class'=>'form-control col-md-7 col-xs-12'])!!}
                    </div>
                </div>

                <div class="form-group">
                      {!!Form::label('tipo','Tipo:',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      <select name='tipo' id="tipo" class="form-control col-md-7 col-xs-12">
                        @if (isset($condominio->tipo))
                          <option value="1" selected>Edificio</option>
                          <option value="5">Torre</option>
                          <option value="4">Bloque</option>
                          <option value="2">Conjunto Residencial</option>
                          <option value="6">Villa</option>
                          <option value="3">Centro Comercial</option>
                          <option value="7">Centro Profesional</option>
                          
                          
                        @else 
                          <option value="1" @if($condominio->tipo == '1') selected @endif>Edificio</option>
                          <option value="5" @if($condominio->tipo == '5') selected @endif>Torre</option>
                          <option value="4" @if($condominio->tipo == '4') selected @endif>Bloque</option>
                          <option value="2" @if($condominio->tipo == '2') selected @endif>Conjunto Residencial</option>
                          <option value="6" @if($condominio->tipo == '6') selected @endif>Villa</option>
                          <option value="3" @if($condominio->tipo == '3') selected @endif>Centro Comercial</option>
                          <option value="7" @if($condominio->tipo == '7') selected @endif>Centro Profesional</option>
                          
                        @endif 
                      </select>
                        
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
                    {!!Form::label('lb_periodo','Periodo Inicial*',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                      <div class="col-md-2 col-sm-6 col-xs-12">
                        <select class="form-control col-md-4 col-xs-12'" name="periodo" @if (isset($condominio->nombre)) readonly @endif >
                        @if( count($cuotasordinarias)> 0 )
                          @foreach($cuotasordinarias as $cuotaordinaria)
                            <option value="{{$cuotaordinaria->id}}">{{$cuotaordinaria->periodo}}</option>
                          @endforeach
                        @else 
                          <option value="{{$cuotaordinaria->id}}" selected="selected">{{$cuotaordinaria->periodo}}</option>
                        @endif 
                            
                        </select>
                      </div>
                      {!!Form::label('lb_periodo','*Una vez guardado no es posible cambiarlo',['class' => 'control-label col-md-4 col-sm-3 col-xs-12'])!!}
                </div>

                <div class="form-group">
                    {!!Form::label('lb_periodo','Verificar Periodo Inicial',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                      <div class="col-md-2 col-sm-6 col-xs-12">
                        <select class="form-control col-md-4 col-xs-12'" name="periodo2" @if (isset($condominio->nombre)) readonly @endif >
                          @if( count($cuotasordinarias)> 0 )
                            @foreach($cuotasordinarias as $cuotaordinaria)
                              <option value="{{$cuotaordinaria->id}}">{{$cuotaordinaria->periodo}}</option>
                            @endforeach
                          @else 
                            <option value="{{$cuotaordinaria->id}}" selected="selected">{{$cuotaordinaria->periodo}}</option>
                          @endif 
                        </select>
                      </div>
                      
                </div>

                  
                 <div class="form-group">
                    {!!Form::label('url','Url de Acceso www.netus.com.ve/',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!!Form::text('url',$condominio->url,['class'=>'form-control col-md-7 col-xs-12', 'id' => 'url'])!!}
                    </div>
                </div>


                
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        {!!Form::submit($button,['class'=>'btn btn-success'])!!}
                    </div>
                </div>
               
              {!!Form::close()!!}
          </div>
        </div>
      </div>
    </div>


@stop

@section ('jsscripts')  

  @include('condominio.js');

@stop 