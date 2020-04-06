<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    private $created_at;
    private $updated_at;
    private $id_user;
    private $id_post;
    private $description;

    public function getCreated_at() {
        return $this->created_at;
    }

    public function setCreated_at($created_at) {
        $this->created_at=$created_at;
    }

    public function getUpdated_at() {
        return $this->updated_at;
    }

    public function setUpdated_at($updated_at) {
        $this->updated_at=$updated_at;
    }

    public function getUser() {
        return $this->id_user;
    }

    public function setUser($user) {
       $this->id_user = $user;
    }

    public function getid_post() {
        return $this->id_post;
    }

    public function setid_post($id_post) {
        $this->id_post=$id_post;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description=$description;
    }

   
    
    public function saveComment() {

     
        $user = DB::table('comment')->insert(array(
            'created_at' => $this->getCreated_at(),
            'updated_at' => $this->getUpdated_at(),
            'id_user' => $this->getUser(),
            'id_post' => $this->getid_post(),
            'description' => $this->getDescription(),
        ));


        return $user;
    }
}
