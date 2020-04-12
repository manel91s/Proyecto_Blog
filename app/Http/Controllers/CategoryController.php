<?php

namespace App\Http\Controllers;
use App\Custom\Utils;
use Illuminate\Http\Request;
Use Carbon\Carbon;
use DB;
use Session;

class CategoryController extends Controller
{
    public function index() {

        if(!session()->has('admin')) {   
         return redirect()->action('PostController@index');
        }

        return view('category.index', ['pageName' => 'page-category',
                                       'dataPage' => 'page-category']);
    }

    public function create(Request $request) {

        
        

        $validate = $this->validate($request, [
            'name' => 'required|string|max:20',
          ]);

        $currentTime =Carbon::now();
        $user = DB::table('category')->insert(array(
            'created_at' => $currentTime,
            'name' => $request->input('name'),
        ));

        Session::flash('success_message', 'Categoria creada correctamente');
        
        return back();
    }

    public function detail($id) {

        $detailCategory = DB::table('category')
        ->join('post', 'category.id', '=', 'post.id_category')
        ->where('category.id', '=', $id)->get();   
        
      
        
        
        
        return view('category.detail', ['detailCategory' => $detailCategory,    
                                        'pageName' => 'page-category',
                                        'dataPage' => 'page-category']);
    }

  
}
