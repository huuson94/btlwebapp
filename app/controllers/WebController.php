<?php
	class WebController extends BaseController{
		public function getIndex(){
			return View::make('frontend/index');
		}
		public function postDoLogin(){
			$data=Input::all();
			$user=Users::where('account',$data['account'])->where('password',$data['password'])->first();
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
					'account' => $data['account'],
					'password' => $data['password'],
					'email' => $data['email'],
					'phone' => $data['phone'],
					'address' => $data['address'],
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
?>