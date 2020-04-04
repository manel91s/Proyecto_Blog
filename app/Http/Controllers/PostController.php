<?php

namespace App\Http\Controllers;
Use Carbon\Carbon;
use DB;


use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {

        $featuredPost = DB::table('post')->get()->where('featured',1);

    
        return view('posts.posts', ['pageName' => 'page-post',
                                    'featuredPosts' => $featuredPost]);
    }

    public function create() {
        
        if(!session()->has('admin')) {   
            return redirect()->action('PostController@index');
           }

        return view('posts.create', ['pageName' => 'page-post']);
    }

    public function save(Request $request) {
        
     


        $validate = $this->validate($request, [
            'id_user' => 'required|integer',
            'id_category' => 'required|integer',
            'image' => 'required|max:2048|mimes:jpeg,jpg, png',
            'title' => 'required|string|max:120',
            'featured' => 'required|integer',
            'body' => 'required|string|',
          ]);

          //Si llega alguna imagen ...

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time().$file->getClientOriginalName();
            
            //Comprobar el tipo de la imagen para guardar en el storage
            if($file->getMimeType() == 'image/jpeg' || $file->getMimeType() == 'image/jpg' || $file->getMimeType() == 'image/png') 
            {
                $file->move(public_path().'/images/', $name);
            }
        }

        
        
        $currentTime =Carbon::now();
        $post = DB::table('post')->insert(array(
            'id_user' => $request->input('id_user'),
            'created_at' => $currentTime,
            'updated_at' => $currentTime,
            'id_user' => $request->input('id_user'),
            'id_category' => $request->input('id_category'),
            'image' => $name,
            'title' => $request->input('title'),
            'featured' => $request->input('featured'),
            'body' => $request->input('body'),
        ));

          

          return back()->with('success', 'Entrada publicada satisfactoriamente');

    }
}