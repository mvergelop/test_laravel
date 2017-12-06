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
            <span id="texto_modal"></span>             
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

            <h2>Anulacion Movimientos de Gastos</h2>

            <ul class="nav navbar-right panel_toolbox">
               
            </ul>
           
            <div class="clearfix">
                <input type="hidden" name="_token" value ="{{ csrf_token()}}" id= 'token'>
            </div>
              <label for="filtro" style="margin-top: 18px;margin-left: 10px;">Buscar Gasto</label>
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
                    <th class="column-title">Concepto</th>
                    <th class="column-title">Documento</th>
                    <th class="column-title">Proveedor</th>
                    <th class="column-title">Monto</th>
                    <th class="column-title">Fecha</th>
                    <th class="column-title"></th>
                  </tr>
                </thead>                

                  <tr class="even pointer">


                    <tbody id="tabla_gastos">

                            
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
            buscar_gastos('');
        })


        $("#buscar").click(function (){


            var filtro = $("#filtro").val();
            buscar_gastos(filtro);

          

        })

        var g_id = '';
        var g_gasto = '';
        var g_monto = '';
        var g_fecha = '';
        

        function confirma_anular(gasto,monto,fecha,id){

            console.log('aca');

            $('#confirmBt').modal('show');
            g_id = id;
            g_gasto = gasto;
            g_monto = monto;
            g_fecha = fecha;


            $message = 'Confirma anular el gasto ' + gasto + ' por un monto de ' + monto + ' con fecha ' + fecha;

            console.log('aca ' + $message);
          
            $title = 'Confirma?'
            $('#texto_modal').text($message);
            $("#modal-title").text($title);
          

        }

       
        
        
         $('#confirmBt').find('.modal-footer #confirm').on('click', function(){

            console.log('aca');

            var route ="{{env('URL_JSON')}}anular_gasto";
            var token = $("#token").val();
            var monto_periodo = $("#monto_periodo").val();

             $.ajax({
                url : route,
                headers: {'X-CSRF-TOKEN': token},
                type : "post",
                data : {
                  'id' :g_id,
                  'gasto':g_gasto,
                  'monto':g_monto,
                  'fecha':g_fecha                  
                },
                dataType: 'json',
                success :function(data) {
                    $('#confirmBt').modal('hide');

                    var filtro = $("#filtro").val();
                    buscar_gastos(filtro);

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    /*errorConexion(xhr,ajaxOptions);*/
                }

            });

            
              
          });
            




        function buscar_gastos (filtro){


            var route ="{{env('URL_JSON')}}buscar_gastos";
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
                                    '<td>'+data[i].des_gasto+'</td>' +
                                    '<td>'+data[i].documento+'</td>'+
                                    '<td>'+data[i].des_proveedor+'</td>'+
                                    '<td>'+data[i].monto+'</td>'+
                                    '<td>'+fechamask(data[i].fecha_doc)+'</td>'+
                                    '<td>'+
                                        '<div >'+
                                            '<button class="btn btn-danger" id="anular" onclick="confirma_anular('+"'"+data[i].des_gasto+"'"+",'"+data[i].monto+"','"+fechamask(data[i].fecha_doc)+"','"+data[i].id+"')"+'">Anular</button>'+
                                        '</div>'+
                                    '</td>'+
                            '</tr>';
                    }

                    $("#tabla_gastos").html(html);



                },
                error: function (xhr, ajaxOptions, thrownError) {
                    /*errorConexion(xhr,ajaxOptions);*/
                }

            });




        }


    </script>



@stop 