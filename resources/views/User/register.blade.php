@extends('layout-front.layout_front')



@section('section')
<form action="{{ action('UserController@create') }}" method="post">

        {{ csrf_field() }}
    <p>
        <label for="name">Nombre</label>
        <input type="text" name="name" placeholer="Nombre">
        <p class="alert-warning">{{$errors->first('name')}}</p>
    </p>

    <p class="margin-10px-top">
        <label for="surname">Apellidos</label>
        <input type="text" name="surname" placeholer="Apellidos">
        <p class="alert-warning">{{$errors->first('surname')}}</p>

    </p>

    <p class="margin-10px-top">
        <label for="email">email</label>
        <input type="email" name="email" placeholer="Email">
        <p class="alert-warning">{{$errors->first('email')}}</p>
    </p>

    <p class="margin-10px-top">
        <label for="password">password</label>
        <input type="password" name="password" placeholer="password">
        <p class="alert-warning">{{$errors->first('password')}}</p>
    </p>

    <p class="margin-10px-top">
        <label for="avatar_url">url</label>
        <input type="text" name="avatar_url" placeholer="url">
        <p class="alert-warning">{{$errors->first('avatar_url')}}</p>
    </p>

    @if (Session::has('success_message'))
        <p class="alert-success">{{Session::get('success_message')}}</p>
    @endif

    <input type="submit" value="Enviar">
</form>

@endsection