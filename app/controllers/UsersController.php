<?php
class UsersController extends BaseController{
    public function getLogin(){
        
        if(Session::get('current_user')){
            return View::make('frontend/index');
        }
        return View::make('frontend/users/login');
    }
    
    public function getUpload(){
        return View::make('frontend/users/upload');
    }
    
    public function getViewImage(){
        return View::make('frontend/users/view-image');
    }
    public function postDoLogin(){
        if(Input::get('account') && Input::get('password')){
            $data=Input::all();
            $user=Users::where('account',$data['account'])->where('password',$data['password'])->first();
            if($user){
                Session::put('current_user',$user->toArray());
                return 'success';
            } else{
                return 'fail';
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
					echo 'success';
				}
			}
		}
        
}