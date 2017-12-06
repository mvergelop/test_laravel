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
    <div class="x_panel">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                  <div class="card card-user">
                      <div class="content">
                        
                        @include ('alerts.error')
                        @include ('alerts.request')
                           {!!Form::open()!!}
                              <input type="hidden" name="_token" value ="{{ csrf_token()}}" id= 'token'>
                              <div class="row">
                                  <div class="col-md-4 col-xs-12">
                                      <div class="form-group">
                                          {!!Form::label('lb_gasto','Concepto de Ingreso:')!!}
                                           <select class="form-control col-md-7 col-xs-12" name="ingreso" id="id_ingreso">
                                              <option value='' disabled selected style='display:none;'>Seleccione un Ingreso</option>
                                              @foreach ($ingresos as $ingreso)
                                                <option value="{{$ingreso->id}}">{{$ingreso->descripcion}}</option>
                                              @endforeach 
                                          </select>
                                      </div>
                                  </div>
                                 
                                  <div class="col-md-3 col-xs-12"">
                                      <div class="form-group">
                                          {!!Form::label('lb_monto','Monto:')!!}
                                          {!!Form::text('monto',null,['class'=>'form-control','id'=>'monto'])!!}
                                      </div>
                                  </div>
                                  <div class="col-md-2 col-xs-12"">
                                    <div class="form-group">
                                        {!!Form::label('lb_fechadoc','Fecha Proceso.:')!!}
                                        <div class="input-group date" data-provide="datepicker">
                                            <input type="text" class="form-control datepicker" id="fecha_proceso" data-date-format="dd/mm/yyyy">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div>
                                        </div>
                                    </div>
                                  </div>

                                   <div class="col-md-4 col-xs-12"">
                                      <div class="form-group">
                                          {!!Form::label('lb_forma_cobro','Forma de Cobro:')!!}
                                           <select class="form-control col-md-7 col-xs-12" name="id_formapago" id="id_formapago">
                                              <option value='' disabled selected style='display:none;'>Forma de Cobro</option>
                                              @if (count($formaspago)> 0)
                                                @foreach ($formaspago as $formapago)
                                                  <option value="{{$formapago->id}}">{{$formapago->descripcion}}</option>
                                                @endforeach 
                                              @endif
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-3 col-xs-12"">
                                      <div class="form-group">
                                          {!!Form::label('lb_monto','Referencia:')!!}
                                          {!!Form::text('referencia',null,['class'=>'form-control','id'=>'referencia'])!!}
                                      </div>
                                  </div>
                                  
                                  <div class="col-md-2 col-xs-12">
                                    <div class="form-group ">
                                      <br>
                                      {!! link_to ('#', $title = 'Agregar', $attributes = ['id' => 'agregar','class' => 'btn btn-primary'],$secure = null) !!}
                                    </div>
                                  </div>
                              </div>
                          </div>
                          {!!Form::close()!!}
                         
                      </div>
                  </div>
              </div>
          </div>
    </div>


    <div class="x_panel">
      <div class="x_title">
        <h2>Ingresos Adicionales</h2>
        
        <div style="text-align: right;">
          <label id='totalgastos'> </label>
          <button class="btn btn-warning" id='btfinalizar'>Finalizar<i class="fa fa-gear"></i></button>
        </div>
        <ul class="nav navbar-right panel_toolbox">
        </ul>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">
        @include ('layouts.modalquestion')
        <div class="">
          <table class="table table-striped jambo_table bulk_action">
            <thead>
              <tr class="headings">
                <th class="column-title">Concepto</th>
                <th class="column-title">Monto</th>
                <th class="column-title">Fecha Proceso</th>
                <th class="column-title"></th>
              </tr>
            </thead>                
            <tbody id='datostemp'>
            </tbody>             
           
          </table>
          
        </div>
      </div>
    </div>              

@stop

@section ('jsscripts')  

    <script src="{{env('ROUTE_CSSJS') }}js/jquery.mask.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
          $('.money').mask('000.000.000.000.000,00', {reverse: true});
      });
  </script>
  @include ('common_js.validafecproceso');

   @include('regingresosadi.js');
  
   
  
  
@stop 