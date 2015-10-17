<?php
class UsersController extends BaseController{
    
    private function checkLogged(){
        if(Session::has('current_user')){
            return true;
        }else{
            return false;
        }
    }
    
    
    public function postAjaxComment(){
        if(Input::get('commentContent')){
            $data=Input::all();
            $new = new Comment;
            $new->post_id=$data['post_id'];
            $new->user_id=Session::get('current_user');
            $new->type = $data['type'];
            $new->content=$data['commentContent'];
            $new->save();
            $new = $new->toArray();
            $new['user_name'] = User::where('id','=',$new['user_id'])->get()->first()->name;
            echo json_encode($new);
        }else{
            echo json_encode('false');
        }
    }
    
    public function postAjaxFollow(){
        if(!empty(Input::get('user_id')) && !empty(Input::get('current_user'))){
            if(true){ 
                $relation = new Relation;
                $relation->user1_id = Input::get('current_user');
                $relation->user2_id = Input::get('user_id');
                $relation->type = 1;
                $relation->save();
                echo 'true';
            }
        }else{
            echo 'false';
        }
    }
    
    public function postAjaxUnfollow(){
        if(!empty(Input::get('user_id')) && !empty(Input::get('current_user'))){
            if(true){ 
                $relation = Relation::where('user1_id','=',Input::get('current_user'))->where('user2_id','=',Input::get('user_id'))->get()->first();
                if($relation->delete() == 1) echo 'true';
            }
        }else{
            echo 'false';
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
        if(Session::has('current_user')){
            Session::flush();
            return Redirect::to('/home');
        }
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
            $data['albums']=Album::where('user_id',Session::get('current_user'))->get();
            return View::make('frontend/users/view-images')->with('data',$data);
        }else{
            return Redirect::to('home/index');
        }
    }
    
    public function postDoLogin(){
        if(Input::get('account') && Input::get('password')){
            $data=Input::all();
            $user=User::where('account',$data['account'])->where('password',$data['password'])->first();
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
    
    public function postSignup(){
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
					'name' => 'required|min:6',
					'account' => 'required|min:6',
					'password' => 'required|min:6',
                    'password_confirm' => 'same:password',
					'email' => 'email|required',
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
				Session::flash('signup_status', false);
                return Redirect::to('user/signup');
			}else{
				$user=User::where('account',$data['account'])->first();
				if($user){
                    Session::flash('signup_status', false);
					return Redirect::to('home/index');
				} else{
					$new= new User;
					$new->name=$data['name'];
					$new->account=$data['account'];
					$new->password=$data['password'];
					$new->email=$data['email'];
					$new->phone=$data['phone'];
					$new->address=$data['address'];
                    $status = $new->save();
                    Session::flash('signup_status', $status);
                    if($status == true){
                        Session::set("current_user", $new->id);
                        $new_notification = new Notification;
                        $new_notification->user_id = $new->id;
                        $new_notification->save();
                    }
					return Redirect::to('home/index')->with('user',$new);
				}
			}
		}
    public function postAjaxLogin(){
        if(Input::get('account') && Input::get('password')){
            $data=Input::all();
            $user=User::where('account',$data['account'])->where('password',$data['password'])->first();
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
				$user=User::where('account',$data['account'])->first();
				if($user){
					echo 'fail';
				} else{
					$new= new User;
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