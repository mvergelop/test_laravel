<div class="left_col scroll-view">
    <div class="navbar nav_title" style="border-style: solid;border-width: 3px; text-align: center;padding-top: 10px;">
        <a href="{{URL::to('/') }}" >
            <img class ="img-responsive" style="background-color: white;display:inherit;" src="{{env('ROUTE_CSSJS') }}img/logo.png">
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
                <a>
                    <i class="fa fa-users"></i> Usuarios <span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li><a href="{{URL::to('/') }}/usuarios/create"><i class="fa fa-plus-circle"></i>Crear</a></li>
                    <li><a href="{{URL::to('/') }}/usuarios"><i class="fa fa-list"></i>Mostrar Todos</a></li>
                </ul>
            </li>       
            <li>
                <a>
                    <i class="fa fa-book"></i>Tipo de Gastos<span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li><a href="{{URL::to('/') }}/tipogastos/create"><i class="fa fa-plus-circle"></i>Crear</a></li>
                    <li><a href="{{URL::to('/') }}/tipogastos"><i class="fa fa-list"></i>Mostrar Todos</a></li>
                </ul>
            </li>
            <li>
                <a>
                    <i class="fa fa-book"></i>Gastos<span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li><a href="{{URL::to('/') }}/gastos/create"><i class="fa fa-plus-circle"></i>Crear</a></li>
                    <li><a href="{{URL::to('/') }}/gastos"><i class="fa fa-list"></i>Mostrar Todos</a></li>
                </ul>
            </li>     
            <li>
                <a>
                    <i class="fa fa-question"></i>Preguntas Frecuentes<span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li><a href="{{URL::to('/') }}/faq/create"><i class="fa fa-plus-circle"></i>Crear</a></li>
                    <li><a href="{{URL::to('/') }}/faq"><i class="fa fa-list"></i>Mostrar Todos</a></li>
                </ul>
            </li>         
            <li>
                <a href="{{URL::to('/') }}/configuracion"><i class="fa fa-gear"></i>Configuraciones</span></a>
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