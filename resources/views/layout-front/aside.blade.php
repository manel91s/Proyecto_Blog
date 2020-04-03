<?php use App\Custom\Utils;?>
<aside>
    <div>

        <div class="padding-80px-bottom">
            <h2>Search.</h2>
        </div>
        <div class="padding-40px-bottom">
            @if(!session()->has('login'))
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





        @php $user = session('login') @endphp
        @if(session()->has('admin') && session()->has('login'))


        <div class="padding-40px-bottom">
            <h2>Panel de Usuario.</h2>
            <ul>
                <li><i class="fa fa-user padding-20px-bottom" aria-hidden="true"></i><span>Hola
                        <?=$user->name ." ". $user->surname?></span></li>
                <li><a class="logout" href="{{ action('UserController@logout') }}">Cerrar Session</a></li>
                <li><a class="logout" href="{{ action('CategoryController@index') }}">Crear categorias</a></li>
            </ul>
        </div>

        @elseif(session()->has('login'))



        <div>
            <h2>Panel de Usuario.</h2>
            <ul>
                <li><i class="fa fa-user padding-20px-bottom" aria-hidden="true"></i><span>Hola
                        <?=$user->name ." ". $user->surname?></span></li>
                <li><a class="logout" href="{{ action('UserController@logout') }}">Cerrar Session</a></li>

            </ul>
        </div>

        @endif

        <div>

            <h2>Categorias.</h2>
            @php $categorys = Utils::showCategorias() @endphp
            <ul>
                @foreach ($categorys as $category)
                <li>
                    {{$category->name}}
                </li>
            @endforeach
            </ul>

        </div>



</aside>