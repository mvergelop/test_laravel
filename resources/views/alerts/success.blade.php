@if (Session::has('message'))

	<div class="alert alert-success alert-dismissible fade in" role="alert">
		{{ Session::get('message')}}
		<button type="button" data-dismiss="alert" class="close"></button>
	</div>

@endif