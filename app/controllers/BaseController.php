<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
    
    public function __construct() {
        $data['categories'] = Category::all();
        View::share('categories', $data['categories']);
        if(Session::has('current_user')){
        	$current_user =  User::find(Session::get('current_user'));
        	if($current_user){
	            $data['user_name'] =$current_user->name;
	            View::share('user_name', $data['user_name']);
            }
        }
    }

}
