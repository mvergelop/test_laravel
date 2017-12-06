@extends('layouts.principal')









@include('alerts.success')



@section('menu')    

    @if ($tipomenu == '2')

      @include('layouts.menu1')  

    @else 

      @include('layouts.menu_user3')  

    @endif 

@stop









@section('usuario')    

    @include ('layouts.usuariotoolbar')

@stop





@section ('contenido')



  <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="x_panel">

          <div class="x_title">

            <h2>Resumen del Periodo </h2>

            <ul class="nav navbar-right panel_toolbox">

              <div class="x_content">

                  <select class="btn btn-primary dropdown-toggle btn-sm" id='idPeriodo'>

                    

                  </select>



                </div>

            </ul>

            <div class="clearfix"></div>

          </div>



          <div class="x_content">

            <div class="">

              <table class="table table-striped jambo_table bulk_action">

                <thead>

                  <tr class="headings">

                    <th class="column-title">Concepto</th>

                    <th class="column-title">Monto</th>

                  </tr>

                </thead>                

                  <tbody id='resumen'>

                    

                </tbody>   

              </table>

            </div>

          </div>

        </div>

      </div>



  <div class="col-md-6 col-sm-6 col-xs-12">

    <div class="x_panel">

      <div class="x_title">

        <h2></h2>

        

        <div class="clearfix"></div>

      </div>

      <div class="x_content">

        <canvas id="mybarChart"></canvas>

      </div>



    </div>

  </div>

    <div class="col-md-6 col-sm-6 col-xs-12">

    <div class="x_panel">

      <div class="x_title">

        <h2></h2>

        

        <div class="clearfix"></div>

      </div>

      <div class="x_content">

        <canvas id="mybarChart2"></canvas>

      </div>

      

    </div>

  </div>

</div>



  



@stop







@section('jsscripts')



  <script type="text/javascript">

    

    $(document).ready(function(){



      var route = "{{env('URL_JSON')}}periodosnombrecondo";

      var ultimosperiodos = [];

      var ultimosgastos = [];

      var ultimosdevengados = [];

      var periodos = [];

      var saldos = [];

     

      

      

      $.ajax({

            url: route,

            type: 'get',

            dataType: 'json',

            success: function (rta) {



              $.each(rta, function (key,value) {



                $.each(value, function (key2,array) {

                  

                  if (key2 =='periodos'){

                    $.each(array, function (key3,array2) {

                      

                      if (key3 == 0) {                  

                        $('#idPeriodo').append('<option value="'+ array2.id +'" selected>'+ array2.periodo +'</option>');



                      }else {

                        $('#idPeriodo').append('<option value="'+ array2.id +'">'+ array2.periodo +'</option>');

                      }



                    });

                    buscaDatos();



                  }else {      

                    switch (key2) {                       

                        @if (!Auth::check()) 

                          //Esta ingresando por metodo url

                        case 'nombre_condominio':

                          $("#nombre_condominio").empty();

                          $("#title").empty();

                          

                           $('#title').append('NETUS.COM.VE - ' + array);

                          

                          $('#nombre_condominio').append('<ul class="nav navbar-nav navbar-center"><div class ="nombredoncominio">'+ array + '</div></ul>');

                          $('#userreg').append('<li class=""><a href="{{URL::to('/') }}/logout"><i class="fa fa-sign-out"></i>Salir</a></li>');



                        @endif 

                          





                        case 'grafico1':

                          //console.log(array);

                          ultimosperiodos = array;

                          break;

                        case 'grafico2':

                          ultimosdevengados = array;

                          break;

                        case 'grafico3':

                          ultimosgastos = array;

                          break;

                        case 'grafico4':

                          ultimoscobros = array;

                          cargaGrafico(ultimosperiodos,ultimosdevengados,ultimosgastos,ultimoscobros);

                          break;

                        case 'grafico5':

                          peridos = array;

                          break;

                        case 'grafico6':

                          saldos = array;

                          cargaGraficoCob(peridos,saldos);

                          break;



                    }                    

                  }

                })

              })

            }

         });

    });



    $("#idPeriodo").change(function(){

        buscaDatos();

    });



    function cargaGrafico (labels,devengados,gastos,cobrados){

      var ctx = document.getElementById("mybarChart");

      var mybarChart = new Chart(ctx, {

        type: 'bar',

        data: {

          labels: labels,

          datasets: [{

            label: 'Ingresos Devengados',

            backgroundColor: "rgba(52, 152, 219, 0.7)",

            borderColor: "rgba(52, 152, 219, 1)",

            pointBorderColor: "rgba(52, 152, 219, 1)",

            pointBackgroundColor: "rgba(52, 152, 219, 1)",

            data: devengados

          }, {

            //245,118,118, rosado

            label: 'Gastos',

            backgroundColor: "rgba(239,44,44, 0.7)",

            borderColor: "rgba(239,44,44, 1)",

            pointBorderColor: "rgba(239,44,44, 1)",

            pointBackgroundColor: "rgba(239,44,44, 1)",

            data: gastos

          },{



            label: 'Ingresos Cobrados',

            backgroundColor: "rgba(138,187,111, 0.7)",

            borderColor: "rgba(138,187,111, 1)",

            pointBorderColor: "rgba(138,187,111, 1)",

            pointBackgroundColor: "rgba(138,187,111, 1)",

            data: cobrados

          }

          ]

        },



        options: {

          scales: {

            yAxes: [{

              ticks: {

                beginAtZero: true

              }

            }]

          }

        }

      });





    }



    function cargaGraficoCob (periodos,saldos){



      var ctx = document.getElementById("mybarChart2");

      var mybarChart2 = new Chart(ctx, {

        type: 'line',

        data: {

          labels: periodos,

          datasets: [{

            label: 'Cuentas por Cobrar',

            backgroundColor: "rgba(38, 185, 154, 0.31)",

            borderColor: "rgba(38, 185, 154, 0.7)",

            pointBorderColor: "rgba(38, 185, 154, 0.7)",

            pointBackgroundColor: "rgba(38, 185, 154, 0.7)",

            pointHoverBackgroundColor: "#fff",

            pointHoverBorderColor: "rgba(220,220,220,1)",





            pointBorderWidth: 1,

            data: saldos

          }

          ]

        },



        options: {

          scales: {

            yAxes: [{

              ticks: {

                beginAtZero: true

              }

            }]

          }

        }

      });





    }



    function buscaDatos(){



      var idPeriodo = $("#idPeriodo").val();

      var route = "{{ URL::to('/') }}/resumencondominio/"+idPeriodo;



      $.ajax({

            url: route,

            type: 'get',

            dataType: 'json',

            success: function (rta) {

              $("#resumen").empty();

              

              var count = (Object.keys(rta).length)-1;

              console.log(count);

              $.each(rta, function (key,value) {

                if (key == count){

                  "ingegre-positivo"

                  if (value.monto > 0 ){

                    var clase = "ingegre-positivo" ;

                  }else {

                    var clase = "ingegre-negativo" ;

                  }

                  $('#resumen').append('<tr><td style="font-weight:bold;">'+value.titulo+'</td><td class = "'+clase +'" >'+currency_cob(value.monto,2,[',', "'", '.'])+'</td></tr>');

                }else {

                  $('#resumen').append('<tr><td>'+value.titulo+'</td><td>'+currency_cob(value.monto,2,[',', "'", '.'])+'</td></tr>');

                }

                





                

              })



              

            }

         });







    }



  </script>

 

 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>



  



@stop 