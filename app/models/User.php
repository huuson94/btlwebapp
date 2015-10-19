<?php
class User extends Eloquent {
	protected $table = 'mst_users';
    
    public function image(){
        return $this->hasMany('Image','user_id');
    }
    
    public function album(){
        return $this->hasMany('Album','user_id');
    }

    
    
    public function follow($user2_id){
        $relation = Relation::where('user1_id', '=', $this->id)->where('user2_id','=', $user2_id)->get()->first();
        if($relation) return $relation->type;
        else return 0;
    }
}