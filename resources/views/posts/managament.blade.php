@extends('layout-front.layout_front')



@section('section')

<h2>Gestionar Entradas</h2>

@if (Session::has('success'))
    <p class="alert-success center-text">{{Session::get('success')}}</p>
@endif

<table id="allPost">



</table>

@endsection