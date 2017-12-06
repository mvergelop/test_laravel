@extends('layouts.principal')
@section('menu')    
    @include('layouts.menu1')  
@stop

@section('usuario')    
    @include ('layouts.usuariotoolbar')
@stop

@section ('contenido')

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">

            <h2>Anulacion de Cuotas</h2>

            <ul class="nav navbar-right panel_toolbox">
               
            </ul>

            <div class="clearfix">
                <input type="hidden" name="_token" value ="{{ csrf_token()}}" id= 'token'>
            </div>
              <label for="filtro" style="margin-top: 18px;margin-left: 10px;">Buscar Inmueble / Periodo</label>
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

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    /*errorConexion(xhr,ajaxOptions);*/
                }

            });




        }


    </script>



@stop 