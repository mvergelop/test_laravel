<script type="text/javascript">

    function getnombrecondominio() {

            $.ajax({
                url: "{{env('URL_JSON')}}getnombrecondominio",
                type: 'get',
                dataType: 'json',
                success: function (rta) {
                    $("#nombre_condominio").empty();
                    $("#title").empty();
                    
                     $('#title').append('NETUS.COM.VE - ' + rta);
                    
                    $('#nombre_condominio').append('<ul class="nav navbar-nav navbar-center"><div class ="nombredoncominio">'+ rta + '</div></ul>');
                    $('#userreg').append('<li class=""><a href="{{URL::to('/') }}/logout"><i class="fa fa-sign-out"></i>Salir</a></li>');
                }



            });
    }

</script>