<?php
	class HomeController extends BaseController{
		public function getIndex(){
            $data['albums'] = Album::all();
            foreach($data['albums'] as $index => $album){
                if($album->image->count() >0){
                    $album->setAttribute('sum_like',$album->image->sum('count_like'));
                    $album->setAttribute('sum_share',$album->image->sum('count_share'));
                }else{
                    $data['albums']->forget($index);
                }
            }
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
            
        }
        
        public function postDoSignup(){
			App::make('UsersController')->postDoSignUp();
		}
    }
?>