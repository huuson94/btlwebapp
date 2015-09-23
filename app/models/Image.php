<?php

class Image extends Eloquent{
    protected $table = 'images';

    public function users()
    {
    	return $this->belongsTo('Users','user_id');

    }

    public function albums()
    {
    	return $this->belongsTo('Album','album_id');

    }
}