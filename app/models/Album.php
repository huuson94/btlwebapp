<?php

class Album extends Eloquent{
    protected $table = 'albums';

    public function images()
	{
		return $this->hasMany('Image','album_id');

	}
}