





function cargarPeriodos(){

	$("#id_periodo").empty();

	var route = window.location.protocol + "//" + window.location.host + "/" + 'periodosxcerrar';
	
	$.ajax({
        url: route,
        type: 'get',
        dataType: 'json',
        success: function (rta) {
        	$('#id_periodo').append(" <option value='' disabled selected style='display:none;'>Periodo</option>");
        	
        	$.each(rta, function (key,value) {
        		$('#id_periodo').append(" <option value='"+ value.id +"'>"+ value.periodo+"</option>')");
        	});
        	
        }
    })

}


	


$('#confirmBt').on('show.bs.modal', function (e) {

	var periodo = ' xx';	
	var id_periodo = $("#id_periodo").val();

	

	$(this).find('.modal-body p').text("Confirma Cerrar el Periodo :");
	$(this).find('.modal-title').text("Cerrar Periodo");
	
	$(this).find('.modal-footer #confirm').data('form', id_periodo);

});


$('#confirmBt').find('.modal-footer #confirm').on('click', function(){

	
	
	var token = $("#token").val();
	var id_periodo = $(this).data('form');

	var route = window.location.protocol + "//" + window.location.host + "/" +"cierraperiodo";
	

	$.ajax({
		url: route,
		headers: {'X-CSRF-TOKEN': token},
		type: 'POST',
		dataType: 'json',
		data : {id_periodo : id_periodo},
		success : function (){
			$('#confirmBt').modal('toggle'); 
			cargarPeriodos();
		}
	});

	
	


  
});