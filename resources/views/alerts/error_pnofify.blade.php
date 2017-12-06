@if (Session::has('notify-body'))
  <script type="text/javascript">

    $(document).ready(function(){

      new PNotify({
              title: '<b>{{ Session::get('notify-head')}}</b>',
              text: '{{ Session::get('notify-body')}}',
              type: 'success'
          });
    });
    
  </script>

@endif 