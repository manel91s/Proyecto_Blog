<aside>
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

            <div class="content">
            <p class="margin-5px-top">
            <input type="submit">
            </p>
            <a href="{{ action('UserController@index') }}">Registrate aqui</a>
            </div>
            
        </form>
    </div>


    <div class="padding-80px-top">
        <h2>Search.</h2>
    </div>
</aside>