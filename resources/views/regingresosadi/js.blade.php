<script type="text/javascript">
	$(document).ready(function(){
		$.fn.datepicker.defaults.format = "dd/mm/yyyy";
		$('#fecha_proceso').datepicker('setDate', new Date());
		buscaIngresosTemp();

	});

	$('#agregar').click(function (){

		var id_ingreso = $("#id_ingreso").val();
		var id_formapago = $("#id_formapago").val();
		var monto = $("#monto").val();
		var token = $("#token").val();
		var route = "{{env('URL_JSON')}}regingresos";
		var referencia = $("#referencia").val();

		var fecha =$("#fecha_proceso").val();
		fecha_proceso = getPhpDate(fecha);

		var Ok = '1';

		if (id_ingreso === null ){msjPnotify('error','Advertencia','El Concepto del <b>Ingreso</b> es Requerido'); Ok = '0';}
		if (monto === null || monto == 0){msjPnotify('error','Advertencia','El <b>Monto</b> es Requerido'); Ok = '0';}
		if (id_formapago === null ){msjPnotify('error','Advertencia','La <b>Forma de Cobro</b> es Requerida'); Ok = '0';}

		if (Ok == '1'){

			var Ajax = ajaxvalidafecha(fecha_proceso,token);

			Ajax.then (function (data){				
					if (data[0] == 'ABIERTO') {
						$.ajax({
							url: route,
							headers: {'X-CSRF-TOKEN': token},
							type: 'POST',
							dataType: 'json',
							data: {id_ingreso 	 : id_ingreso,
								   fecha_proceso : fecha_proceso,
								   monto         : monto,	
								   id_formapago  : id_formapago,
								   referencia    : referencia},
							success : function (rta){
								document.getElementById("id_ingreso").value = '';
								document.getElementById("id_formapago").value = '';
								document.getElementById("referencia").value = '';
					        	$('#fecha_proceso').datepicker('setDate', new Date());
								document.getElementById("monto").value = '';
								buscaIngresosTemp();
							}
						});
					}else {
						msjPnotify('error','Advertencia','La <b>Fecha de Cobro</b> se encuentra en un periodo cerrado, verifique');
					}





			});

		}

		
	});

	function ajustar(tam, num) {
		if (num.toString().length <= tam) {
			return ajustar(tam, "0" + num)
		}
		else {
			return num;
		}
	}


	$('#btfinalizar').click(function(e) {

		var Ajax = validadatostemp();
			Ajax.then (function (data){	

				if (data[0] == 'OK') {		
					$('#confirmBt').modal('show');
					$("#modal-body").append("Confirma Finalizar el Proceso de Ingresos");
					$("#modal-title").append("Finalizar Proceso");
					var tipovar = 'AA-2';
					$(this).find('.modal-footer #confirm').data('form', tipovar);
				}else {
					msjPnotify('error','Advertencia','Una o Varias <b>Fechas de Cobro</b> se encuentra en un periodo cerrado, verifique');
				}

			});
		
	});

	$('#confirmBt').on('show.bs.modal', function (e) {

		var tipo = $(e.relatedTarget).attr('data-tipo');
		if (tipo == '1') {
			console.log('aca 2');
			$(this).find('.modal-body p').text("Confirma Eliminar el Registro");
			$(this).find('.modal-title').text("Eliminar Registro");
			var id = $(e.relatedTarget).attr('data-value');
			$(this).find('.modal-footer #confirm').data('form', id);
		} else {

		}

	});


	$('#confirmBt').find('.modal-footer #confirm').on('click', function(){
		var token = $("#token").val();
		var tipovar = $(this).data('form');

		if (tipovar == '1') {

			var id_registro = $(this).data('form');
			var route = "{{env('URL_JSON')}}regingresos/"+id_registro;

			$.ajax({
				url: route,
				headers: {'X-CSRF-TOKEN': token},
				type: 'DELETE',
				dataType: 'json',
				success : function (){
					$('#confirmBt').modal('toggle'); 
					buscaIngresosTemp();
				}
			});


		}else {
			var route = "{{env('URL_JSON')}}procesaingresostemp";

			$.ajax({
				url: route,
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				dataType: 'json',
				data : {id : tipovar},
				success : function (){
					$('#confirmBt').modal('toggle'); 
					buscaIngresosTemp();
				}
			});


		}

		
		


	  
	});

	function validadatostemp() {

		var token = $("#token").val();

		return $.ajax({
				url: "{{env('URL_JSON')}}validadatostemp",
				headers: {'X-CSRF-TOKEN': token},
				type: 'GET',
				dataType: 'json',
				error : function (){
					alert ('error conexion');
				} 

				});		
	}


	function buscaIngresosTemp() {

		var route = "{{env('URL_JSON')}}ingresosadicionalestemp";
		var totalingresos = 0;
		
		$.ajax({
	        url: route,
	        type: 'get',
	        dataType: 'json',
	        success: function (rta) {
	        	$("#datostemp").empty();

				$.each(rta, function (key,value) {
					var fecha = new Date();
					fecha = value.fecha_doc;
					totalingresos = totalingresos + parseFloat(value.monto);

		        	$('#datostemp').append("<tr> <td>"+ value.des_ingreso+ "</td>" + 
		        						   		"<td>"+ currency(value.monto,2,[',', ",", '.'])+ "</td>" +
		        						   		"<td>" + fechamask(value.fecha_proceso)+"</td>" +
		        						   		"<td>" +
		        						   		"<button value="+value.id           +
		        						   		" 		  class='btn btn-danger' data-toggle='modal' " +
		        						   		"         data-target='#confirmBt'" +
		        						   		"         data-tipo  = '1'"         +
		        						   		"         data-value = '"+ value.id +"'>" +
	                                      	    "         Eliminar</button></td>" +
		        						   "</tr>" );
		        });
				$("#totalgastos").empty();
		        $("#totalgastos").append('Total Ingresos : ' + currency(totalingresos,2,[',', ",", '.']));
	        }
	     });

	}

</script>



