@extends('layouts.principal')
@section('menu')    
    @include('layouts.menu1')  
@stop

@section('usuario')    
    @include ('layouts.usuariotoolbar')
@stop

@section ('contenido')

    <div class="modal fade" id="confirmBt" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id='modal-title'></h4>
          </div>
          <div class="modal-body" id='modal-body'>
            <p></p>
         </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success" id="confirm">Aceptar</button>
          </div>
        </div>
      </div>
    </div>


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">

            <h2>Anulacion de Cuotas</h2>

            <ul class="nav navbar-right panel_toolbox">
               
            </ul>
           
            <div class="clearfix">
                <input type="hidden" name="_token" value ="{{ csrf_token()}}" id= 'token'>
            </div>
              <label for="filtro" style="margin-top: 18px;margin-left: 10px;">Buscar Inmueble</label>
                <div class="form-group">
                    <div class="col-md-5">
                        <input type="text" name="filtro" id="filtro" class="form-control">    

                    </div>
                     <a href="#" id="buscar" class="btn btn-success " >Buscar</a>
                    
                </div>
                <br>
              


          </div>



          <div class="x_content">

            <div class="">

              <table class="table table-striped jambo_table bulk_action">

                <thead>

                  <tr class="headings">

                    <th class="column-title">Periodo</th>

                    <th class="column-title">Inmueble</th>

                    <th class="column-title">Ocupante</th>

                    <th class="column-title">Monto</th>

                    <th class="column-title">Fecha Registro</th>

                    <th class="column-title"></th>

                  </tr>

                </thead>                

                  <tr class="even pointer">


                    <tbody id="tabla_cuotas">

                            
                    </tbody>  


                  </tr>                

               

              </table>

            
            </div>

          </div>

        </div>

      </div>



  



@stop



@section ('jsscripts')  

    <script type="text/javascript">

        $(document).ready(function (){
            buscar_cuotas('');
        })


        $("#buscar").click(function (){


            var filtro = $("#filtro").val();
            buscar_cuotas(filtro);

          

        })

        var g_id_periodo = '';
        var g_id_inmueble = '';

        function confirma_anular(periodo,inmueble,id_periodo,id_inmueble){

            console.log('aca');

            $('#confirmBt').modal('show');
            g_id_inmueble = id_inmueble;
            g_id_periodo = id_periodo;




            $message = 'Confirma Anular el periodo ' + periodo + ', para el inmueble ' + inmueble;

            console.log('aca ' + $message);
          
            $title = 'Confirma?'
            $('#modal-body').text($message);
            $("#modal-title").text($title);
          

        }

       
        
        
         $('#confirmBt').find('.modal-footer #confirm').on('click', function(){

            console.log('aca');

            var route ="{{env('URL_JSON')}}anular_cuota";
            var token = $("#token").val();

             $.ajax({
                url : route,
                headers: {'X-CSRF-TOKEN': token},
                type : "post",
                data : {
                  'id_periodo' :g_id_periodo,
                  'id_inmueble':g_id_inmueble
                },
                dataType: 'json',
                success :function(data) {
                    $('#confirmBt').modal('hide');

                    var filtro = $("#filtro").val();
                    buscar_cuotas(filtro);

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    /*errorConexion(xhr,ajaxOptions);*/
                }

            });

            
              
          });
            




        function buscar_cuotas (filtro){


            var route ="{{env('URL_JSON')}}buscar_cuotas";
            var token = $("#token").val();


            $.ajax({
                url : route,
                headers: {'X-CSRF-TOKEN': token},
                type : "post",
                data : {
                  'filtro' :filtro
                },
                dataType: 'json',
                
                success :function(data) {
                    console.log(data);

                    var html = ''
                    for (i in data){

                             

                        html = html + 
                                '<tr>' +
                                    '<td>'+data[i].periodo+'</td>' +
                                    '<td>'+data[i].des_inmueble+'</td>'+
                                    '<td>'+data[i].ocupante+'</td>'+
                                    '<td>'+data[i].monto+'</td>'+
                                    '<td>'+fechamask(data[i].fecha_registro)+'</td>'+
                                    '<td>'+
                                        '<div >'+
                                            '<button class="btn btn-danger btn-xs" id="anular" onclick="confirma_anular('+"'"+data[i].periodo+"'"+",'"+data[i].des_inmueble+"','"+data[i].id_periodo+"','"+data[i].id_inmueble+"'"+')"  >Anular</button>'+
                                        '</div>'+
                                    '</td>'+
                            '</tr>';
                    }

                    $("#tabla_cuotas").html(html);



                },
                error: function (xhr, ajaxOptions, thrownError) {
                    /*errorConexion(xhr,ajaxOptions);*/
                }

            });




        }


    </script>



@stop 