<div class="left_col scroll-view">
            <div class="navbar nav_title" style="border-style: solid;border-width: 3px; text-align: center;padding-top: 10px;">
                <a href="{{URL::to('/') }}" >
                    <img class ="img-responsive" style="background-color: white;display:inherit " src="{{env('ROUTE_CSSJS') }}img/logo.png">
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
                        @if (!isset(Auth::user()->id_condominio))
                            <a href="{{URL::to('/') }}/condominio/create"><i class="fa fa-building"></i>Registrar Condominio</span></a>
                        @else 
                            <a href="{{URL::to('/') }}/condominio/edit"><i class="fa fa-building"></i>Datos Condominio</span></a>
                        @endif
                    </li>
                    <li>
                        <a>
                            <i class="fa fa-home"></i>Inmuebles<span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            <li><a href="{{URL::to('/') }}/inmuebles/create"><i class="fa fa-plus-circle"></i>Crear</a></li>
                            <li><a href="{{URL::to('/') }}/inmuebles"><i class="fa fa-list"></i>Mostrar Todos</a></li>
                        </ul>
                    </li> 
                    <li>
                        <a>
                            <i class="fa fa-plus"></i>Ingresos Adicionales<span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            <li><a href="{{URL::to('/') }}/ingresosadicionales/create"><i class="fa fa-plus-circle"></i>Crear</a></li>
                            <li><a href="{{URL::to('/') }}/ingresosadicionales"><i class="fa fa-list"></i>Mostrar Todos</a></li>
                        </ul>
                    </li>
                    <li>
                        <a style="font-size: 11.5px;">
                            <i class="fa fa-bank"></i>Medios de Pago y Cobranzas<span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            <li><a href="{{URL::to('/') }}/formaspago/create"><i class="fa fa-plus-circle"></i>Crear</a></li>
                            <li><a href="{{URL::to('/') }}/formaspago"><i class="fa fa-list"></i>Mostrar Todos</a></li>
                        </ul>
                    </li>   
                    <!--<li>
                        <a href="{{URL::to('/') }}/gastos">
                            <i class="fa fa-book"></i>Gastos
                        </a>
                    </li>  !-->

                    <li>
                        <a>
                            <i class="fa fa-sign-out"></i>Cuotas de Condominio<span class="fa fa-chevron-down"></span>                    
                        </a>
                        <ul class="nav child_menu">
                            <li><a href="{{URL::to('/') }}/generacuotas"><i class="fa fa-plus-circle"></i>Generar Cuota Ordinaria</a></li>
                            <li><a href="{{URL::to('/') }}/generacuotasextra"><i class="fa fa-plus-circle"></i>Generar Cuota Extra</a></li>
                            <li><a href="{{URL::to('/') }}/regingresos"><i class="fa fa-plus-square"></i>Generar Ingresos Adicionales</a></li>
                            <li><a href="{{URL::to('/') }}/cuotasgeneradas"><i class="fa fa-search"></i>Consultar Cuotas</a></li>
                        </ul>
                    </li>                    
                    
                    <li>
                        <a>
                            <i class="fa fa-gear"></i>Procesos<span class="fa fa-chevron-down"></span>                    
                        </a>
                        <ul class="nav child_menu">                            
                            <li><a href="{{URL::to('/') }}/cobrocuotas"><i class="fa fa-file-text-o"></i>Cobro de Cuota</a></li>
                            <li><a href="{{URL::to('/') }}/reggastos"><i class="fa fa-plus-circle"></i>Registro de Gastos</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{URL::to('/') }}/cerrarperiodo"><i class="fa fa-calendar"></i>Cerrar Periodo</span></a>
                    </li>
                    <li>
                        <a>
                            <i class="fa fa-file-excel-o"></i>Reportes<span class="fa fa-chevron-down"></span>                    
                        </a>
                        <ul class="nav child_menu">
                            <li><a href="{{URL::to('/') }}/resumen"><i class="fa fa-check-circle-o"></i>Resumen Condominio</a></li>
                            <li><a href="{{URL::to('/') }}/cobranzas"><i class="fa fa-check-circle-o"></i>Cuentas por Cobrar</a></li>
                            <li><a href="{{URL::to('/') }}/ingresosyegresos"><i class="fa fa-check-circle-o"></i>Ingresos y Egresos</a></li>
                        </ul>
                    </li>
                    <li>
                        <a>
                            <i class="fa fa-asterisk"></i>Modificaciones<span class="fa fa-chevron-down"></span>                    
                        </a>
                        <ul class="nav child_menu">
                            <li><a href="{{URL::to('/') }}/abrirperiodo"><i class="fa fa-check-circle-o"></i>Abrir Periodo</a></li>
                            <li><a href="{{URL::to('/') }}/modificarcuotas"><i class="fa fa-check-circle-o"></i>Modificar Cuota</a></li>
                            <li><a href="{{URL::to('/') }}/anulargastos"><i class="fa fa-check-circle-o"></i>Anular Gasto</a></li>
                            <li><a href="{{URL::to('/') }}/anularcobros"><i class="fa fa-check-circle-o"></i>Anular Cobro</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{URL::to('/') }}/log"><i class="fa fa-gavel"></i>Log de Auditoria</span></a>
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