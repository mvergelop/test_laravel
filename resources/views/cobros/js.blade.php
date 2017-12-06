<script>

	$.fn.datepicker.defaults.format = "dd/mm/yyyy";

	$(document).ready(function() {

	    $('#fecha_doc').datepicker('setDate', new Date());

	    $('#fecha_doc').datepicker('update');

	});

</script>



<script type="text/javascript">



	$(document).ready(function(){

		buscaCuotasTemp();

	});


	$("input[type=radio][name=pronto_pago]").change(function () {
		
		if ($(this).val() == 'si'){			
			$('#monto_desc').removeAttr('disabled');
		}else {			
			$('#monto_desc').attr('disabled','disabled');
		}

	});



	$('#agregar').click(function (){

		var id_inmueble = $("#id_inmueble").val();

		var id_periodo = $("#periodo").val();

		var monto = parseFloat($("#monto").val());

		var monto_cuota = parseFloat($("#_monto_cuota").val());

		var forma_pago = $("#id_forma_pago").val();

		var referencia = $("#referencia").val();

		var extra = $('#_extra').val();

		var pronto_pago = $('input[name=pronto_pago]:checked').val()
		console.log('pronto pago ' + pronto_pago);

		var monto_desc = $('#monto_desc').val();

		if (monto_desc == '' || parseInt(monto_desc) < 0 || pronto_pago != 'si'){
			monto_desc = 0;
		}

		

		

		var token = $("#token").val();

		var route = "{{env('URL_JSON')}}cobrocuotas"



		var fecha =$("#fecha_doc").val();

		fecha_doc = getPhpDate(fecha);



		var Ok = '1';



		if (id_inmueble === null ){msjPnotify('error','Advertencia','El <b>Inmueble</b> es Requerido'); Ok = '0';}

		if (monto === null || monto == 0){msjPnotify('error','Advertencia','El <b>Monto</b> es Requerido'); Ok = '0';}

		if (monto > monto_cuota ) {msjPnotify('error','Advertencia','El <b>Monto</b> es mayor al de la cuota seleccionada'); Ok = '0';}



		if (forma_pago === null ){msjPnotify('error','Advertencia','La <b>Forma de Cobro</b> es Requerida'); Ok = '0';}

		if (pronto_pago == 'si'){ if (monto_desc <= 0) { msjPnotify('error','Advertencia','El <b>Monto Descuento</b> es Requerido'); Ok = '0';}}

		var total = parseFloat(monto) + parseFloat(monto_desc);
		
		console.log(total +' - ' + monto_cuota);

		if (total < monto_cuota){msjPnotify('error','Advertencia','La suma del monto cobrado y monto de descuento por pronto pago debe ser igual al monto total de la cuota.'); Ok = '0';}

		if (total > monto_cuota){msjPnotify('error','Advertencia','La suma del monto cobrado y monto de descuento por pronto pago debe ser igual al monto total de la cuota.'); Ok = '0';}

		if (Ok == '1') {

			var Ajax = ajaxvalidafecha(fecha_doc,token);



			Ajax.then (function (data){

					if (data[0] == 'ABIERTO') {



						$.ajax({

								url: route,

								headers: {'X-CSRF-TOKEN': token},

								type: 'POST',

								dataType: 'json',

								data: {id_inmueble : id_inmueble,

									   id_periodo  : id_periodo,

									   monto       : monto	,

									   forma_pago : forma_pago,

									   fecha_doc :  fecha_doc,

									   referencia : referencia,

									   extra : extra,
									   pronto_pago :pronto_pago,
									   monto_desc :monto_desc} ,

								success : function (rta){

										document.getElementById("id_inmueble").value = '';

										$("#periodo").empty();

										document.getElementById("monto").value = '';

										document.getElementById("id_forma_pago").value = '';								

										document.getElementById("referencia").value = '';	
										$('#monto_desc').val('')							

										$('#fecha_doc').datepicker('setDate', new Date());
	                					$('#monto_desc').attr('disabled','disabled');
	                					$('input[name=pronto_pago]:checked').val('no');
										buscaCuotasTemp();

									}

						})

					}else {

						msjPnotify('error','Advertencia','La <b>Fecha de Cobro</b> se encuentra en un periodo cerrado, verifique');

					}

			});



		}



		

		

		





		

		

	});







	$('#confirmBt').on('show.bs.modal', function (e) {



		var tipo = $(e.relatedTarget).attr('data-tipo');



		if (tipo == '1') {



			$(this).find('.modal-body p').text("Confirma Eliminar el Registro");

			$(this).find('.modal-title').text("Eliminar Registro");

			var id = $(e.relatedTarget).attr('data-value');

			$(this).find('.modal-footer #confirm').data('form', id);

		} else {

			$(this).find('.modal-body p').text("Confirma Finalizar el Proceso de Cobro");

			$(this).find('.modal-title').text("Finalizar Proceso");

			var tipovar = 'AA-2';

			$(this).find('.modal-footer #confirm').data('form', tipovar);

		}



	});





	$('#confirmBt').find('.modal-footer #confirm').on('click', function(){

		

		var token = $("#token").val();

		var tipovar = $(this).data('form');



		if (tipovar == 'AA-2') {



			var route = "{{env('URL_JSON')}}procesatuotastemp";



			$.ajax({

				url: route,

				headers: {'X-CSRF-TOKEN': token},

				type: 'POST',

				dataType: 'json',

				data : {id : tipovar},

				success : function (){

					$('#confirmBt').modal('toggle'); 

					buscaCuotasTemp();

				}

			});





		}else {

			var id_registro = $(this).data('form');

			var route = "{{env('URL_JSON')}}cobrocuotas/"+id_registro;



			$.ajax({

				url: route,

				headers: {'X-CSRF-TOKEN': token},

				type: 'DELETE',

				dataType: 'json',

				success : function (){

					$('#confirmBt').modal('toggle'); 

					buscaCuotasTemp();

				}

			});



		}



		

		





	  

	});





	function buscaCuotasTemp() {



		var route = "{{env('URL_JSON')}}cuotastemp";

		$.ajax({

	        url: route,

	        type: 'get',

	        dataType: 'json',

	        success: function (rta) {

	        	$("#datostemp").empty();

				$.each(rta, function (key,value) {

		        	$('#datostemp').append("<tr> <td>"+ value.eti_inmueble+ "</td>" + 

		        						        "<td>"+ value.periodo+ 	    "</td>" +

		        						   		"<td>"+ currency_cob(value.monto,2,[',', "'", '.'])+        "</td>" +
		        						   		"<td>"+ currency_cob(value.monto_desc,2,[',', "'", '.'])+        "</td>" +

		        						   		"<td>"+ value.forma_cobro+        "</td>" +

		        						   		"<td>"+ fechamask(value.fecha_doc)+        "</td>" +

		        						   		"<td>" +

		        						   		"<button value="+value.id           +

		        						   		" 		  class='btn btn-danger' data-toggle='modal' " +

		        						   		"         data-target='#confirmBt'" +

		        						   		"         data-tipo  = '1'"         +

		        						   		"         data-value = '"+ value.id +"'>" +

	                                      	    "         Eliminar</button></td>" +

		        						   "</tr>" );

		        });

	        }

	     });



	}













	$('#id_inmueble').change(function() {

		var id_inmueble = $("#id_inmueble").val();

		var route = "{{env('URL_JSON')}}periodosinmueble/"+id_inmueble;

		var cant = 0;

		//alert (route);



		$.ajax({

	            url: route,

	            type: 'get',

	            dataType: 'json',

	            success: function (rta) {

	            	$("#periodo").empty();

	            	

	                $.each(rta, function (key,value) {

	                	cant = cant + 1;

	                	if (key == 0){

	                		document.getElementById("monto").value = value.monto;

	                		document.getElementById("_monto_cuota").value = value.monto;

	                		document.getElementById('_extra').value = value.extra;



	                	}

	                	$('#periodo').append("<option value='" + value.id_periodo + "'>" + value.eti_periodo + "</option>");

	                });

	                $('#monto_desc').attr('disabled','disabled');
	                if (cant == 0) {
	                	$('#periodo').append("<option value='0'>Anticipo</option>");	                	
	                	$('#pronto_pago_1').attr('disabled','disabled');
	                	$('#pronto_pago_2').attr('disabled','disabled');

	                }else {
	                	$('#pronto_pago_1').removeAttr('disabled');
	                	$('#pronto_pago_2').removeAttr('disabled');
	                }


	            }

	        });



		

		



	});

	$('#periodo').change(function() {



		var id_inmueble = $("#id_inmueble").val();

		var id_periodo = $("#periodo").val();

		var extra = getSelectText('periodo')

		var extra = extra.substring(0,5);

		if (extra =='Extra'){

			extra = '1';

		}else {

			extra = '0';

		}



		//extra = $("#_extra").val();





		//str.substring(1, 4)

		var route = "{{env('URL_JSON')}}montocuota/"+id_inmueble+'/'+id_periodo+'/'+extra;



		console.log(route);



		$.ajax({

	            url: route,

	            type: 'get',

	            dataType: 'json',

	            success: function (rta) {



	            	document.getElementById("monto").value = rta.monto;

	                document.getElementById("_monto_cuota").value = rta.monto;	                 

	                document.getElementById('_extra').value = rta.extra;

	                console.log(rta);



	               

	                

	            }

	        });



	});



	





</script>