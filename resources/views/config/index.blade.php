@extends('layouts.principal')

@extends('common_js.pnotify_include')

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
             <h2>Configuraciones</small></h2>
            <ul class="nav navbar-right panel_toolbox">
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content" style="text-align: left;">
            <br />
            @include ('alerts.request')

                {!!Form::open(['url'=>'configuracion', 'method'=>'POST','class' => 'form-horizontal form-label-left','files' => true,'id' => 'Form'])!!}

                   <input type="hidden" name="_token" id='token' value="{{ csrf_token() }}">

                    <div class="form-group">
                        {!!Form::label('lb_des','Terminos y Condiciones:',['class' =>'control-label col-md-3 col-sm-1 col-xs-1'])!!}
                                        
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <input type="text" class="form-control" name="_adjunto1" value = "{{$config->adjunto1_filename}}" readonly="">
                        </div>
                        <div class="col-md-5 col-sm-6 col-xs-12">
                          <input type="file" class="form-control filestyle" name="adjunto1" id='adjunto1' data-classButton="btn btn-primary" data-classIcon="icon-plus" data-buttonText="Seleccione un Archivo" accept=".pdf" >
                        </div>

                         
                    </div>

                    <div class="form-group">
                        {!!Form::label('lb_des','Manual de Usuario:',['class' =>'control-label col-md-3 col-sm-1 col-xs-1'])!!}
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <input type="text" class="form-control" name="_adjunto2" value = "{{$config->adjunto2_filename}}" readonly="">
                        </div>          
                        <div class="col-md-5 col-sm-6 col-xs-12">
                          <input type="file" class="form-control filestyle" name="adjunto2" id='adjunto2' data-classButton="btn btn-primary" data-classIcon="icon-plus" data-buttonText="Seleccione un Archivo" accept=".pdf" >
                        </div>
                    </div>

                    <div class="form-group">
                        {!!Form::label('lb_des','Planes Netus.com.ve:',['class' =>'control-label col-md-3 col-sm-1 col-xs-1'])!!}
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <input type="text" class="form-control" name="_adjunto3" value = "{{$config->adjunto3_filename}}" readonly="">
                        </div>          
                        <div class="col-md-5 col-sm-6 col-xs-12">
                          <input type="file" class="form-control filestyle" name="adjunto3" id='adjunto3' data-classButton="btn btn-primary" data-classIcon="icon-plus" accept="image/*" data-buttonText="Seleccione un Archivo" >
                        </div>
                    </div>

                    <div class="form-group">
                        {!!Form::label('lb_des','Correo Contacto:',['class' =>'control-label col-md-3 col-sm-1 col-xs-1'])!!}
                        <div class="col-md-5 col-sm-6 col-xs-12">
                          <input type="text" class="form-control" name="contacto" value = "{{$config->contacto}}">
                        </div>
                    </div>

                    <div class="form-group">
                        {!!Form::label('lb_des','Inmuebles:',['class' =>'control-label col-md-3 col-sm-1 col-xs-1'])!!}
                          <div class="col-md-1 col-sm-3 col-xs-3">
                            {!!Form::label('lb_des','Plan 1:',['class' =>'control-label'])!!}
                            <input type="text" class="form-control" name="plan1" id = 'plan1' value = "{{$config->plan1}}">
                          </div>
                          <div class="col-md-1 col-sm-3 col-xs-3">
                            {!!Form::label('lb_des','Plan 2:',['class' =>'control-label'])!!}
                            <input type="text" class="form-control" name="plan2" id = 'plan2' value = "{{$config->plan2}}">
                          </div>
                          <div class="col-md-1 col-sm-3 col-xs-3">
                            {!!Form::label('lb_des','Plan 3:',['class' =>'control-label'])!!}
                            <input type="text" class="form-control" name="plan3"  id = 'plan3' value = "{{$config->plan3}}">
                          </div>
                          <div class="col-md-1 col-sm-3 col-xs-3">
                            {!!Form::label('lb_des','Plan 4:',['class' =>'control-label'])!!}
                            <input type="text" class="form-control" name="plan4"  id = 'plan4' value = "{{$config->plan4}}">
                          </div>
                          <div class="col-md-1 col-sm-3 col-xs-3">
                            {!!Form::label('lb_des','Plan 5:',['class' =>'control-label'])!!}
                            <input type="text" class="form-control" name="plan5"  id = 'plan5' value = "{{$config->plan5}}">
                          </div>
                          <div class="col-md-1 col-sm-3 col-xs-3">
                            {!!Form::label('lb_des','Plan 6:',['class' =>'control-label'])!!}
                            <input type="text" class="form-control" name="plan6"  id = 'plan6' value = "{{$config->plan6}}">
                          </div>
                      </div>

                    

                    
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <input class="btn btn-success" type="submit" value="Guardar">
                        </div>
                    </div>
             
            {!!Form::close()!!}
          </div>
        </div>
      </div>


@stop

@section ('jsscripts')

  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-filestyle/1.2.1/bootstrap-filestyle.min.js"></script>


 <script type="text/javascript">

  $("#Form").on("submit", function(e){
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var formData = new FormData(document.getElementById("Form"));

        var plan1 = $("#plan1").val();
        var plan2 = $("#plan2").val();
        var plan3 = $("#plan3").val();
        var plan4 = $("#plan4").val();
        var plan5 = $("#plan5").val();
        var plan6 = $("#plan6").val();

        var Ok = '1';
        if (parseInt(plan2) > 0 ){
          if (parseInt(plan1) > parseInt(plan2)){
            msjPnotify('error','Advertencia','Los <b>Inmuebles de Plan 1 </b> no deben superar al <b>Plan 2</b>');
            Ok = '0';
          }
        }
        if (parseInt(plan3) > 0 ){
          if (parseInt(plan2) > parseInt(plan3)){
            msjPnotify('error','Advertencia','Los <b>Inmuebles de Plan 2 </b> no deben superar al <b>Plan 3</b>');
            Ok = '0';
          }
        }
        if (parseInt(plan4) > 0 ){
          if (parseInt(plan3) > parseInt(plan4)){
            msjPnotify('error','Advertencia','Los <b>Inmuebles de Plan 3 </b> no deben superar al <b>Plan 4</b>');
            Ok = '0';
          }
        }
        if (parseInt(plan5) > 0 ){
          if (parseInt(plan4) > parseInt(plan5)){
            msjPnotify('error','Advertencia','Los <b>Inmuebles de Plan 4 </b> no deben superar al <b>Plan 5</b>');
            Ok = '0';
          }
        }
        if (parseInt(plan6) > 0 ){
          if (parseInt(plan5) > parseInt(plan6)){
            msjPnotify('error','Advertencia','Los <b>Inmuebles de Plan 5 </b> no deben superar al <b>Plan 6</b>');
            Ok = '0';
          }
        }

        //formData.append("dato", "valor");
        //formData.append(f.attr("name"), $(this)[0].files[0]);
        if (Ok == '1'){
            $.ajax({
              url: url,
              type: "post",
              dataType: "html",
              data: formData,
              cache: false,
              contentType: false,
              processData: false
            })
                .success(function(result){
                    msjPnotify('success','Actualizado','Las <b>Configuraciones</b> se han actualizado correctamente'); 
                    //location.reload();
                }).fail( function( request ) {
                    var errors = $.parseJSON(request.responseText);
                    requestErrorHandler(errors);
                    
                    
                    
                });

        }
        
    });
   
 </script>

@stop