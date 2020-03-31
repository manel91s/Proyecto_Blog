<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntradaController extends Controller
{
    public function index () {

        $titulo = 'Bienvenido';
        return view('entradas.entrada',['titulo' => $titulo]);
    }

    public function detalle() {
        $titulo = 'Detalle de la entrada';
        return view('entradas.detalle', ['titulo' => $titulo]);
    }


}
