@if (Auth::check())
    <li>
       <a href="">
           Account
        </a>
    </li>
    
    <li>
        <a href="#">
            Log out
        </a>
    </li>
@else 
    <li>
        <a href="usuario/create">
            Registrarme
        </a>
    </li>
@endif