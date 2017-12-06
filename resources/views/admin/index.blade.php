@extends ('layouts.admin')

@section ('contenido')
    <div class="content">   
    	<form id="regusuario" method="post" novalidate>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for ="login">Login</label>
                        <input type="text" id = "login" name = "login" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" id="password" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Repita Contraseña</label>
                        <input type="password" id="password2" class="form-control">
                    </div>
                </div>
               <div> 
                    <br>
               </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" id="nombre" class="form-control" placeholder="Jose Perez">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="text" id="correo" class="form-control" placeholder="joseperez@mail.com">
                    </div>
                </div>
            </div>

          

            <button type="submit" class="btn btn-info btn-fill pull-right">Enviar</button>
            <div class="clearfix"></div>
        </form>
    </div>

	

@stop