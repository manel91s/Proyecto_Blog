@extends('layout-front.layout_front')


@section('section')




<form action="{{ action('UserController@update') }}" method="post" enctype="multipart/form-data">

        {{ csrf_field() }}

    <input type="hidden" name="id" value="{{$infoUser ? $infoUser->id : ''}}" >
    <p>
        <label for="name">Nombre</label>
        <input type="text" name="name" placeholer="Nombre" value="{{$infoUser ? $infoUser->name : ''}}" >
    </p>

    <p class="margin-10px-top">
        <label for="surname">Apellidos</label>
    <input type="text" name="surname" placeholer="Apellidos" value="{{$infoUser ? $infoUser->surname : ''}}">


    </p>

    <p class="margin-10px-top">
        <label for="email">email</label>
        <input type="email" name="email" placeholer="Email" value="{{$infoUser ? $infoUser->email : ''}}">
        <p class="alert-warning">{{$errors->first('email')}}</p>
  
    </p>

    <p class="margin-10px-top">
        <label for="password">New password</label>
        <input type="password" name="password" placeholer="password">
        <p class="alert-warning">{{$errors->first('password')}}</p>

    </p>

    

    <p class="margin-10px-top">
        <label for="image">Imagen</label><br/>
        <input type="file" name="image" placeholer="url">
        <input type="hidden" name="update_image" value="{{$infoUser ? $infoUser->avatar_url : ''}}">
    </p>
    

    @if (Session::has('success_message'))
        <p class="alert-success">{{Session::get('success_message')}}</p>
    @endif

    <input type="submit" value="Enviar">
</form>
@endsection