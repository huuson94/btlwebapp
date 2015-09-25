<?php

class Album extends Eloquent{
    protected $table = 'albums';
    
    public function user(){
        return $this->belongsTo('User','user_id');
    }
    
    public function image(){
        return $this->hasMany('Image', 'album_id');
    }
    
}