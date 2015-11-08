<?php
define('AVATAR_PATH', 'upload/avatars');
define('DEFAULT_AVATAR_PATH',"public/upload/avatars/default/avatar.jpg");
class UsersController extends BaseController {
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        if (Session::get('current_user')) {
            return View::make('frontend/index');
        }
        return View::make('frontend/users/signup');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        if ($this->validateSignUpInfo()) {
            Session::flash('signup_status', false);
            return Redirect::to('signup');
        } else {
            if (!$this->isExistedUser()) {
                $new = $this->saveNewUser();
                if ($this->saveNewUser()) {
                    Session::flash('signup_status', true);
                    Session::set("current_user", $new->id);
                    return Redirect::to('home');
                } else {
                    return Redirect::to('signup');
                }
            } else {
                return Redirect::to('signup');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        // $user = User::select('*')->where('id','=',$id)->first();
        // return View::make('backend.users.edit')->with('user',$user);
        $user = User::find($id);
        if (is_null($user)) {
            return Redirect::route('admin.index');
        }
        return View::make('backend.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
       
        $input = array(
            'password' => Input::get('password'),
            'password_confirmation' => Input::get('password_confirmation'),
            'name' => Input::get('name'),
            'address' => Input::get('address'),
            'phone' => Input::get('phone'),
            'is_admin' => Input::get('is_admin'),
        );
        $rule = array(
            'password' => 'min:4|confirmed',
            'password_confirmation' => 'min:4',
            'name' => 'required',
            'address' => 'required'
        );
        $validator = \Validator::make($input, $rule);
        if ($validator->fails()) {
            return Redirect::route('admin.edit', $id)
                            ->withInput()
                            ->withErrors($validator)
                            ->with('message', 'There were validation errors.');
        } else {
            $user = User::find($id);

            $name = Input::get('name');
            $address = Input::get('address');
            $phone = Input::get('phone');
            $is_admin = Input::get('is_admin');

            $user->name = $name;
            $user->address = $address;
            $user->phone = $phone;
            $user->is_admin = $is_admin;

            $user->save();
            return Redirect::route('admin.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
        User::find($id)->delete();
        return Redirect::route('admin.index');
    }

    private function checkLogged() {
        if (Session::has('current_user')) {
            return true;
        } else {
            return false;
        }
    }

    public function getViewDetails() {
        if ($this->checkLogged()) {
            $data['albums'] = Album::where('user_id', Session::get('current_user'))->get();
            $info = User::find(Session::get('current_user'));
            return View::make('frontend/users/details')->with('data', $data)->with('info', $info);
        } else {
            return Redirect::to('home/index');
        }
    }

//Edit từ trang details 
    public function getEdit($id) {
        $user = User::find(Session::get('current_user'));
        return View::make('frontend/users/edit')->with('user', $user);
    }

    public function DetailsUpdate($id) {
        $input = array(
            'name' => Input::get('name'),
            'address' => Input::get('address'),
            'phone' => Input::get('phone'),
        );
        $rule = array(
            'name' => 'required',
            'address' => 'required'
        );
        $validator = \Validator::make($input, $rule);
        if ($validator->fails()) {
            return Redirect::to('user/edit/' . $id)
                            ->withInput()
                            ->withErrors($validator)
                            ->with('message', 'There were validation errors.');
        } else {
            $user = User::find($id);

            $name = Input::get('name');
            $address = Input::get('address');
            $phone = Input::get('phone');

            $user->name = $name;
            $user->address = $address;
            $user->phone = $phone;

            $user->save();
        }
    }

    public function postAjaxComment() {
        if (Input::get('commentContent')) {
            $data = Input::all();
            $new = new Comment;
            $new->post_id = $data['post_id'];
            $new->user_id = Session::get('current_user');
            $new->p_type = $data['type'];
            $new->content = $data['commentContent'];
            $new->save();
            $new = $new->toArray();
            $new['user_name'] = User::where('id', '=', $new['user_id'])->get()->first()->name;
            echo json_encode($new);
        } else {
            echo json_encode('false');
        }
    }

    public function postAjaxFollow() {
        if (!empty(Input::get('user_id')) && !empty(Input::get('current_user'))) {
            if (true) {
                $relation = new Relation;
                $relation->user1_id = Input::get('current_user');
                $relation->user2_id = Input::get('user_id');
                $relation->type = 1;
                $relation->save();
                echo 'true';
            }
        } else {
            echo 'false';
        }
    }

    public function postAjaxUnfollow() {
        if (!empty(Input::get('user_id')) && !empty(Input::get('current_user'))) {
            if (true) {
                $relation = Relation::where('user1_id', '=', Input::get('current_user'))->where('user2_id', '=', Input::get('user_id'))->get()->first();
                if ($relation->delete() == 1)
                    echo 'true';
            }
        }else {
            echo 'false';
        }
    }

    public function getLogin() {

        if (Session::get('current_user')) {
            return View::make('frontend/index');
        }
        return View::make('frontend/users/login');
    }

    public function getUpload() {
        if ($this->checkLogged()) {
            return View::make('frontend/users/upload');
        } else {
            return Redirect::to('home/index');
        }
    }

    public function getViewImages() {
        if ($this->checkLogged()) {
            $data['albums'] = Album::where('user_id', Session::get('current_user'))->get();
            return View::make('frontend/users/view-images')->with('data', $data);
        } else {
            return Redirect::to('home/index');
        }
    }

//    public function getSignup() {
//
//        if (Session::get('current_user')) {
//            return View::make('frontend/index');
//        }
//        return View::make('frontend/users/signup');
//    }

//    public function postSignup() {
//        if ($this->validateSignUpInfo()) {
//            Session::flash('signup_status', false);
//            return Redirect::to('user/signup');
//        } else {
//            if(!$this->isExistedUser()){
//                if($this->saveNewUser()){
//                    return Redirect::to('home');
//                }else{
//                    return Redirect::to('user/signup');
//                }
//            }else{
//                return Redirect::to('user/signup');
//            }
//        }
//    }
//    
    private function isExistedUser(){
        $data = Input::all();
        $user1 = User::where('account', $data['account'])->first();
        $user2 = User::where('email', $data['email'])->first();
        $errors_message = array();
        $status = false;
        if ($user1) {
            Session::flash('signup_status', false);
            $errors_message[] = "UserName is existed";
            $status =  true;
        }
        if ($user2) {
            Session::flash('signup_status', false);
            $errors_message[] = 'Email existed';
            $status =  true;
        }
        Session::flash('errors_message', $errors_message);
        return $status;
    }
    
    private function validateSignUpInfo(){
        $data = Input::all();
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
                    'phone' => 'numeric',
                    )
        );
        if($validator->fails()){
            Session::flash('signup_status', false);
            Session::flash('errors_message',$validator->messages());
        }
    }

    private function saveNewUser(){
        $data = Input::all();
        $upload_folder = AVATAR_PATH .'/'. uniqid(date('ymdHisu'));
        $new = new User;
        $new->name = $data['name'];
        $new->account = $data['account'];
        $new->password = $data['password'];
        $new->email = $data['email'];
        $new->phone = $data['phone'];
        $new->address = $data['address'];
        if ($data['avatar']) {
            $name = $data['avatar']->getFilename() . uniqid() . "." . $data['avatar']->getClientOriginalExtension();
            $new->avatar = 'public/'.$upload_folder . "/" . $name;
            $data['avatar']->move(public_path() . "/" . $upload_folder, $name);
        } else {
            $new->avatar = DEFAULT_AVATAR_PATH;
        }
        if ($new->save()) {
            return $new;
        }else{
            return false;
        }
    }
    
   
//    public function postAjaxSignup() {
//        $data = Input::all();
//        $validator = Validator::make(
//                        array(
//                    'password' => $data['password'],
//                    'password_confirm' => $data['password_confirm'],
//                    'account' => $data['account'],
//                    'name' => $data['name'],
//                    'address' => $data['address'],
//                    'phone' => $data['phone'],
//                    'email' => $data['email'],
//                    'is_admin' => 0
//                        ), array(
//                    'name' => 'required|min:5',
//                    'account' => 'required|min:5',
//                    'password' => 'required|min:5',
//                    'password_confirm' => 'same:password',
//                    'email' => 'email|required|min:5',
//                    'phone' => 'numeric|required',
//                    'address' => 'required',
//                        )
//                        // array(
//                        // 	'required' => 'Yêu cầu bắt buộc.',
//                        // 	//'min:5' => 'Tối thiểu 5 ký tự',
//                        // 	)
//        );
//        if ($validator->fails()) {
//            $messages = $validator->messages();
//            // $messages
//            echo 'not valid info';
//        } else {
//            $user = User::where('account', $data['account'])->first();
//            if ($user) {
//                echo 'fail';
//            } else {
//                $new = new User;
//                $new->name = $data['name'];
//                $new->account = $data['account'];
//                $new->password = $data['password'];
//                $new->email = $data['email'];
//                $new->phone = $data['phone'];
//                $new->address = $data['address'];
//                $new->save();
//                Session::put('current_user', $new->toArray());
//                echo 'success';
//            }
//        }
//    }

    private function checkIsAdmin() {
        $currrent_user_id = Session::get('current_user');
        $current_user = User::find($currrent_user_id);
        if ($current_user->is_admin == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        if ($this->checkIsAdmin()) {
            $users = User::all();
            return View::make('backend.users.list')->with('users', $users);
        } else {
            return Redirect::to('home/index');
        }
    }

    
}
