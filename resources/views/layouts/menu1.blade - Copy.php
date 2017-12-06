<div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>netus</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
          @if (Auth::check())
            @if (Auth::user()-> tipo == '1')
              <li><a><i class="fa fa-users"></i> Usuarios <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="{{URL::to('/') }}/usuarios">Listado</a></li>
                  <li><a href="{{URL::to('/') }}/usuarios/create">Registrar</a></li>
                </ul>
              </li>
            @endif 
          @endif 
          @if (Auth::check())
            <li><a><i class="fa fa-building"></i>Condominio<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
              
                 @if ((Auth::user()-> tipo ) == '1')
                    <li><a href="{{URL::to('/') }}/condominio/create">Registrar</a></li>
                    <li><a href="{{URL::to('/') }}/inmuebles">Listado de Inmuebles</a></li>
                    <li><a href="{{URL::to('/') }}/inmuebles/create">Registrar Inmuebles</a></li>
                  @elseif (((Auth::user()-> tipo ) == '2') and isset(Auth::user()-> id_condomino) )
                    <li><a href="{{URL::to('/') }}/condominio/create">Registrar</a></li>
                  @elseif (((Auth::user()-> tipo ) == '2') and !isset(Auth::user()-> id_condomino) )
                    <li><a href="{{URL::to('/') }}/condominio/edit">Actualizar Datos</a></li>
                    <li><a href="{{URL::to('/') }}/inmuebles">Listado de Inmuebles</a></li>
                    <li><a href="{{URL::to('/') }}/inmuebles/create">Registrar Inmuebles</a></li>

                 @endif
                </ul>
              </li>

              

              @if (Auth::user()-> tipo == '1' or Auth::user()-> tipo == '2')
                <li><a><i class="fa fa-book"></i>Gastos<span class="fa fa-chevron-down"></span></a>

                  <ul class="nav child_menu">
                  @if (Auth::user()-> tipo == '1')    
                      <li><a>Tipo de Gastos<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li class="sub_menu" ><a href="{{URL::to('/') }}/tipogastos">Listado</a>
                          </li>
                          <li><a href="{{URL::to('/') }}/tipogastos/create">Registrar</a>
                          </li>
                        </ul>
                      </li>
                  @endif
                    <li><a href="{{URL::to('/') }}/gastos">Listado</a></li>
                    <li><a href="{{URL::to('/') }}/gastos/create">Registrar</a></li>
                  </ul>
                </li>

                 <li><a><i class="fa fa-plus"></i>Ingresos Adicionales<span class="fa fa-chevron-down"></span></a>

                  <ul class="nav child_menu">
                    <li><a href="{{URL::to('/') }}/ingresosadicionales">Listado</a></li>
                    <li><a href="{{URL::to('/') }}/ingresosadicionales/create">Registrar</a></li>
                    <li><a href="{{URL::to('/') }}/regingresos">Procesa Ingresos</a></li>
                  </ul>
                </li>

              @endif 

              @if (Auth::user()-> tipo == '2')
                  <li><a><i class="fa fa-gear"></i>Procesos<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{URL::to('/') }}/reggastos">Registro de Gastos</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-bank"></i>Formas de Pago<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{URL::to('/') }}/formaspago">Listado</a></li>
                      <li><a href="{{URL::to('/') }}/formaspago/create">Registrar</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-circle-o-notch"></i>Cuotas de Condominio<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{URL::to('/') }}/generacuotas">Generar Cuotas Ordinarias</a></li>
                      <li><a href="{{URL::to('/') }}/cuotasordinarias">Ver cuotas generadas</a></li>
                      <li><a href="{{URL::to('/') }}/cobrocuotas">Cobro de Cuotas</a></li>
                    </ul>
                  </li>

                  

                  <li><a href="{{URL::to('/') }}/cerrarperiodo"><i class="fa fa-calendar"></i>Cerrar Periodo<span class="fa fa-chevron-down"></span></a>
                  </li>
              @endif 
          @endif

          
          
          
          
      </div>
      <div class="menu_section">
      </div>

    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
    </div>
    <!-- /menu footer buttons -->
</div>