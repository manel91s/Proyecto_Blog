@php use App\Custom\Utils @endphp
@extends('layout-front.layout_front')



@section('section')

<h1 class="padding-20px-bottom">Crear entradas de peliculas</h1>
<form action="{{ action('UserController@create') }}" method="post">

    {{ csrf_field() }}
    @php $user = session('login') @endphp
    <p>
        <input type="hidden" name="id" value="{{$user->id}}">
    </p>

    <p>
        <label for="name">Categoria de la entrada</label>
    </p>

    <p>
        @php $categorys = Utils::showCategorias() @endphp
        <select name="category" id="">
            @foreach ($categorys as $category)
            <option value="$category->id">{{$category->name}}</option>
            @endforeach
        </select>
    </p>

    <p class="margin-10px-top"> 
        <label for="imagen">Subir imagen de la categoria</label> <br/>
        <input type="file">
    </p>
  

    <p class="margin-10px-top">
        <label for="title">Titulo</label>
        <input type="text" name="title" placeholer="Apellidos">
        <p class="alert-warning">{{$errors->first('surname')}}</p>

    </p>

    <p class="margin-10px-top">
        <label for="email">Entrada Destacada</label><br/>
       
        <input type="radio" id="" name="featured" value="1" checked>
        <label class="margin-10px-right" for="featrued">Si</label>
        <input type="radio" id="" name="featured" value="2">
        <label for="featured">No</label>
        
    </p>

    <p class="margin-10px-top">
        <label for="body">Cuerpo del texto</label><br/>
        <textarea name="" id="" cols="30" rows="20"></textarea>
        <p class="alert-warning">{{$errors->first('password')}}</p>
    </p>

    @if (Session::has('success_message'))
    <p class="alert-success">{{Session::get('success_message')}}</p>
    @endif

    <input type="submit" value="Enviar">
</form>


@endsection