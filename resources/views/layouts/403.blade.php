<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>netus.com.ve - Acceso denegado</title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">    
    <!-- NProgress -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" rel="stylesheet">

  

    <!-- Custom Theme Style -->
    <link href="{{env('ROUTE_CSSJS') }}build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- page content -->
        <div class="col-md-12">
          <div class="col-middle">
            <div class="text-center text-center">
              <h1 class="error-number">403</h1>
              <h2>Acceso denegado</h2>
              <p>Para ingresar a este recurso se debe identificar correctamente
              </p>
              <div class="mid_center">
                <a href="{{URL::to('/') }}"><img style="background-color: white;"  src="{{env('ROUTE_CSSJS') }}img/logo.png""></a>
                
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- NProgress -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>



    <!-- Custom Theme Scripts -->
    <script src="{{env('ROUTE_CSSJS') }}build/js/custom.min.js"></script>
  </body>
</html>