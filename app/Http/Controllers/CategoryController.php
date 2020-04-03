<?php

namespace App\Http\Controllers;
use App\Custom\Utils;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {

        if(!session()->has('admin')) {   
         return redirect()->action('PostController@index');
        }

        return view('category.index', ['pageName' => 'page-category']);
    }

  
}
