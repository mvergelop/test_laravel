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
             <h2>Gastos</h2>
            <ul class="nav navbar-right panel_toolbox">
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            @include ('alerts.request')

                {!!Form::open(['url'=>$action, 'method'=>$method,'class' => 'form-horizontal form-label-left'])!!}

                    <input type="hidden" name="id" value ="{{$gasto->id}}" id= 'id'>

                    <div class="form-group">
                        {!!Form::label('lb_tipogasto','Tipo Gasto:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control col-md-7 col-xs-12" name="tipogasto" {{$readonly}}>
                                @foreach($tipogastos as $tipogasto)
                                  <option value="{{$tipogasto->id}}" @if ($gasto->id_tipogasto == $tipogasto->id) selected @endif>{{$tipogasto->descripcion}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!!Form::label('lb_des','Descripcion:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="descripcion" value="{{$gasto->descripcion}}" class="form-control" {{$readonly}}>
                        </div>
                    </div>
                    
                   <div class="form-group">
                        {!!Form::label('activo','Activo:',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="checkbox checkbox-success" style="margin-top: 0;margin-bottom: 0">
                                <input type="checkbox" name="activo" value="1" @if ($gasto->activo == 1) checked @endif class="styled" {{$readonly}}>
                                <label></label>
                            </div>
                        </div>
                    </div>
              
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            @if (!$readonly == 'disabled')
                                {!!Form::submit($button,['class'=>'btn btn-success'])!!}
                            @endif 
                        </div>
                    </div>
             
            {!!Form::close()!!}
          </div>
        </div>
      </div>


@stop