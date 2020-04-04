@extends('layout-front.layout_front')

@section('section')


@for ($i=0; $i< sizeof($detailPost); $i++)
    <article class="padding-80px-bottom">
        <img src="{{ asset('images/'.$detailPost[$i]->image)}}" alt="">
        
        <div>
        <h1>{{$detailPost[$i]->title}}</h1>
        <p>Genero : {{$detailPost[$i]->name_category}}</p>
        <p>{{$detailPost[$i]->body}}</p>

        <p>Posteado por: {{$detailPost[$i]->name_user}}</p>
        
        </div>
    </article>
@endfor
@endsection