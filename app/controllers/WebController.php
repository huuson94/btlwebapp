<?php
	class WebController extends BaseController{
		public function getIndex(){
			return View::make('frontend/index');
		}
		public function postDoLogin(){
			$data=Input::all();
			$user=Users::where('nick_name',$data['nick_name'])->where('password',$data['password'])->first();
			if($user){
				Session::put('my_user',$user->toArray());
				echo 'success';
			} else{
				echo 'fail';
			}			
		}
		public function getLogout(){
			Session::flush();
			return Redirect::to('/home');
		}
		public function postDoSignin(){
			$data=Input::all();
			$validator = Validator::make(
				array(
					'name' => $data['name'],
					'nick_name' => $data['nick_name'],
					'password' => $data['password'],
					'email' => $data['email'],
					'phone' => $data['phone'],
					'address' => $data['address'],
					),
				array(
					'name' => 'required|min:5',
					'nick_name' => 'required|min:5',
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
				$user=Users::where('nick_name',$data['nick_name'])->first();
				if($user){
					echo 'fail';
				} else{
					$new= new Users;
					$new->name=$data['name'];
					$new->nick_name=$data['nick_name'];
					$new->password=$data['password'];
					$new->email=$data['email'];
					$new->phone=$data['phone'];
					$new->address=$data['address'];
                    $new->join_at = "0000/00/00";
					$new->save();
					echo 'success';
				}
			}

			
		}
	}
?>