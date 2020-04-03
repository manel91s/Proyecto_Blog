<?php use App\Custom\Utils;?>

<aside>



    <?php $user = session('login')?>
    @if(session()->has('login'))
        
    <div>
        <h2>Panel de Usuario.</h2>

        
        
        <i class="fa fa-user" aria-hidden="true"></i><span>Hola <?=$user->name ." ". $user->surname?></span>
        <a href="{{ action('UserController@logout') }}">Cerrar Session</a>

        
    
    </div>
    @else
    <div>
        <h2>Login.</h2>
        <form action="{{ action('UserController@login') }}" method="post">
            {{ csrf_field() }}
            <p>
                <input type="text" name="email" placeholder="Ponga aqui su email">
                <p class="alert-warning">{{$errors->first('email')}}</p>
            </p>

            <p class="margin-5px-top">
                <input type="password" name="password" placeholder="Ponga aqui su password">
                <p class="alert-warning">{{$errors->first('password')}}</p>
            </p>
           
            @if(Session::has('login_failed'))
                  <p class="alert-warning">{{Session::get('login_failed')}}</p>
            @endif

            <div class="content">
                <p class="margin-5px-top">
                    <input type="submit">
                </p>

             
                <a href="{{ action('UserController@index') }}">Registrate aqui</a>
            </div>
           

        </form>
    </div>

    @endif


    <div class="padding-80px-top">
        <h2>Search.</h2>
    </div>
</aside>