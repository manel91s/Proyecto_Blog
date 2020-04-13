@php use App\Custom\Utils @endphp
<aside>
    <div>

        <div class="padding-80px-bottom">
            <h2>Buscar.</h2>
            <form action="" method="GET" id="form-search">
            <input type="text" id="search" name="search" placeholder="Buscar pelicula"> 
            <input type="submit" value="Enviar">
            <div id="div1"></div>
            </form>
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

        @if($user && $user->id_role==1)
            @php $roleClass = "photoAdmin"; @endphp
            @else
            @php $roleClass=""; @endphp
            @endif

        @if(session()->has('admin') && session()->has('login'))


        <div class="padding-40px-bottom">
           
            <h2>Panel de Usuario.</h2>

            @php $realImage = Utils::showImage($user->id) @endphp

            @if($realImage && $user->avatar_url!=$realImage->avatar_url)
            <img class="avatar_image {{$roleClass}}" src="{{asset('avatar_img/'.$realImage->avatar_url)}}" alt="">
            @elseif($user->avatar_url!=null)
            <img class="avatar_image {{$roleClass}}" src="{{asset('avatar_img/'.$user->avatar_url)}}" alt="">
            @else
            <img class="" src="" alt="">
            @endif

            <div class="info-user">
            <i class="fa fa-user padding-20px-bottom" aria-hidden="true"></i><span class="text-bold">
                        <?=$user->name ." ". $user->surname?></span>

            <ul>
                <li><a href="{{ route('update.user',$user->id)}}">Gestionar Perfil</a></li>
                <li><a class="" href="{{ action('CategoryController@index') }}">Crear categorias</a></li>
                <li><a class="" href="{{ action('PostController@create') }}">Crear entrada</a></li>
                <li><a href="{{ action('PostController@managament') }}">Gestionar Entradas</a></li>
                <li><a class="" href="{{ action('UserController@logout') }}">Cerrar Session</a></li>
            </ul>
            </div>
         
        </div>

        @elseif(session()->has('login'))

        @php $realImage = Utils::showImage($user->id) @endphp

        <div>
            <h2>Panel de Usuario.</h2>
            
            @if($realImage && $user->avatar_url!=$realImage->avatar_url)
            <img class="avatar_image {{$roleClass}}" src="{{asset('avatar_img/'.$realImage->avatar_url)}}" alt="">
            @elseif($user->avatar_url!=null)
            <img class="avatar_image {{$roleClass}}" src="{{asset('avatar_img/'.$user->avatar_url)}}" alt="">
            @else
            <img class="" src="" alt="">
            @endif

            <div class="info-user"> 
                <i class="fa fa-user padding-20px-bottom" aria-hidden="true"></i><span class="text-bold">
                        <?=$user->name ." ". $user->surname?></span>
                <ul>
                    
                    <li><a href="{{ route('update.user',$user->id)}}">Gestionar Perfil</a></li>
                    <li><a href="{{ action('UserController@logout') }}">Cerrar Sesion</a></li>

                </ul>
            </div>

        </div>

        @endif

        <div>

            <h2>Categorias.</h2>
            @php $categorys = Utils::showCategorias() @endphp
            <ul>
                @foreach ($categorys as $category)
                <li>
                    <a href="{{ route('detail.category',$category->id)}}">{{$category->name}}</a>
                </li>
            @endforeach
            </ul>

        </div>



</aside>