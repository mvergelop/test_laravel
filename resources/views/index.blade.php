@extends('layouts.principal')

@section('menu')    
    @include('layouts.menu1')  
@stop

@section('usuario')    
    @include ('layouts.usuariotoolbar')
@stop


@section ('contenido')

	<div>
		<div class="col-md-7 col-sd-12 col-xs-12">
		
			<b>BIENVENIDO</b><br><br>

			netus.com.ve es la <u>solución en línea para el control financiero de su condominio.</u><br><br>

			Esta herramienta se convertirá en su asistente y le permitirá administrar condominios residenciales, comerciales o mixtos sin importar su tamaño.<br><br>


			<b>VENTAJAS</b><br><br>

			<ul>
				<i class="fa fa-check"></i> Acceso desde cualquier dispositivo en línea (pc, laptop, tablet, teléfono, etc).
			</ul>
			<ul>
				<i class="fa fa-check"></i> Económico, eficiente, potente y simple de usar.
			</ul>
			<ul>
				<i class="fa fa-check"></i> Ahorro de tiempo y dinero en procesos administrativos.
			</ul>
			<ul>
				<i class="fa fa-check"></i> Control sobre los procesos de administración del condominio.
			</ul>
			<ul>
				<i class="fa fa-check"></i> Acceso detallado de Ingresos y Egresos a inquilinos y/o copropietarios a través de la cartelera digital.
			</ul>
			<ul>
				<i class="fa fa-check"></i> Acceso detallado de Cuentas por Cobrar a inquilinos y/o copropietarios a través de la cartelera digital.

			</ul>
			<ul>
				<i class="fa fa-check"></i> Envío de correo electrónico a inquilinos y/o copropietarios de los siguientes reportes:
				<ul><i class="fa fa-minus"></i> Ingresos y Egresos (visualización de situación financiera del condominio)</ul>
				<ul><i class="fa fa-minus"></i> Cuentas por Cobrar (control de morosidad del condominio)</ul>
			</ul>
			<ul>
				<i class="fa fa-check"></i> Impresión de Reportes para respaldo físico de la información.
			</ul>
			Visite la cartelera digital de ejemplo y observe sus bondades <br><br>
			Registrarse y obtener una <b><a href="precios">licencia operativa</a></b> es muy fácil. 

				
		</div>
		<div class="col-md-5 col-sd-12 col-xs-12">
			<br>
			<img src="{{env('ROUTE_CSSJS') }}img/home.png" class="img-responsive center-block">
		</div>

	</div>
        

@stop


