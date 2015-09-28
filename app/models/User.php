<?php
class User extends Eloquent {
	protected $table = 'mst_users';
    
    public function image(){
        return $this->hasMany('Image','user_id');
    }
    
    public function album(){
        return $this->hasMany('Album','user_id');
    }
}