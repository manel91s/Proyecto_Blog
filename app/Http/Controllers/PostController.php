<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {

        return view('posts.posts', ['pageName' => 'page-post']);
    }

    public function create() {
        
        return view('posts.create', ['pageName' => 'page-post']);
    }

    public function save(Request $request) {

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time().$file->getClientOriginalName();
            
            //Comprobar el tipo de la imagen para guardar en el storage
            if($file->getMimeType() == 'image/jpeg' || $file->getMimeType() == 'image/jpg' || $file->getMimeType() == 'image/png') 
            {
                $file->move(public_path().'/images/', $name);
            }
        }

        $validate = $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'avatar_url' => 'required|string|',
          ]);

    }
}