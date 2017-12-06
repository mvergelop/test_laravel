 @if(count($errors) >0) 

 	@section ('jspnotify')

 		<script type="text/javascript">
 			
 			$(document).ready(function(){
				@foreach ($errors->all() as $error)
		                msjPnotify('error','Advertencia','{!! $error !!}');
		        @endforeach
			});

 		</script>
 	@stop 
@endif 