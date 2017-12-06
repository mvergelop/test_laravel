@extends('layouts.principal')

@section('menu')    
    @include('layouts.menu1')  
@stop

@extends('common_js.pnotify_include')

@section('usuario')    
    @include ('layouts.usuariotoolbar')
@stop



@section ('contenido')

  <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
             <h2>Re-Apertura de Periodos</small></h2>
            <ul class="nav navbar-right panel_toolbox">
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            @include ('layouts.modalquestion')

            
                <input type="hidden" name="_token" value ="{{ csrf_token()}}" id= 'token'>
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            {!!Form::label('lb_periodo','Periodo:')!!}
                             <select class="form-control col-md-7 col-xs-12" name="periodo" id="id_periodo">
                                <option value='' disabled selected style='display:none;'>Periodo</option>
                                @foreach($periodos as $periodo)
                                  <option value="{{$periodo->id}}">{{$periodo->periodo}}</option>
                                @endforeach 
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 col-xs-12">
                      <div class="form-group ">
                        <br>
                        <button class="btn btn-danger" id='btfinalizar'><i class="fa fa-gear"></i>Abrir Periodo</button>
                      </div>
                    </div>
                </div>
            </div>
            

                
          </div>
        </div>
      </div>

  

@stop

@section ('jsscripts')  

   
  
   @include('abrirperiodo.js')
  
   
  
  
@stop 


