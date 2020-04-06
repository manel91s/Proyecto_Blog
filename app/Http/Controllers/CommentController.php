<?php

namespace App\Http\Controllers;
Use Carbon\Carbon;
use App\Comment;
use Session;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(Request $request) {

        $currentTime =Carbon::now();
        $validate = $this->validate($request, [
            'id_user' => 'required|integer',
            'description' => 'required',
          ]);
        
          $comment = new Comment;
          $comment->setCreated_at($currentTime);
          $comment->setUpdated_at($currentTime);
          $comment->setUser($request->input('id_user'));
          $comment->setid_post($request->input('id_post'));
          $comment->setDescription($request->input('description'));
          $save = $comment->saveComment();

          if($save) {
            Session::flash('success', 'Comentario enviado');
          }
             

          return back();
    }
}
