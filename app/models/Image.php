<?php

class Image extends Eloquent{
    protected $table = 'images';

    
    public function album(){
        return $this->belongsTo('Album', 'album_id');
    }
    
    
    public function actions(){
        return $this->hasMany('Action', 'post_id')->where('a_type','=',2);
    }
    
    public function post(){
        return $this->belongsTo('Post', 'post_id');
    }
    
    public function comments(){
        return $this->post->hasManyThrough('Comment','Post', 'id', 'post_id')->orderBy('created_at', 'desc');
    }
}