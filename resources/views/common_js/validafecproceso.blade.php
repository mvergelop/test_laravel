<script type="text/javascript">
	
	function ajaxvalidafecha(fecha,token) {

		return $.ajax({
				url: "{{env('URL_JSON')}}validafecha",
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				dataType: 'json',
				data: {fecha :  fecha},
				error : function (){
					alert ('error conexion');
				} 

				});		
	}

</script>