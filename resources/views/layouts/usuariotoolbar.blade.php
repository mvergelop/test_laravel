
<div class="nav_menu">
<nav>
  <div class="nav toggle">
    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
  </div>
  
    @if (Auth::check())
      <ul class="nav navbar-nav navbar-center nombredoncominio col-md-6 col-xs-5">
        <div class=""> {{ Auth::user()-> nombre_condominio }}</div>
      </ul>
    @else 
      <div class="col-md-6 col-xs-5" id="nombre_condominio"></div>
    @endif 


   
  
  <ul class="nav navbar-nav navbar-right col-xs-5" id="userreg" style="text-align:right;">
      
      @if (Auth::check())

        <li class="">

            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()-> name }}
                <span class=" fa fa-angle-down"></span>
            </a>
            <ul class="dropdown-menu dropdown-usermenu pull-right">
                <li><a href="{{URL::to('/') }}/usuarios/{{Auth::user()->login}}/edit">Perfil</a></li>
                <li><a href="{{URL::to('/') }}/logout"><i class="fa fa-sign-out"></i>Desconectarse</a></li>
            </ul>
         </li>
         @if (Auth::user()->tipo == '1')
            @if (Session::has('count-confirm-users'))
                <li class="">
          
                    <a href="{{URL::to('/') }}/usuarios/poraprobar" class="info-number">
                      <i class="fa fa-user-plus"></i>
                      <span class="badge bg-green">{{ Session::get('count-confirm-users')}}</span>
                    </a>
                  </li>
            @endif 
          @endif 
       
      @else
        <li class="">
          <a href="{{URL::to('/') }}/usuarios/create">Registrarse</a>
        </li>
        <li class="">
          <a href="{{URL::to('/') }}/login">Iniciar Sesion</a>
        </li>
      @endif 
    </ul>
    
</nav>
</div>

