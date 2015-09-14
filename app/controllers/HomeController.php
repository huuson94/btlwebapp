<?php
	class HomeController extends BaseController{
		public function getIndex(){
            $data = array();
			return View::make('frontend/index')->with('data',$data);
		}
		public function getUpload(){
			return View::make('frontend/upload');
		}
		public function getDetail($id){
			//$id=Input::get('v');
			return View::make('frontend/detail');
		}
		public function postDoLogin(){
            echo App::make('UsersController')->postDoLogin();		
		
		}
		public function getLogout(){
			Session::flush();
			return Redirect::to('/home');
		}
		
        public function postDoSignup(){
			App::make('UsersController')->postDoSignUp();
		}
    }
?>