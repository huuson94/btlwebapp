<?php
class Users extends Eloquent {
	protected $table = 'mst_users';

	public function images()
	{
		return $this->hasMany('Image','user_id');

	}
}