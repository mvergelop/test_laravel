



<script type="text/javascript">

	function cargarPeriodos(){

		$("#id_periodo").empty();

		var route ="{{env('URL_JSON')}}periodosxcerrar";
		
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
	

	function okCerrarPieriodo (periodo){

		var token = $("#token").val();

		return $.ajax({
				url: "{{env('URL_JSON')}}haydatatemp/"+periodo,
				headers: {'X-CSRF-TOKEN': token},
				type: 'GET',
				dataType: 'json',
				error : function (){
					msjPnotify('error','Advertencia','Error de <b>Conexión</b>, intente de nuevo');
				} 

				});		


	}




	$('#btfinalizar').click(function(e) {

		var id_periodo = $("#id_periodo").val();
		var Ok = '1';
		if (!id_periodo > 0 ){
			msjPnotify('error','Advertencia','Debe <b>Seleccionar</b> un periodo'); 
			Ok = '0';
		}
		
		if (Ok == '1'){
			
			var Ajax = okCerrarPieriodo(id_periodo);
			Ajax.then (function (data){	

				if (data[0] == 'OK') {		
					var periodo = getSelectText('id_periodo');
					$("#modal-title").empty();
					$("#modal-body").empty();
					//-------------------------
					$('#confirmBt').modal('show');
					$("#modal-body").append("Confirma Cerrar el Periodo : " + periodo);
					$("#modal-title").append("Cerrar Periodo");
				}else {
					msjPnotify('error','Advertencia','Existen registros(<b>Gastos,Cobro de Cuotas, Ingresos Adicionales</b>) sin procesar verifique');
				}

			});

		}
		
		
	});


	$('#confirmBt').find('.modal-footer #confirm').on('click', function(){
		var token = $("#token").val();
		var id_periodo = $("#id_periodo").val();
		var periodo = getSelectText('id_periodo');
		var route = "{{env('URL_JSON')}}cierraperiodo";
		$.ajax({
			url: route,
			headers: {'X-CSRF-TOKEN': token},
			type: 'POST',
			dataType: 'json',
			data : {id_periodo : id_periodo},
			success : function (){
				$('#confirmBt').modal('toggle'); 
				msjPnotify('success','Exito','El Periodo <b>'+ periodo +'</b>, se ha cerrado con exito.');
				cargarPeriodos();
			}
		});
	});

</script>