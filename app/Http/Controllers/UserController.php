<?php

namespace App\Http\Controllers;
Use Carbon\Carbon;
use DB;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Custom\Utils;

class UserController extends Controller
{

    public function index($id = null) {

      $login = session('login');
      $user = null;

      //comprobación de acceso del usuario a actualizar su perfil
      if(!empty($id) && $login && $id==$login->id) {

          $user = DB::table('user')
          ->where('id',$id)
          ->first();

          return view('User.update', [ 'pageName' => 'page-user',
          'infoUser' => $user,
          'dataPage' => 'page-user']);  

      }else{


      return view('User.register', [ 'pageName' => 'page-user',
                                     'dataPage' => 'page-user']);
      }
    }

    public function update(Request $request) {
        
      $id = $request->input('id');
      $pass = $request->input('password');

      $validate = $this->validate($request, [
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'password' => 'required|string|max:255',
        'image' => 'max:2048|mimes:jpeg,jpg, png',
      ]);

      if($request->hasFile('image')) {
        $file = $request->file('image');
        $name = time().$file->getClientOriginalName();
        
        //Comprobar el tipo de la imagen para guardar en el storage
        if($file->getMimeType() == 'image/jpeg' || $file->getMimeType() == 'image/jpg' || $file->getMimeType() == 'image/png') 
        {
            $file->move(public_path().'/avatar_img/', $name);
        }

        }else {
        $name = $request->input('update_image');
        }
        
        
        //Verificar la actualizacion de la password
        $user = DB::table('user')
        ->where('id',$id)
        ->first();

        //Si son iguales dejamos la password como estaba
        if(Utils::password_verify($request->input('password'), $pass)){

          $updatePassword = $pass;
        
          //Si no cojemos la del input y la ciframos
        }else{
          $updatePassword = Hash::make($request->input('password'));
        }


      $currentTime =Carbon::now();
      $update = DB::table('user')
          ->where('id', $id)
          ->update(['updated_at' => $currentTime,
                    'name' => $request->input('name'),
                    'surname' => $request->input('surname'),
                    'email' => $request->input('email'),
                    'password' => $updatePassword,
                    'avatar_url' => $name
                    ]);

            Session::flash('success_message', 'Usuario Actualizado Correctamente');


        return back();
    }


    public function create(Request $request) {


        $validate = $this->validate($request, [
          'name' => 'required|string|max:255',
          'surname' => 'required|string|max:255',
          'email' => 'required|string|max:255',
          'password' => 'required|string|max:255',
          'image' => 'max:2048|mimes:jpeg,jpg, png',
        ]);

        if($request->hasFile('image')) {
          $file = $request->file('image');
          $name = time().$file->getClientOriginalName();
          
          //Comprobar el tipo de la imagen para guardar en el storage
          if($file->getMimeType() == 'image/jpeg' || $file->getMimeType() == 'image/jpg' || $file->getMimeType() == 'image/png') 
          {
              $file->move(public_path().'/avatar_img/', $name);
        
          }

        }else {
          $name = null;
        }

        $currentTime =Carbon::now();
        $user = DB::table('user')->insert(array(
            'created_at' => $currentTime,
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'avatar_url' => $name,
            'id_role' => 1
        ));

        Session::flash('success', 'Usuario Registrado Correctamente');

        return back();
    
    
  }

    public function login(Request $request) {

      $validate = $this->validate($request, [
        'email' => 'required|string|max:255',
        'password' => 'required|string|max:255',
      ]);

      

      $user = DB::table('user')
         ->where('email',$request->input('email'))
         ->first();

        
         if($user!=null) {
            $pass = $user->password;
            if($pass && Utils::password_verify($request->input('password'), $pass)){

              $Objuser = $user;
              $isAdmin = $Objuser->id_role==1;


              if($isAdmin){
                session(['admin' => true]);
               
              }

                session(['login' => $Objuser]);
              

           }else{
              Session::flash('login_failed', 'Datos del usuario incorrecto');
           }
           
         }else{
           
          Session::flash('login_failed', 'Datos del usuario incorrecto');
         }
         
         return back();

    }

 

    public function logout() {

        if(session()->has('login')) {
            session()->forget('login');
        }

        if(session()->has('admin')) {
          session()->forget('admin');
        }

        return back();

        
    }
}