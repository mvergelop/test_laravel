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
            @include ('layouts.modalquestion')
                {!!Form::open(['url'=>$action, 'method'=>$method,'class' => 'form-horizontal form-label-left'])!!}

                    <input type="hidden" name="id" value ="{{$inmueble->id}}" id= 'id'>


                    <div class="form-group">
                      {!!Form::label('tipo','Tipo Inmueble:',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      <select name='tipo' id="tipo" class="form-control col-md-7 col-xs-12">

                        @if (is_null($inmueble->tipo))
                          <option value="1" selected>Apto</option>
                          <option value="2">Casa</option>
                          <option value="3">PentHouse</option>
                          <option value="4">Anexo</option>
                          <option value="5">Local</option>
                        @else 

                          <option value="1" @if($inmueble->tipo == '1') selected @endif>Apto</option>
                          <option value="2" @if($inmueble->tipo == '2') selected @endif>Casa</option>
                          <option value="3" @if($inmueble->tipo == '3') selected @endif>PentHouse</option>
                          <option value="4" @if($inmueble->tipo == '4') selected @endif>Anexo</option>
                          <option value="5" @if($inmueble->tipo == '5') selected @endif>Local</option>
                        @endif 
                      </select>
                        
                    </div>
                </div>

                    <div class="form-group">
                        {!!Form::label('lb_id','Identificador:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('identificador',$inmueble->identificador,['class'=>'form-control col-md-7 col-xs-12'])!!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!!Form::label('lb_ocupante','Propietario / Inquilino:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('ocupante',$inmueble->ocupante,['class'=>'form-control col-md-7 col-xs-12'])!!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!!Form::label('lb_idlega','Rif / C.I :',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('id_legal',$inmueble->id_legal,['class'=>'form-control col-md-7 col-xs-12'])!!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!!Form::label('correo','Correo:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('email',$inmueble->email,['class'=>'form-control col-md-7 col-xs-12'])!!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!!Form::label('lb_porc','Porcentaje Cuota Condominio:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            {!!Form::text('porc_cuota',$inmueble->porc_cuota,['class'=>'form-control'])!!}
                        </div>
                         {!!Form::label('lb_periodo','* Ej : 3.45 ',['class' => 'col-md-3 col-sm-3 col-xs-12','style' => 'color:red;'])!!}
                    </div>

                    <div class="form-group">
                        {!!Form::label('lb_saldo_inicial','Saldo Inicial:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <input type="text" name="saldo_inicial" class="form-control col-md-7 col-xs-12" value="{{$inmueble->saldo_inicial}}" @if (isset($hayMov)) @if ($hayMov > 0) readonly @endif @endif>

                            
                        </div>
                        {!!Form::label('lb_periodo','*Indique el saldo de cuentas por cobrar al periodo '.$periodoinicial->periodo,['class' => 'control-label col-md-6 col-sm-3 col-xs-12'])!!}
                    </div>

                    <div class="form-group">
                        {!!Form::label('lb_saldo_inicial2','Confirmar Saldo Inicial:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <input type="text" name="saldo_inicial2" class="form-control col-md-7 col-xs-12" value="{{$inmueble->saldo_inicial}}" @if (isset($hayMov)) @if ($hayMov > 0) readonly @endif @endif>
                        </div>
                        {!!Form::label('lb_periodo','*Indique el saldo de cuentas por cobrar al periodo '.$periodoinicial->periodo,['class' => 'control-label col-md-6 col-sm-3 col-xs-12'])!!}
                    </div>
              
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">   
                            {!! link_to ('#', $title = $button, $attributes = ['id' => 'agregar','class' => 'btn btn-primary','data-target' => '#confirmBt', 'data-toggle' => "modal"],$secure = null) !!}                         
                            
                        </div>
                    </div>
             
            {!!Form::close()!!}
          </div>
        </div>
      </div>


@stop


@section ('jsscripts')

    


    <script type="text/javascript">
        
        $('#confirmBt').on('show.bs.modal', function (e) {

            @if ($inmueble->id > 0 )
                
                $message = 'Confirma modificar el inmueble?, luego de registrado no sera posible cambiar el saldo inicial';
            @else 
                $message = 'Confirma registrar el inmueble?, luego de registrado no sera posible cambiar el saldo inicial';
            @endif 
            $title = 'Confirma?'
            $(this).find('.modal-body p').text($message);
            $(this).find('.modal-title').text($title);
            var form = $(e.relatedTarget).closest('form');
            $(this).find('.modal-footer #confirm').data('form', form);
          });
          $('#confirmBt').find('.modal-footer #confirm').on('click', function(){

              $(this).data('form').submit();
          });
             


    </script>

@stop 