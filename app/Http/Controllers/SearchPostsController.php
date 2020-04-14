<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class SearchPostsController extends Controller
{
    public function index() {

        
        $allPosts = DB::table('post')
        ->join('user', 'post.id_user', '=', 'user.id')
        ->join('category', 'post.id_category', '=', 'category.id')
        ->select('user.name as name_user', 'post.*', 'category.name as name_category')
        ->orderByDesc('post.id')->get();
    
        
        return response()->json(['allPosts' => $allPosts]);
        
    }
    
    
}
