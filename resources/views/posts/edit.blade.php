
@php use App\Custom\Utils; @endphp
@extends('layout-front.layout_front')



@section('section')

<h1 class="padding-20px-bottom">Editar entrada {{$detailsPost[0]->title}}</h1>
<form action="{{ action('PostController@update') }}" method="post" enctype="multipart/form-data">


  

    {{ csrf_field() }}
    @php $user = session('login') @endphp
    @if (session()->has('login'))
    <p>
        <input type="hidden" name="id_user" value="{{$user->id}}">
        <input type="hidden" name="id_post" value="{{$detailsPost[0]->id}}">
    </p>
  

    <p>
        <label for="name">Categoria de la entrada</label>
    </p>

   <p>
        @php $categorys = Utils::showCategorias() @endphp

        
       
        <select name="id_category" id="id_category">

        <option value="{{$detailsPost[0]->id}}" selected>{{$detailsPost[0]->name_category}}</option>

            @for($i=0; $i< sizeof($categorys); $i++)
                @if($categorys[$i]->name != $detailsPost[0]->name_category)

                <option value="{{$categorys[$i]->id}}">{{$categorys[$i]->name}}</option>
                
                @endif
            @endfor
   
        </select>

        <p class="alert-warning">{{$errors->first('id_category')}}</p>
    </p>

    <p class="margin-10px-top"> 
        <label for="imagen">Subir imagen de la entrada</label> <br/>
        <input type="file" name="image"> 
        <p class="alert-warning">{{$errors->first('image')}}</p>
        <input type="hidden" name="current_image" value="{{$detailsPost[0]->image}}">
    </p>

    <p class="margin-10px-top">
        <label for="image">Subir imagen de la caratula</label><br/>
        <input type="file" name="cover">
        <p class="alert-warning">{{$errors->first('cover')}}</p>
        <input type="hidden" name="current_cover" value="{{$detailsPost[0]->cover}}">
    </p>
  

    <p class="margin-10px-top">
        <label for="title">Titulo</label>
        <input type="text" name="title" placeholer="Apellidos" value="{{$detailsPost[0]->title}}">
        <p class="alert-warning">{{$errors->first('title')}}</p>
        
    </p>

    <p class="margin-10px-top">
        <label for="featured">Entrada Destacada</label><br/>



        <input type="radio" id="featured" name="featured" value="1" checked>
        <label class="margin-10px-right" for="featrued">Si</label>
        <input type="radio" id="" name="featured" value="2">
        <label for="featured">No</label>
    </p>

    <p class="margin-10px-top">
        <label for="body">Cuerpo del texto</label><br/>
        <textarea name="body" id="body" cols="30" rows="20">{{$detailsPost[0]->body}}</textarea>
        <p class="alert-warning">{{$errors->first('body')}}</p>
    </p>
    @endif

  


    @if (Session::has('success'))
    <p class="alert-success">{{Session::get('success')}}</p>
    @endif

    <input type="submit" value="Enviar">
</form>



@endsection