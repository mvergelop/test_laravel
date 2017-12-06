@extends('layouts.principal')

@section('menu')    
    @include('layouts.menu1')  
@stop

@section('usuario')    
    @include ('layouts.usuariotoolbar')
@stop


@section ('contenido')
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<img src="{{env('ROUTE_CSSJS') }}storage/{{$img_precios}}" class="img-responsive center-block">
        

@stop


