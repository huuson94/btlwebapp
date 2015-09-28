<?php
	class HomeController extends BaseController{
		public function getIndex(){
            $data['albums'] = Album::all();
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
        	// $images1 = Image::select('*')->where('title','like','%'.$key.'%')->get()->toArray();
        	// $albums = Album::select('id')->where('title','like','%'.$key.'%')->get();
        	// $images2= array();
        	// // if($album_id){
        	// foreach($albums as $index => $album){
        	// 	$images2 = Image::select('*')->where('album_id','=',$album->id)->get()->toArray();
        	// }
        	// $data = "";
        	// return View::make('frontend/index')->with('data',array_merge($images1, $images2));
        	$data= DB::table('images')->where('title','like','%'.$key.'%')
        							  ->orwhereIn('images.album_id',function($query)
        							  {
        							  	$query->select(DB::raw('id'))
        							  		  ->from('albums')
        							  		  ->where('title','like','%'.Input::get('title').'%');
        							  })
        							  ->get();
        	return View::make('frontend/index')->with('data',$data);


//         	SELECT * FROM `images` where images.`title` LIKE '%t%' OR images.album_id IN 
// (SELECT id FROM albums WHERE `title` LIKE '%t%')
        }
        
        public function postDoSignup(){
			App::make('UsersController')->postDoSignUp();
		}
    }
?>