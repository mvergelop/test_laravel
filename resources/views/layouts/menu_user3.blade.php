<div class="left_col scroll-view">
    <div class="navbar nav_title" style="border-style: solid;border-width: 3px; text-align: center;padding-top: 10px;">
        <a href="{{URL::to('/') }}" >
            <img class ="img-responsive" style="background-color: white;display:inherit; " src="{{env('ROUTE_CSSJS') }}img/logo.png">
        </a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
    </div>
    <!-- /menu profile quick info -->
    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <ul class="nav side-menu">
            <li>
                <a href="{{URL::to('/') }}/resumen">
                    <i class="fa fa-line-chart"></i>Resumen de Periodo</span>
                </a>
            </li> 
            <li>
                <a href="{{URL::to('/') }}/ingresosyegresos">
                    <i class="fa fa-arrows-v"></i>Rel. Ingresos y Egresos</span>
                </a>
            </li> 
            <li>
                <a href="{{URL::to('/') }}/cobranzas">
                    <i class="fa fa-calendar"></i>Cuentas por Cobrar</span>
                </a>
            </li> 
            <li>
                <a href="{{URL::to('/') }}/ingresosperiodo">
                    <i class="fa fa-arrows-v"></i>Ingresos del Periodo</span>
                </a>
            </li> 
            <li>
                <a href="{{URL::to('/') }}/log"><i class="fa fa-book"></i>Log de Auditoria</span></a>
            </li>

            
        </ul>  
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