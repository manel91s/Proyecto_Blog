<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    function index(Request $request) {
        
        if($request->ajax()){
            $dato = $request->input('name');

               $searchPost = DB::table('post')
                        ->join('user', 'post.id_user', '=', 'user.id')
                        ->join('category', 'post.id_category', '=', 'category.id')
                        ->where('post.title', 'LIKE', '%'.$dato.'%')
                        ->select('user.name as name_user', 'post.*', 'category.name as name_category')
                        ->orderByDesc('post.id')->get();
               
        

            return response()->json(['search' => $searchPost]);
        }
    }
}
