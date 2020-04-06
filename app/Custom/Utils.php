<?php namespace App\Custom;
Use DB;

class Utils {

    public static function showCategorias() {
        
        $allCategory = DB::table('category')->get();

        return $allCategory;

    }

    public static function showCommentsByPost($idPost) {

        $comments = DB::table('comment')
                        ->join('post','comment.id_post','=','post.id')
                        ->join('user', 'comment.id_user', '=', 'user.id')
                        ->select('comment.description','user.name','user.surname')
                        ->where('comment.id_post', '=', $idPost)
                        ->get();

        return $comments;
    }
  
    

    //Password hass verify
    public static function password_verify($password, $hash) {
          if (!function_exists('crypt')) {
              trigger_error("Crypt must be loaded for password_verify to function", E_USER_WARNING);
              return false;
          }
          $ret = crypt($password, $hash);
          if (!is_string($ret) || strlen($ret) != strlen($hash) || strlen($ret) <= 13) {
              return false;
          }

          $status = 0;
          for ($i = 0; $i < strlen($ret); $i++) {
              $status |= (ord($ret[$i]) ^ ord($hash[$i]));
          }

          return $status === 0;
        }

}