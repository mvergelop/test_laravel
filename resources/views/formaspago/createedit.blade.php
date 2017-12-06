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
             <h2>Medios de Pago y Cobranzas</small></h2>
            <ul class="nav navbar-right panel_toolbox">
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            @include ('alerts.request')

                {!!Form::open(['url'=>$action, 'method'=>$method,'class' => 'form-horizontal form-label-left'])!!}

                    <input type="hidden" name="id" value ="{{$formapago->id}}" id= 'id'>

                    <div class="form-group">
                        {!!Form::label('lb_des','Descripcion:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('descripcion',$formapago->descripcion,['class'=>'form-control col-md-7 col-xs-12'])!!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!!Form::label('lb_saldo_inicial','Saldo Inicial:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <input type="text" name="saldo_inicial" class="form-control col-md-7 col-xs-12" value="{{$formapago->saldo_inicial}}" @if (isset($hayMov)) @if ($hayMov > 0) readonly @endif @endif>

                            
                        </div>
                        {!!Form::label('lb_periodo','*Indique el saldo al periodo '.$periodoinicial->periodo,['class' => 'control-label col-md-6 col-sm-3 col-xs-12'])!!}
                    </div>

                    <div class="form-group">
                        {!!Form::label('lb_saldo_inicial2','Confirmar Saldo Inicial:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <input type="text" name="saldo_inicial2" class="form-control col-md-7 col-xs-12" value="{{$formapago->saldo_inicial}}" @if (isset($hayMov)) @if ($hayMov > 0) readonly @endif @endif>
                        </div>
                        {!!Form::label('lb_periodo','*Indique el saldo al periodo '.$periodoinicial->periodo,['class' => 'control-label col-md-6 col-sm-3 col-xs-12'])!!}
                    </div>
                    
                   <div class="form-group">
                        {!!Form::label('activo','Activo:',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="checkbox checkbox-success" style="margin-top: 0;margin-bottom: 0">
                            @if (isset($formapago->activo))
                              @if ($formapago->activo == '1'){
                                {!!Form::checkbox('activo', '1',true) !!}
                              @else 
                                {!!Form::checkbox('activo', '1',false) !!}
                              @endif 

                            @else
                              {!!Form::checkbox('activo', '1',true) !!}
                            @endif 
                            
                            <label></label>
                          </div>
                        </div>
                    </div>
              
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3">
                            {!!Form::submit($button,['class'=>'btn btn-success'])!!}
                        </div>
                    </div>
             
            {!!Form::close()!!}
          </div>
        </div>
      </div>


@stop