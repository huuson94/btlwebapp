<?php
	class HomeController extends BaseController{
		public function getIndex(){
            $data['albums'] = Album::where('public','=',1)->get();
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
		
		
        public function getSearch(){
        	$key = Input::get('title');
        	// $data= DB::table('images')->where('title','like','%'.$key.'%')
        	// 						  ->orwhereIn('images.album_id',function($query)
        	// 						  {
        	// 						  	$query->select(DB::raw('id'))
        	// 						  		  ->from('albums')
        	// 						  		  ->where('title','like','%'.Input::get('title').'%');
        	// 						  })
        	// 						  ->get();
            $data['albums'] = Album::select('*')->where('title','like','%'.$key.'%')->get();
        	return View::make('frontend/index')->with('data',$data);


//         	SELECT * FROM `images` where images.`title` LIKE '%t%' OR images.album_id IN 
// (SELECT id FROM albums WHERE `title` LIKE '%t%')
        }
        
        public function postDoSignup(){
			App::make('UsersController')->postDoSignUp();
		}
    }
?>