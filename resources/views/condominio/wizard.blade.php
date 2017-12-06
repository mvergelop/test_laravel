@extends('layouts.principal')

@section('menu')    
    @include('layouts.menu1')  
@stop

@section('usuario')    
    @include ('layouts.usuariotoolbar')
@stop

@section ('contenido')

	
    
	
     <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Datos Condominio</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
    	@include ('alerts.request')
    	<p>This is a basic form wizard example that inherits the colors from the selected scheme.</p>
        <div id="wizard" class="form_wizard wizard_horizontal">
          <ul class="wizard_steps">
            <li>
              <a href="#step-1">
                <span class="step_no">1</span>
                <span class="step_descr">
                                  Step 1<br />
                                  <small>Step 1 description</small>
                              </span>
              </a>
            </li>
            <li>
              <a href="#step-2">
                <span class="step_no">2</span>
                <span class="step_descr">
                                  Step 2<br />
                                  <small>Step 2 description</small>
                              </span>
              </a>
            </li>
            <li>
              <a href="#step-3">
                <span class="step_no">3</span>
                <span class="step_descr">
                                  Step 3<br />
                                  <small>Step 3 description</small>
                              </span>
              </a>
            </li>
            <li>
              <a href="#step-4">
                <span class="step_no">4</span>
                <span class="step_descr">
                                  Step 4<br />
                                  <small>Step 4 description</small>
                              </span>
              </a>
            </li>
          </ul>
          <div id="step-1">
            @include ('condominio.form')
          <div id="step-2">
            <h2 class="StepTitle">Step 2 Content</h2>
            <p>
              do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
              fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
              in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
          </div>
          <div id="step-3">
            <h2 class="StepTitle">Step 3 Content</h2>
            <p>
              sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
              eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
              in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
          </div>
          <div id="step-4">
            <h2 class="StepTitle">Step 4 Content</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
              Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
              in reprehender
              it in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
              in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
          </div>

        </div>

    </div>   </div>
        </div>
      </div>
    </div>



@stop 


@section ('jsscripts')

<script type="text/javascript"></script>


	<script src="{{env('ROUTE_CSSJS') }}js/jquery.smartWizard.js"></script>

	<script>
      $(document).ready(function() {
        $('#wizard').smartWizard();

        $('#wizard_verticle').smartWizard({
          transitionEffect: 'slide'
        });

        $('.buttonNext').addClass('btn btn-success');
        $('.buttonPrevious').addClass('btn btn-primary');
        $('.buttonFinish').addClass('btn btn-default');
      });
    </script>


@stop 