<?php

namespace App\Http\Controllers;
Use Carbon\Carbon;
use DB;
use Session;


use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {

        $featuredPost = DB::table('post')
                        ->join('user', 'post.id_user', '=', 'user.id')
                        ->join('category', 'post.id_category', '=', 'category.id')
                        ->select('user.name as name_user', 'post.*', 'category.name as name_category')
                        ->orderByDesc('post.id')->simplePaginate(2);
                        
    
        return view('posts.posts', ['pageName' => 'page-post',
                                    'featuredPosts' => $featuredPost,
                                    'dataPage' => 'page-post']);
    }

    public function create() {
        
        if(!session()->has('admin')) {   
            return redirect()->action('PostController@index');
           }

        return view('posts.create', ['pageName' => 'page-post',
                                     'dataPage' => 'page-post'
                                    ]);
    }

  
    public function managament() {

        if(!session()->has('admin')) {   
            return redirect()->action('PostController@index');
           }

           
           
           return view('posts.managament', ['pageName' => 'page-post',
                                           'dataPage' => 'page-post-managament']);
    }

    public function detail($id) {
        
        $detailPost = DB::table('post')
        ->join('user', 'post.id_user', '=', 'user.id')
        ->join('category', 'post.id_category', '=', 'category.id')
        ->select('user.name as name_user', 'post.*', 'category.name as name_category')
        ->where('post.id', '=', $id)->get();
        

        return view('posts.detail', ['detailPost' => $detailPost] ,['pageName' => 'page-post',
                                                                    'dataPage' => 'page-post'
                                                                    ]);
    }

    public function save(Request $request) {

        $validate = $this->validate($request, [
            'id_user' => 'required|integer',
            'id_category' => 'required|integer',
            'image' => 'required|max:2048|mimes:jpeg,jpg, png',
            'cover' => 'required|max:2048|mimes:jpeg,jpg, png',
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

        if($request->hasFile('cover')) {
            $fileCover = $request->file('cover');
            $nameCover = time().$fileCover->getClientOriginalName();
            
            //Comprobar el tipo de la imagen para guardar en el storage
            if($fileCover->getMimeType() == 'image/jpeg' || $fileCover->getMimeType() == 'image/jpg' || $fileCover->getMimeType() == 'image/png') 
            {
                $fileCover->move(public_path().'/imagesCover/', $nameCover);
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
            'cover' => $nameCover,
            'title' => $request->input('title'),
            'featured' => $request->input('featured'),
            'body' => $request->input('body'),
        ));

          

          return back()->with('success', 'Entrada publicada satisfactoriamente');

    }

    public function queryPost() {

        $allPosts = DB::table('post')
        ->join('user', 'post.id_user', '=', 'user.id')
        ->join('category', 'post.id_category', '=', 'category.id')
        ->select('user.name as name_user', 'post.*', 'category.name as name_category')
        ->orderByDesc('post.id')->simplePaginate(10);

        
        return response()->json(['allPosts' => $allPosts]);
    }


    public function deletePost(Request $request) {

        
        if($request->ajax()){
            $postId = (int) $request->input('idPost');

            
            $deletePost = DB::table('post')->where('post.id', '=',$postId)->delete();

            return response()->json(['success' => 'Registro borrado correctamente']);

              
        }

     }

     public function detailedit($id) {

        if(!session()->has('admin')) {   
            return redirect()->action('PostController@index');
           }

        
        $detailsPost = DB::table('post')
        ->join('user', 'post.id_user', '=', 'user.id')
        ->join('category', 'post.id_category', '=', 'category.id')
        ->select('user.name as name_user', 'post.*', 'category.name as name_category')
        ->where('post.id', '=', $id)->get();

        



        return view('posts.edit',['detailsPost' => $detailsPost,
                                  'pageName' => 'page-post',
                                  'dataPage' => 'page-post']);
                                                

     }

     public function update(Request $request) {

     

        $id = $request->input('id_user');
        $id_post = $request->input('id_post');
        $current_image = $request->input('current_image');
        $current_cover = $request->input('current_cover');

        $validate = $this->validate($request, [
            'id_user' => 'required|integer',
            'id_category' => 'required|integer',
            'title' => 'required|string|max:120',
            'featured' => 'required|integer',
            'body' => 'required|string|',
          ]);

          
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time().$file->getClientOriginalName();
            
            //Comprobar el tipo de la imagen para guardar en el storage
            if($file->getMimeType() == 'image/jpeg' || $file->getMimeType() == 'image/jpg' || $file->getMimeType() == 'image/png') 
            {
                $file->move(public_path().'/images/', $name);
            }
        }else {
            $name = $current_image;
        }

        if($request->hasFile('cover')) {
            $fileCover = $request->file('cover');
            $nameCover = time().$fileCover->getClientOriginalName();
            
            //Comprobar el tipo de la imagen para guardar en el storage
            if($fileCover->getMimeType() == 'image/jpeg' || $fileCover->getMimeType() == 'image/jpg' || $fileCover->getMimeType() == 'image/png') 
            {
                $fileCover->move(public_path().'/imagesCover/', $nameCover);
            }
        }else {
            $nameCover = $current_cover;
        }

        $currentTime =Carbon::now();
        $update = DB::table('post')
            ->where('id', $id_post )
            ->update(['updated_at' => $currentTime,
                      'id_user' => $id,
                      'id_category' => $request->input('id_category'),
                      'image' => $name,
                      'cover' => $nameCover,
                      'title' => $request->input('title'),
                      'featured' => $request->input('featured'),
                      'body' => $request->input('body')
                      ]);

      
  
         Session::flash('success', 'Usuario Actualizado Correctamente');

         return redirect()->action('PostController@managament')->with('success', 'Post actualizado!');

     }

}