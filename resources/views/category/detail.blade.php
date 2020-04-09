@extends('layout-front.layout_front')


@section ('section')


<div class="container-movie">
@for ($i=0; $i < sizeof($detailCategory); $i++)

<div>
<a href="{{ route('detail.post',$detailCategory[$i]->id)}}"><img src="{{ asset('imagesCover/'.$detailCategory[$i]->cover)}}" alt=""></a>
<p>{{$detailCategory[$i]->title}}</p>

</div>
<div>
@endfor

@endsection