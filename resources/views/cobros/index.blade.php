@extends('layouts.principal')



@section('menu')    

    @include('layouts.menu1')  

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

                              <input type="hidden" name="_monto_cuota" value ="0" id= '_monto_cuota'>

                              <input type="hidden" name="_extra" value ="0" id= '_extra'>

                              <div class="row">

                                  <div class="col-md-3 col-xs-12">

                                      <div class="form-group">

                                          {!!Form::label('lb_cuota','Inmueble:')!!}

                                           <select class="form-control" name="inmueble" id="id_inmueble">

                                              <option value='' disabled selected style='display:none;'>Seleccione un Inmueble</option>

                                              @if (count($inmuebles)> 0)

                                                @foreach ($inmuebles as $inmueble)

                                                  <option value="{{$inmueble->id}}">{{$inmueble->identificador . ' - ' . $inmueble->ocupante}}</option>

                                                @endforeach 

                                              @endif 

                                          </select>

                                      </div>

                                  </div>

                                  <div class="col-md-3 col-xs-12"">

                                      <div class="form-group">

                                          {!!Form::label('lb_periodo','Periodo:')!!}

                                            <select class="form-control" name="periodo" id='periodo'>

                                            </select>

                                      </div>

                                  </div>

                                  <div style="display:block;">

                                    <div class="col-md-2 col-xs-12">

                                      <div class="form-group">

                                        {!!Form::label('lb_prontopago','Pronto Pago?')!!}<br>

                                        <input type="radio" name="pronto_pago" id='pronto_pago_1' value="no" checked>NO &nbsp;&nbsp;&nbsp;

                                        <input type="radio" name="pronto_pago" id='pronto_pago_2' value="si">SI<br>

                                      </div>

                                    </div>

                                    <div class="col-md-2 col-xs-12"">

                                      <div class="form-group">

                                          {!!Form::label('lb_monto','Cobro de Cuota:')!!}

                                          {!!Form::text('monto',null,['class'=>'form-control','id'=>'monto'])!!}

                                      </div>

                                  </div>

                                    <div class="col-md-2 col-xs-12"">

                                        <div class="form-group">

                                            {!!Form::label('lb_desc','Monto Descuento:')!!}

                                            {!!Form::text('monto_desc',null,['class'=>'form-control','id'=>'monto_desc', 'disabled'=>'disabled'])!!}

                                        </div>

                                    </div>

                                  </div>

                                  

                              </div>

                              <div class="row">

                                  <div class="col-md-2 col-xs-12"">

                                      <div class="form-group">

                                          {!!Form::label('lb_fechadoc','Fecha Cobro.:')!!}

                                          <div class="input-group date" data-provide="datepicker">

                                              <input type="text" class="form-control datepicker" id="fecha_doc" data-date-format="dd/mm/yyyy">

                                              <div class="input-group-addon">

                                                  <span class="glyphicon glyphicon-th"></span>

                                              </div>

                                          </div>

                                      </div>

                                  </div>

                                  <div class="col-md-4 col-xs-12"">

                                      <div class="form-group">

                                          {!!Form::label('lb_forma_cobro','Forma de Cobro:')!!}

                                           <select class="form-control col-md-7 col-xs-12" name="id_forma_pago" id="id_forma_pago">

                                              <option value='' disabled selected style='display:none;'>Forma de Cobro</option>

                                              @if (count($formaspago)> 0)

                                                @foreach ($formaspago as $formapago)

                                                  <option value="{{$formapago->id}}">{{$formapago->descripcion}}</option>

                                                @endforeach 

                                              @endif

                                          </select>

                                      </div>

                                  </div>

                                  <div class="col-md-2 col-xs-12"">

                                      <div class="form-group">

                                          {!!Form::label('lb_monto','Referencia:')!!}

                                          {!!Form::text('referencia',null,['class'=>'form-control','id'=>'referencia'])!!}

                                      </div>

                                  </div>

                                  

                                  <div class="col-md-4 col-xs-12" style="text-align: right;">

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

        <h2>Inmuebles</h2>

        <div style="text-align: right;">

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

                <th class="column-title">Inmueble</th>

                <th class="column-title">Periodo</th>

                <th class="column-title">Monto</th>

                <th class="column-title">Pronto Pago</th>

                <th class="column-title">Forma Cobro</th>

                <th class="column-title">Fecha Cobro</th>

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



  @include('cobros.js')

  

@stop 