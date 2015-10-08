<?php

class Image extends Eloquent{
    protected $table = 'images';

    
    public function album(){
        return $this->belongsTo('Album', 'album_id');
    }
    
    public function comments(){
        return $this->hasMany('Comment', 'post_id')->where('type','=',2);
    }
    
}