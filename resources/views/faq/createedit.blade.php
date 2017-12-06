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
             <h2>FAQ</small></h2>
            <ul class="nav navbar-right panel_toolbox">
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            @include ('alerts.request')

                {!!Form::open(['url'=>$action, 'method'=>$method,'class' => 'form-horizontal form-label-left'])!!}

                    <input type="hidden" name="id" value ="{{$FAQ->id}}" id= 'id'>

                    <div class="form-group">
                        {!!Form::label('lb_tipogasto','Posicion:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                        <div class="col-md-2 col-sm-2 col-xs-2">
                          {!!Form::text('posicion',$FAQ->posicion,['class'=>'form-control'])!!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!!Form::label('lb_des','Pregunta:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('pregunta',$FAQ->pregunta,['class'=>'form-control col-md-7 col-xs-12'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('lb_des','Respuesta:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::textarea('respuesta',$FAQ->respuesta,['class'=>'form-control col-md-7 col-xs-12'])!!}
                        </div>
                    </div>
                    

                   <div class="form-group">
                        {!!Form::label('lb_mostrar','Mostrar:',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="checkbox checkbox-success" style="margin-top: 0;margin-bottom: 0">
                            @if ($FAQ-> mostrar = '1')
                                {!!Form::checkbox('mostrar', '1',true,array('class'=> 'styled') ) !!}
                            @else 
                                {!!Form::checkbox('mostrar', '0',true,array('class'=> 'styled') ) !!}
                            @endif 
                            <label></label>
                          </div>
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            {!!Form::submit($button,['class'=>'btn btn-success'])!!}
                        </div>
                    </div>
             
            {!!Form::close()!!}
          </div>
        </div>
      </div>


@stop