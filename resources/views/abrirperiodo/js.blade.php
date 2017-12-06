

<script type="text/javascript">

	function cargarPeriodos(){

		$("#id_periodo").empty();

		var route ="{{env('URL_JSON')}}abrirperiodo/periodos";
		
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
	





	$('#btfinalizar').click(function(e) {

		var id_periodo = $("#id_periodo").val();
		var Ok = '1';
		if (!id_periodo > 0 ){
			msjPnotify('error','Advertencia','Debe <b>Seleccionar</b> un periodo'); 
			Ok = '0';
		}
		
		if (Ok == '1'){

			var periodo = getSelectText('id_periodo');
			$("#modal-title").empty();
			$("#modal-body").empty();
			//-------------------------
			$('#confirmBt').modal('show');
			$("#modal-body").append("Confirma Abrir el Periodo : <b>" + periodo+'</b>');
			$("#modal-title").append("Abrir Periodo");
		}
		
		
	});


	$('#confirmBt').find('.modal-footer #confirm').on('click', function(){
		var token = $("#token").val();
		var id_periodo = $("#id_periodo").val();
		var periodo = getSelectText('id_periodo');
		var route = "{{env('URL_JSON')}}abrirperiodo";
		$.ajax({
			url: route,
			headers: {'X-CSRF-TOKEN': token},
			type: 'POST',
			dataType: 'json',
			data : {id_periodo_cerrado : id_periodo,
					periodo    : periodo},
			success : function (){
				$('#confirmBt').modal('toggle'); 
				msjPnotify('success','Exito','El Periodo <b>'+ periodo +'</b>, se ha abierto con exito.');
				cargarPeriodos();
			}
		});
	});

</script>