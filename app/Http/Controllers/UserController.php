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

    public function index() {

      return view('User.register', [ 'pageName' => 'page-user']);
    }


    public function create(Request $request) {

       
        $validate = $this->validate($request, [
          'name' => 'required|string|max:255',
          'surname' => 'required|string|max:255',
          'email' => 'required|string|max:255',
          'password' => 'required|string|max:255',
          'avatar_url' => 'required|string|',
        ]);

        $currentTime =Carbon::now();
        $user = DB::table('user')->insert(array(
            'created_at' => $currentTime,
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'avatar_url' => $request->input('avatar_url'),
            'id_role' => 2
        ));

        Session::flash('success_message', 'Usuario Registrado Correctamente');

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
        
         $pass = $user->password;

          
         if($pass && Utils::password_verify($request->input('password'), $pass)){
          
            $Objuser = $user;
            session(['login' => $Objuser]);

         }else{
            Session::flash('login_failed', 'Datos del usuario incorrecto');
         }

         $valor = session('login');

         return back();

    }

    public function logout() {

        if(session()->has('login')) {
            session()->forget('login');
        }

        return back();
    }
}