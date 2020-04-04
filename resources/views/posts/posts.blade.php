@extends('layout-front.layout_front')



@section('section')


@for ($i=0; $i< sizeof($featuredPosts); $i++)
    <article class="padding-80px-bottom">
        <img src="images/{{$featuredPosts[$i]->image}}" alt="">
        
        <div>
        <h1>{{$featuredPosts[$i]->title}}</h1>

        <p>{{$featuredPosts[$i]->body}}</p>

        <a class="btn-read" href="{{$featuredPosts[$i]->id}}">Continuar Leyendo</a>
        </div>
    </article>
@endfor


<div class="pagination">


</div>

@endsection




