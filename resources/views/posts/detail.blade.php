@extends('layout-front.layout_front')

@section('section')


@for ($i=0; $i< sizeof($detailPost); $i++)
    <article class="padding-40px-bottom">
        <img src="{{ asset('images/'.$detailPost[$i]->image)}}" alt="">
        
        <div>
        <h1>{{$detailPost[$i]->title}}</h1>
        <p>Genero : {{$detailPost[$i]->name_category}}</p>
        <p>{{$detailPost[$i]->body}}</p>
        <p>Posteado por: {{$detailPost[$i]->name_user}}</p>
        </div>
  </article>
  @endfor

        <div class="comments margin-50px-bottom">
        <img src="" alt="">
        <span>Nombre</span>

        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Reiciendis non optio sapiente ipsa! Eos eius ipsum in cum! Rem, quam provident veniam sit voluptatum ab dolorem officia. Deserunt aliquam qui natus ipsum voluptates in dolorem quibusdam minima quia aliquid? Animi minus quis nihil ipsum dolore voluptatem iure reiciendis nam explicabo?</p>

        </div>


        @for ($i=0; $i< sizeof($detailPost); $i++)
        @if (session()->has('login'))
        <form action="{{ action('CommentController@create') }}" method="POST">
        {{ csrf_field() }}
       
        <h2>Comentarios</h2>
       
        @php $user = session()->get('login')  @endphp
        <input type="hidden" name="id_user" value="{{$user->id}}">
        <input type="hidden" name="id_post" value="{{$detailPost[$i]->id}}">
       
       
        <textarea class="padding-20px-top" name="description" id="" cols="30" rows="20"></textarea>
        <p class="alert-warning">{{$errors->first('description')}}</p>
        <input type="submit" value="Enviar">
        </form>
        @else

        <p>Quieres dejar un comentario? Registrate!</p>

        @endif

        @endfor
        
  

@endsection