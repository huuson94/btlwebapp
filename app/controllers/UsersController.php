<?php
class UsersController extends BaseController{
    
    private function checkLogged(){
        if(Session::has('current_user')){
            return true;
        }else{
            return false;
        }
    }


    public function getLogin(){
        
        if(Session::get('current_user')){
            return View::make('frontend/index');
        }
        return View::make('frontend/users/login');
    }
    
    public function getList(){
        $users = users::all();
        return View::make('backend.users.list')->with('users',$users);
        
    }
    
    public function getLogout() {
        Session::flush();
        return Redirect::to('/home');
    }
    
    public function getUpload(){
        if($this->checkLogged()){
            return View::make('frontend/users/upload');
        }else{
            return Redirect::to('home/index');
        }
        
    }
    
    public function getViewImages(){
        if($this->checkLogged()){
            $data['images']=Image::where('user_id',Session::get('current_user'));
            $data['albums']=Album::where('user_id',Session::get('current_user'));
            return View::make('frontend/users/view-images', $data);
        }else{
            return Redirect::to('home/index');
        }
    }
    
    public function postDoLogin(){
        if(Input::get('account') && Input::get('password')){
            $data=Input::all();
            $user=Users::where('account',$data['account'])->where('password',$data['password'])->first();
            if($user){
                Session::put('current_user',$user->id);
                return Redirect::to('home/index')->with('user', $user);
            } else{
                return Redirect::to('home/index');
            }			
        }
    }
       
    public function getSignup(){
        
        if(Session::get('current_user')){
            return View::make('frontend/index');
        }
        return View::make('frontend/users/signup');
    }
    
    public function postDoSignup(){
			$data=Input::all();
			$validator = Validator::make(
				array(
                    'password' => $data['password'],
                    'password_confirm' => $data['password_confirm'],
                    'account' => $data['account'],
					'name' => $data['name'],
					'address' => $data['address'],
                    'phone' => $data['phone'],
					'email' => $data['email'],
                    'is_admin' => 0
					),
				array(
					'name' => 'required|min:5',
					'account' => 'required|min:5',
					'password' => 'required|min:5',
                    'password_confirm' => 'same:password',
					'email' => 'email|required|min:5',
					'phone' => 'numeric|required',
					'address' => 'required',
					)
				// array(
				// 	'required' => 'Yêu cầu bắt buộc.',
				// 	//'min:5' => 'Tối thiểu 5 ký tự',
				// 	)
				);
			if($validator->fails()){
				$messages = $validator->messages();
				// $messages
				echo json_encode($messages);
			}else{
				$user=Users::where('account',$data['account'])->first();
				if($user){
					return Redirect::to('home/index');
				} else{
					$new= new Users;
					$new->name=$data['name'];
					$new->account=$data['account'];
					$new->password=$data['password'];
					$new->email=$data['email'];
					$new->phone=$data['phone'];
					$new->address=$data['address'];
                    $new->save();
					return Redirect::to('home/index')->with('user',$new);
				}
			}
		}
    public function postAjaxLogin(){
        if(Input::get('account') && Input::get('password')){
            $data=Input::all();
            $user=Users::where('account',$data['account'])->where('password',$data['password'])->first();
            if($user){
                Session::put('current_user',$user->id);
                echo 'success';
            } else{
                echo 'fail';
            }			
        }
    }
    public function postAjaxSignup(){
        $data=Input::all();
			$validator = Validator::make(
				array(
                    'password' => $data['password'],
                    'password_confirm' => $data['password_confirm'],
                    'account' => $data['account'],
					'name' => $data['name'],
					'address' => $data['address'],
                    'phone' => $data['phone'],
					'email' => $data['email'],
                    'is_admin' => 0
					),
				array(
					'name' => 'required|min:5',
					'account' => 'required|min:5',
					'password' => 'required|min:5',
                    'password_confirm' => 'same:password',
					'email' => 'email|required|min:5',
					'phone' => 'numeric|required',
					'address' => 'required',
					)
				// array(
				// 	'required' => 'Yêu cầu bắt buộc.',
				// 	//'min:5' => 'Tối thiểu 5 ký tự',
				// 	)
				);
			if($validator->fails()){
				$messages = $validator->messages();
				// $messages
				echo 'not valid info';
			}else{
				$user=Users::where('account',$data['account'])->first();
				if($user){
					echo 'fail';
				} else{
					$new= new Users;
					$new->name=$data['name'];
					$new->account=$data['account'];
					$new->password=$data['password'];
					$new->email=$data['email'];
					$new->phone=$data['phone'];
					$new->address=$data['address'];
                    $new->save();
                    Session::put('current_user',$new->toArray());
					echo 'success';
				}
			}
    }
}