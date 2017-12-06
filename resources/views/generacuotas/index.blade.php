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

             <h2>Genera Cuota Ordinaria</small></h2>

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

                        <!-- {!!Form::open(['route'=>'generacuotas.store', 'method'=>'POST'])!!} -->
                            <input type="hidden" name="_token" value ="{{ csrf_token()}}" id= 'token'>
                            <div class="row">

                                <div class="col-md-5 col-sm-6 col-xs-12">

                                  

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

                                        {!!Form::label('lb_periodo','Periodo:')!!}

                                         <select class="form-control col-md-7 col-xs-12" name="periodo">

                                            @foreach($periodos as $periodo)

                                              <option value="{{$periodo->id}}">{{$periodo->periodo}}</option>

                                            @endforeach

                                        </select>

                                    </div>

                                </div>

                                <div class="form-group">

                                  <div class="col-md-1">

                                     <!-- <button class="btn btn-success" 

                                      type="button" 

                                      data-toggle="modal" 

                                      data-target="#confirmBt" 

                                      data-title='Generar Cuotas' 



                                      data-message='¿Confirma generar las cuotas para el periodo ingresado?'>

                                      Procesar

                                      </button> -->

                                    <button class="btn btn-success" id="calcula_cuotas" >
                                        Procesar
                                    </button>

                                  </div>

                              </div>

                            </div>

                            <br>



                        </div>

                        <!-- {!!Form::close()!!} -->

                       

                    </div>

                </div>

            </div>

        </div>

    </div>   





    </div> 

    <div class="x_panel">
        <div class="x_title">
            <h2>Cuotas</h2>            
            <ul class="nav navbar-right panel_toolbox"></ul>
            <div class="clearfix" style="text-align: right;" >
                <button class="btn btn-danger" id="finalizar_proceso" 
                     type="button" 

                                      data-toggle="modal" 

                                      data-target="#confirmBt" 

                                      data-title='Generar Cuotas' 



                                      data-message='¿Confirma generar las cuotas para el periodo ingresado?' style="display:none;">
                                        Finalizar
                                    </button>
            </div>          
            <div class="x_content">
                <br />
                <div class="">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card card-user">
                                <div class="content"> 
                                    <div id="box"></div>  

                                </div>
                            </div>
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

    $("#confirm").click(function (){
        var route ="{{env('URL_JSON')}}generacuotas/guardar";
        var token = $("#token").val();
        $.ajax({
            url : route,
            headers: {'X-CSRF-TOKEN': token},
            type : "post",
            success :function(data) {
                console.log(data);   
                if (data == 'OK'){
                    location.reload();

                }    
            }
        });


        
    });

    $("#calcula_cuotas").click(function (){

        var route ="{{env('URL_JSON')}}generacuotas/storetemp";
        var save ="{{env('URL_JSON')}}generacuotas/storetempsave";
        var token = $("#token").val();
        
        $.ajax({
            url : route,
            headers: {'X-CSRF-TOKEN': token},
            type : "post",
            data : {
              'periodo' : $('select[name="periodo"]').val(),
              'tipo_cuota':$("input[name=tipo_cuota]:checked").val(),
              'cuotaordinaria' : $("input[name=cuotaordinaria]").val()
            },
            dataType: 'json',
            success :function(data) {
                console.log(data);   
                $("#box").html('');
                $("#finalizar_proceso").css('display','');

                webix.ready(function(){
                    grida = webix.ui({
                        container:"box",
                        view:"datatable",
                        editable:true,
                        editaction:"dblclick",
                        columns:[
                            { id:"id",    hidden:true},
                            { id:"id_inmueble",   hidden:true},
                            { id:"identificador",    header:"Inmueble" , width:200},
                            { id:"monto",   header:"Monto",     width:100 , editor:"text"}
                        ],
                        autoheight:true,
                        autowidth:true,
                        data: data,
                        save :save
                    }); 
                });
                
                webix.attachEvent("onBeforeAjax", 
                    function(mode, url, data, request, headers, files, promise){
                        headers["X-CSRF-TOKEN"]= token;
                    }
                );



            },
            error: function (xhr, ajaxOptions, thrownError) {
                
            }

        });


    })



  </script>

  <script src="{{ENV('ROUTE_CSSJS') }}js/confirm_question.js"></script>
  
  <script src="{{env('ROUTE_CSSJS') }}js/webix.js" type="text/javascript" charset="utf-8"></script>

  <link href="{{env('ROUTE_CSSJS') }}css/webix.css" rel="stylesheet">
  



  

    

@stop 