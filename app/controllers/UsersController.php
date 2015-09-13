<?php
class UsersController extends BaseController{

	public function index(){
        $users = users::all();
        return View::make('backend.index')->with('users',$users);
        
    }
}