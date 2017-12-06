@if (Auth::check())

    @if (Auth::user()->tipo =='2')
        @include('layouts.menu_user2')  
    @elseif (Auth::user()->tipo =='1') 
        @include('layouts.menu_user1')  
    @else
    @endif 

@else
    @include('layouts.menu_user4')  
@endif 