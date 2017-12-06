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

  <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
             <h2>Generar Cuota Extra</small></h2>
            <ul class="nav navbar-right panel_toolbox">
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-user">
                    <div class="content">
                      @include ('layouts.modalquestion')
                      @include ('alerts.error')
                      @include ('alerts.request')
                         {!!Form::open(['route'=>'generacuotasextra.store', 'method'=>'POST'])!!}
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                  
                                  <label class="btn btn-success">
                                    <input name="tipo_cuota" type="radio" value="1" id="rb_monto_fijo"> Monto Fijo  
                                  </label>
                                  <label class="btn btn-success">
                                    <input name="tipo_cuota" type="radio" value="2" id="rb_porcentaje"> Porcentaje
                                  </label>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!!Form::label('lb_cuota','Cuota:')!!}
                                        {!!Form::text('cuotaordinaria',0,['class'=>'form-control'])!!}

                                        @if ($cuota_val > 0)
                                          {!!Form::label('lb_cuota2','* Ultima Cuota Generada')!!}
                                        @endif   
                                   
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!!Form::label('lb_periodo','Periodo Inicial:')!!}
                                         <select class="form-control col-md-7 col-xs-12" name="periodo">
                                            @foreach($periodos as $periodo)
                                              <option value="{{$periodo->id}}">{{$periodo->periodo}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="form-group">
                                    {!!Form::label('lb_cuota','Cant Cuotas:')!!}
                                    {!!Form::text('cantcuotas',1,['class'=>'form-control'])!!}
                                  </div>
                                </div>
                               
                                <div class="col-md-1">
                                  <br>
                                  <div class="form-group">
                                     <button class="btn btn-success" 
                                      type="button" 
                                      data-toggle="modal" 
                                      data-target="#confirmBt" 
                                      data-title='Generar Cuotas' 
                                      data-message='¿Confirma generar las cuotas para el periodo ingresado?'>
                                      Procesar
                                      </button>
                                  </div>
                              </div>
                            </div>
                            <br>

                        </div>
                        {!!Form::close()!!}
                       
                    </div>
                </div>
            </div>
        </div>
    </div>     
    </div>          

@stop

@section ('jsscripts')  
  <script>

    $(document).ready(function(){
      var radios = $('input:radio[name=tipo_cuota]');
      if(radios.is(':checked') === false) {
        
        @if (isset ($tipo_cuota))
          radios.filter('[value={{ $tipo_cuota }}]').prop('checked', true);
        @else
          radios.filter('[value=1]').prop('checked', true);
        @endif 
      }

    });

  </script>
  <script src="{{ENV('ROUTE_CSSJS') }}js/confirm_question.js"></script>

  

  
    
@stop 