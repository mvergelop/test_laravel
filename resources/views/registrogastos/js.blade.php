<script type="text/javascript">
	$(document).ready(function(){
		
		buscaGastosTemp();
	});

	$('#agregar').click(function (){

		var id_gasto = $("#id_gasto").val();
		var documento = $("#documento").val();
		var monto = $("#monto").val();
		var id_proveedor = $("#id_provedor").val();
		var des_proveedor = $("#des_proveedor").val();	
		var id_formapago = $("#id_formapago").val();
		

		var token = $("#token").val();
		var route = "{{env('URL_JSON')}}reggastos";

		var fecha =$("#fecha_doc").val();	
		fecha_doc = getPhpDate(fecha);

		var fecha =$("#fecha_proceso").val();
		fecha_proceso = getPhpDate(fecha);
		
		var Ok = '1';
		
		if (id_gasto === null ){msjPnotify('error','Advertencia','El Concepto de <b>Gasto</b> es Requerido'); Ok = '0';}
		if (documento == null){msjPnotify('error','Advertencia','El <b>Documento</b> es Requerido'); Ok = '0';}
		if (monto === null || monto == 0){msjPnotify('error','Advertencia','El <b>Monto</b> es Requerido'); Ok = '0';}
		if (id_proveedor === null ){msjPnotify('error','Advertencia','El <b>RIF / C.I</b> es Requerido'); Ok = '0';}
		if (des_proveedor === null ){msjPnotify('error','Advertencia','La <b>Razon Social</b> es Requerida'); Ok = '0';}		
		if (id_formapago === null ){msjPnotify('error','Advertencia','La <b>Forma de Cobro</b> es Requerida'); Ok = '0';}

		console.log(id_formapago);


		if (Ok == '1'){
			var Ajax = ajaxvalidafecha(fecha_proceso,token);
			Ajax.then (function (data){		

				if (data[0] == 'ABIERTO') {

					$.ajax({
						url: route,
						headers: {'X-CSRF-TOKEN': token},
						type: 'POST',
						dataType: 'json',
						data: {id_gasto 	: id_gasto,
							   documento    : documento,
							   fecha_doc       : fecha_doc,
							   monto        : monto,
							   id_proveedor : id_proveedor,
							   des_proveedor : des_proveedor,
							   'fecha_proceso' : fecha_proceso,
							   id_formapago : id_formapago	 },
						success : function (rta){
							document.getElementById("id_gasto").value = '';
							document.getElementById("documento").value = '';
							document.getElementById("id_formapago").value = '';
							$('#fecha_doc').datepicker('setDate', new Date());
				        	$('#fecha_proceso').datepicker('setDate', new Date());
							document.getElementById("id_provedor").value = '';
							document.getElementById("des_proveedor").value = '';
							document.getElementById("monto").value = '';
							buscaGastosTemp();
						}
					})
				}else {
					msjPnotify('error','Advertencia','La <b>Fecha de Proceso</b> se encuentra en un periodo cerrado, verifique');
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



	$('#confirmBt').on('show.bs.modal', function (e) {

		var tipo = $(e.relatedTarget).attr('data-tipo');

		

		if (tipo == '1') {

			$(this).find('.modal-body p').text("Confirma Eliminar el Registro");
			$(this).find('.modal-title').text("Eliminar Registro");
			var id = $(e.relatedTarget).attr('data-value');
			$(this).find('.modal-footer #confirm').data('form', id);
		} else {
			$(this).find('.modal-body p').text("Confirma Finalizar el Proceso de Registro de Gastos");
			$(this).find('.modal-title').text("Finalizar Proceso");
			var tipovar = 'AA-2';
			$(this).find('.modal-footer #confirm').data('form', tipovar);
		}

	});


	$('#confirmBt').find('.modal-footer #confirm').on('click', function(){
		
		var token = $("#token").val();
		var tipovar = $(this).data('form');

		

		if (tipovar == 'AA-2') {

			var route = "{{env('URL_JSON')}}procesagastostemp";

			$.ajax({
				url: route,
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				dataType: 'json',
				data : {id : tipovar},
				success : function (){
					$('#confirmBt').modal('toggle'); 
					buscaGastosTemp();
				}
			});


		}else {
			var id_registro = $(this).data('form');
			var route = "{{env('URL_JSON')}}reggastos/"+id_registro;

			$.ajax({
				url: route,
				headers: {'X-CSRF-TOKEN': token},
				type: 'DELETE',
				dataType: 'json',
				success : function (){
					$('#confirmBt').modal('toggle'); 
					buscaGastosTemp();
				}
			});

		}

		
		


	  
	});


	function buscaGastosTemp() {

		var route = "{{env('URL_JSON')}}gastostemp";
		var totalgastos = 0;
		
		$.ajax({
	        url: route,
	        type: 'get',
	        dataType: 'json',
	        success: function (rta) {
	        	$("#datostemp").empty();

				$.each(rta, function (key,value) {
					var fecha = new Date();
					fecha = value.fecha_doc;
					totalgastos = totalgastos + parseFloat(value.monto);

		        	$('#datostemp').append("<tr> <td>"+ value.des_gasto+ "</td>" + 
		        						   		"<td>"+ value.documento+ " / " + fechamask(fecha)   +       "</td>" +
		        						   		"<td>" + value.des_proveedor+ " / "+ value.id_proveedor+"</td>" +
		        						   		"<td>" + currency_cob(value.monto,2,[',', "'", '.'])+"</td>" +
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
		        $("#totalgastos").append('Total Gastos : ' + currency_cob(totalgastos,2,[',', "'", '.']));
	        }
	     });

	}

</script>



