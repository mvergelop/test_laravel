$(document).ready(function(){
	buscaCuotasTemp();
});

$('#agregar').click(function (){
	var id_inmueble = $("#id_inmueble").val();
	var id_periodo = $("#periodo").val();
	var monto = $("#monto").val();
	var forma_pago = $("#id_forma_pago").val();
	
	var token = $("#token").val();
	var route = window.location.protocol + "//" + window.location.host + "/" +"cobrocuotas"

	var fecha =$("#fecha_doc").val();
	fecha_doc = getPhpDate(fecha);

	

	$.ajax({
		url: route,
		headers: {'X-CSRF-TOKEN': token},
		type: 'POST',
		dataType: 'json',
		data: {id_inmueble : id_inmueble,
			   id_periodo  : id_periodo,
			   monto       : monto	,
			   forma_pago : forma_pago,
			   fecha_doc :  fecha_doc},
		success : function (rta){
			document.getElementById("id_inmueble").value = '';
			$("#periodo").empty();
			document.getElementById("monto").value = '';
			document.getElementById("id_forma_pago").value = '';
			$('#fecha_doc').datepicker('setDate', new Date());
			buscaCuotasTemp();
		}
	})
	
	

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

		var route = window.location.protocol + "//" + window.location.host + "/" +"procesatuotastemp";

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
		var route = window.location.protocol + "//" + window.location.host + "/" +"cobrocuotas/"+id_registro;

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

	var route = window.location.protocol + "//" + window.location.host + "/" +"cuotastemp";
	$.ajax({
        url: route,
        type: 'get',
        dataType: 'json',
        success: function (rta) {
        	$("#datostemp").empty();
			$.each(rta, function (key,value) {
	        	$('#datostemp').append("<tr> <td>"+ value.eti_inmueble+ "</td>" + 
	        						        "<td>"+ value.periodo+ 	    "</td>" +
	        						   		"<td>"+ value.monto+        "</td>" +
	        						   		"<td>"+ value.forma_cobro+        "</td>" +
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
	var route = window.location.protocol + "//" + window.location.host + "/" +"periodosinmueble/"+id_inmueble;
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
                	}
                	$('#periodo').append("<option value='" + value.id_periodo + "'>" + value.eti_periodo + "</option>");
                });
                if (cant == 0) {
                	$('#periodo').append("<option value='0'>Anticipo</option>");
                }
            }
        });

	
	

});