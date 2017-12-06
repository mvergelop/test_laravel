<script type="text/javascript">
	

	function llenaUrl(){

        var nombre = document.getElementById('nombre').value;
        nombre = nombre.toLowerCase();
        var url = '';

        for (var i = 0; i< nombre.length; i++) {
            var caracter = nombre.charAt(i);

            if (caracter.charCodeAt(0) >= 97 && caracter.charCodeAt(0) <=122) {
              url = url + caracter;
            }else if (caracter.charCodeAt(0) == 241){
              url = url + 'n';
            }else if (caracter.charCodeAt(0) >= 48 && caracter.charCodeAt(0) <=57){
              url = url + caracter;
            }
        }
        
        document.getElementById('url').value = url;
    

    }

    $(document).ready(function(){

     //$("#rb_monto_fijo").prop("checked", true);

	    var radios = $('input:radio[name=tipo_cuota]');
	      if(radios.is(':checked') === false) {
	        @if (isset ($condominio->tipo_cuota_defecto))
	          radios.filter('[value={{ $condominio->tipo_cuota_defecto }}]').prop('checked', true);
	        @else
	          radios.filter('[value=1]').prop('checked', true);
	        @endif 
	      }
	      $('body').on('click','#remove',function(){
	          $(this).parent('div').remove();
	      });
  	});



     $("#actualizar").click(function(){
        var id = $("#id").val();
        var nombre = $("#nombre").val();
        var direccion = $("#direccion").val();
        var administrador = $("#administrador").val();
        var tipo = $("#tipo").val();
        var cant_inmuebles = $("#cant_inmuebles").val();
        var niveles = $("#niveles").val();
        var cant_niveles = $("#cant_niveles").val();
        var url = $("#url").val();
        var tipo_cuota = $('input[name="tipo_cuota"]:checked').val();

        
        var route = "{{URL::to('/') }}/condominio/"+id+"";
        var token = $("#token").val();

        $.ajax({
          url: route,
          headers: {'X-CSRF-TOKEN': token},
          type: 'PUT',
          dataType: 'json',
          data: {id: id,
                 nombre : nombre,
                 direccion : direccion,
                 administrador : administrador,
                 tipo          : tipo,
                 cant_inmuebles : cant_inmuebles,
                 niveles : niveles,
                 cant_niveles : cant_niveles,
                 url : url,
                 tipo_cuota : tipo_cuota},
          success: function(){
            new PNotify({
                title: '<b>Actualizado</b>',
                text: 'Datos del condominio fueron actualizados correctamente',
                type: 'success'
            });
          }
        });
    });




</script>