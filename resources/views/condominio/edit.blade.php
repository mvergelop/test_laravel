@extends('layouts.principal')

@section('menu')    
    @include('layouts.menu1')  
@stop



@section('nombre_accion')
    <span>Registro de Usuario</span>
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

            
            
            <input type="hidden" name="_token" value ="{{ csrf_token()}}" id= 'token'>
            <input type="hidden" name="id" value ="{{ $condominio->id}}" id= 'id'>

            <div class="form-horizontal form-label-left"> 
                    <div class="form-group">
                        {!!Form::label('nombre','Nombre:',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('nombre',$condominio->nombre,['class'=>'form-control col-md-7 col-xs-12', 'onkeyup' => 'llenaUrl();', 'id' => 'nombre' ])!!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!!Form::label('direccion','Direccion:',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('direccion',$condominio->direccion,['class'=>'form-control col-md-7 col-xs-12','id' =>'direccion'])!!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                          {!!Form::label('administrador','Administrador:',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('administrador',$condominio->administrador,['class'=>'form-control col-md-7 col-xs-12','id' =>'administrador'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                          {!!Form::label('tipo','Tipo:',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::select('tipo', ['1' => 'Edificio', '2' => 'Conjunto Recidencial','3' => 'Centro Comercial'], '1',
                            ['class'=>'form-control col-md-7 col-xs-12','id' =>'tipo'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                          {!!Form::label('cant_inmuebles','Numero de Inmuebles:',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('cant_inmuebles',$condominio->cant_inmuebles,['class'=>'form-control col-md-7 col-xs-12','id' =>'cant_inmuebles'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('niveles','Posee Niveles:',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::checkbox('niveles', '1',$condominio->niveles,array('onchange' => 'agreganivel()','id' =>'niveles')) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                          {!!Form::label('cant_niveles','Numero de Niveles:',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('cant_niveles',$condominio->cant_niveles,['class'=>'form-control col-md-7 col-xs-12','id' =>'cant_niveles'])!!}
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
                            <select class="form-control col-md-4 col-xs-12'" id='periodo' name="periodo" disabled="disabled">
                                <option value="{{$cuotaordinaria->id}}" selected="selected">{{$cuotaordinaria->periodo}}</option>
                            </select>
                          </div>
                          {!!Form::label('lb_periodo','*Una vez guardado no es posible cambiarlo',['class' => 'control-label col-md-4 col-sm-3 col-xs-12'])!!}
                    </div>
                    
                      
                     <div class="form-group">
                        {!!Form::label('url','Url de Acceso www.netus.com.ve/',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('url',$condominio->url,['class'=>'form-control col-md-7 col-xs-12', 'id' => 'url','disabled' => 'true'])!!}
                        </div>
                    </div>


                    
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                             {!!link_to('#', $title='Actualizar', $attributes = ['id'=>'actualizar', 'class'=>'btn btn-primary'], $secure = null)!!}
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



     //$("#rb_monto_fijo").prop("checked", true);

    var radios = $('input:radio[name=tipo_cuota]');
      if(radios.is(':checked') === false) {

        @if (isset ($condominio->tipo_cuota_defecto))
          radios.filter('[value={{ $condominio->tipo_cuota_defecto }}]').prop('checked', true);
        @else
          radios.filter('[value=1]').prop('checked', true);
        @endif 
      }

      
      $('body').on('click','#remove',function(){
          
          $(this).parent('div').remove();

          
      });

          
  });

  </script>

  <script src="{{URL::to('/') }}/public/js/condominio.js"></script>


  <script> 
      $("#actualizar").click(function(){
        var id = $("#id").val();
        var nombre = $("#nombre").val();
        var direccion = $("#direccion").val();
        var administrador = $("#administrador").val();
        var tipo = $("#tipo").val();
        var cant_inmuebles = $("#cant_inmuebles").val();
        var niveles = $("#niveles").val();
        var cant_niveles = $("#cant_niveles").val();
        var url = $("#url").val();
        var tipo_cuota = $('input[name="tipo_cuota"]:checked').val();

        
        var route = "{{URL::to('/') }}/condominio/"+id+"";
        var token = $("#token").val();

        $.ajax({
          url: route,
          headers: {'X-CSRF-TOKEN': token},
          type: 'PUT',
          dataType: 'json',
          data: {id: id,
                 nombre : nombre,
                 direccion : direccion,
                 administrador : administrador,
                 tipo          : tipo,
                 cant_inmuebles : cant_inmuebles,
                 niveles : niveles,
                 cant_niveles : cant_niveles,
                 url : url,
                 tipo_cuota : tipo_cuota},
          success: function(){
            new PNotify({
                title: '<b>Actualizado</b>',
                text: 'Datos del condominio fueron actualizados correctamente',
                type: 'success'
            });
          }
        });
    });


  </script>





@stop 