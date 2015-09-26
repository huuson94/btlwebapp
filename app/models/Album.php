<?php

class Album extends Eloquent{
    protected $table = 'albums';
    
    public function user(){
        return $this->belongsTo('User','user_id');
    }
    
    public function image(){
        return $this->hasMany('Image', 'album_id');
    }

    public function category(){
    	return $this->belongsTo('Category','category_id');
    }
    
}