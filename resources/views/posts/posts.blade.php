
@extends('layout-front.layout_front')



@section('section')


@for ($i=0; $i< sizeof($featuredPosts); $i++)
    <article class="padding-80px-bottom">
        <img src="{{asset('images/'.$featuredPosts[$i]->image)}}" alt="">
        <div>
        <h1>{{$featuredPosts[$i]->title}}</h1>
        <p>Genero : {{$featuredPosts[$i]->name_category}}</p>
        <p>{{substr($featuredPosts[$i]->body,0,400)}}...</p>

        <p>Posteado por: {{$featuredPosts[$i]->name_user}}</p>
        
        <a class="btn-read" href="{{ route('detail.post',$featuredPosts[$i]->id)}}">Continuar Leyendo</a>
        </div>
    </article>
@endfor


<div class="pagination">


</div>

@endsection




