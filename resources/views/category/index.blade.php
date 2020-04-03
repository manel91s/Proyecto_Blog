<?php use App\Custom\Utils;?>

@extends('layout-front.layout_front')



@section('section')
<h1 class="padding-20px-bottom"> Crear Categoria</h1>

<form action="{{ action('CategoryController@create') }}" method="post">

        {{ csrf_field() }}
    <p>
        <label for="name">Nombre Categoria</label>
        <input type="text" name="name" placeholer="Nombre">
        <p class="alert-warning">{{$errors->first('name')}}</p>
    </p>


    <input type="submit" value="Enviar">
</form>
@endsection


