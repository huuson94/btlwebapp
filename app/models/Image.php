<?php

class Image extends Eloquent{
    protected $table = 'images';
    
    public function user(){
        return $this->belongsTo('User','user_id');
    }
}