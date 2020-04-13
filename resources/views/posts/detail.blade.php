@php use App\Custom\Utils @endphp
@php use Illuminate\Pagination\Paginator @endphp
@extends('layout-front.layout_front')

@section('section')


@for ($i=0; $i< sizeof($detailPost); $i++)
    <article class="padding-40px-bottom">
        <img src="{{ asset('images/'.$detailPost[$i]->image)}}" alt="">
        
        <div>
        <h1>{{$detailPost[$i]->title}}</h1>
        <p>Genero : <span class="text-bold">{{$detailPost[$i]->name_category}}</span></p>
        <p>{{$detailPost[$i]->body}}</p>
        <p>Posteado por: <span class="text-bold">{{$detailPost[$i]->name_user}}</span></p>

        </div>
  </article>
  @endfor

       
        @php $commentUser = Utils::showCommentsByPost($detailPost[0]->id) @endphp
        @for ($i=0; $i < sizeof($commentUser); $i++)
        <div class="comments margin-50px-bottom">
        <div id="container-photo">
        
        @if($commentUser[$i]->role_name=='Admin')
            @php $roleClass = "photoAdmin"; @endphp
            @else
            @php $roleClass=""; @endphp
            @endif

        @if ($commentUser[$i]->avatar_url!=null) 
        <img class="avatar_image {{$roleClass}}" src="{{asset('avatar_img/'.$commentUser[$i]->avatar_url)}}"  alt=""> 
        @else
        <img src="" alt="">
        @endif

        <p class="role-color text-bold">{{$commentUser[$i]->role_name}}</p>
        <span class="text-bold">{{$commentUser[$i]->name}}</span>
        </div>
        <div id="container-comment">
        <p>{{$commentUser[$i]->created_at}}</p>
        <p>{{$commentUser[$i]->description}}</p>
        </div>


        </div>

        @endfor
        
      
        {{$commentUser->links()}}
        


        @for ($i=0; $i< sizeof($detailPost); $i++)
        @if (session()->has('login'))
        <form action="{{ action('CommentController@create') }}" method="POST" class="form-comment">
        {{ csrf_field() }}
       
        <h2>Pon tu comentario</h2>
       
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