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
                                          {!!Form::label('lb_gasto','Concepto de Gasto:')!!}
                                           <select class="form-control col-md-7 col-xs-12" name="gasto" id="id_gasto">
                                              <option value='' disabled selected style='display:none;'>Seleccione un Gasto</option>
                                              @foreach ($gastos as $key => $gasto)

                                                @if ($key == 0)
                                                  <option value='' disabled><---------- {{$gasto->tipogasto}} ----------></option>                                                  
                                                @endif 
                                                @if ($tipogasto <> $gasto->tipogasto && $agregado == 0)
                                                  {{$agregado = 1}}
                                                  <option value='' disabled><---------- {{$gasto->tipogasto}} ----------></option>                                                  
                                                @endif 
                                                


                                                <option value="{{$gasto->id}}">{{$gasto->descripcion}}</option>
                                              @endforeach 
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-3 col-xs-12"">
                                      <div class="form-group">
                                          {!!Form::label('lb_documento','Documento:')!!}
                                          {!!Form::text('documento',null,['class'=>'form-control','id'=>'documento'])!!} 
                                      </div>
                                  </div>
                                  
                                  <div class="col-md-2 col-xs-12"">
                                      <div class="form-group">
                                          {!!Form::label('lb_fechadoc','Fecha Doc.:')!!}
                                          <div class="input-group date" data-provide="datepicker">
                                              <input type="text" class="form-control datepicker" id="fecha_doc" data-date-format="dd/mm/yyyy">
                                              <div class="input-group-addon">
                                                  <span class="glyphicon glyphicon-th"></span>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-3 col-xs-12"">
                                      <div class="form-group">
                                          {!!Form::label('lb_monto','Monto:')!!}
                                          {!!Form::text('monto',null,['class'=>'form-control','id'=>'monto'])!!}
                                      </div>
                                  </div>
                                  <div class="col-md-4 col-xs-12"">
                                      <div class="form-group">
                                          {!!Form::label('lb_forma_cobro','Forma de Pago:')!!}
                                           <select class="form-control col-md-7 col-xs-12" name="id_formapago" id="id_formapago">
                                              <option value='' disabled selected style='display:none;'>Forma de Pago</option>
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
                                          {!!Form::label('lb_idproveedor','Rif. / C.I :')!!}
                                          {!!Form::text('id_proveedor',null,['class'=>'form-control','id'=>'id_provedor'])!!}
                                      </div>
                                    </div>
                                    <div class="col-md-3 col-xs-12"">
                                      <div class="form-group">
                                          {!!Form::label('lb_proveedor','Razon Social :')!!}
                                          {!!Form::text('des_proveedor',null,['class'=>'form-control','id'=>'des_proveedor'])!!}
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
        <h2>Gastos</h2>
        
        <div style="text-align: right;">
          <label id='totalgastos'> </label>
          <button class="btn btn-warning" data-target='#confirmBt' data-tipo='2' data-toggle="modal">Finalizar <i class="fa fa-gear"></i></button>
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
                <th class="column-title">Documento</th>
                <th class="column-title">Proveedor</th>
                <th class="column-title">Monto</th>
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

   <script>
       $.fn.datepicker.defaults.format = "dd/mm/yyyy";
      $(document).ready(function() {
        $('#fecha_doc').datepicker('setDate', new Date());
        $('#fecha_proceso').datepicker('setDate', new Date());
        
      });
     
    </script>
   @include ('common_js.validafecproceso');
   @include('registrogastos.js');
  
   
  
  
@stop 