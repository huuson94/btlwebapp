<?php
class BEUsersController extends BaseController{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
        $sortby = Input::get('sortby');
        $order  = Input::get('order');
        $option = Input::get('search_opt');
        $keyword = Input::get('keyword');
        if($sortby && $order && $keyword && $option){
            $users = User::select('*')->where($option,'LIKE','%'.$keyword.'%')->orderBy($sortby, $order)->paginate(5);
        }
        elseif($sortby && $order){

            $users = User::select('*')->orderBy($sortby, $order)->paginate(5);
        }
        elseif($keyword && $option){
            $users = User::select('*')->where($option,'LIKE','%'.$keyword.'%')->paginate(5);
        }
        else{
        $users = User::select('*')->paginate(5);
        }

            return View::make('backend.users.index',compact('users', 'sortby', 'order','keyword','option'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
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
        //
        $user = User::find($id);
        if (is_null($user)) {
            return Redirect::route('admin.user.index');
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
        //

        if(BEUsersHelper::validateUser()){
            $user = User::find($id);

            $name = Input::get('name');
            $phone = Input::get('phone');
            $is_admin = Input::get('is_admin');
            $about = Input::get('address');

            $user->name = $name;
            $user->phone = $phone;
            $user->address = $about;
            $user->is_admin = $is_admin;

            $user->save();
            Session::flash('status',true);
            return Redirect::route('admin.user.index');
        }
        else{
            Session::flash('status',false);
            return Redirect::route('admin.user.edit', $id)
                            ->withInput();
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
        $user = User::find($id);
        if(BEUsersHelper::isCurrentUser($id)){
            Session::flush('current_user');
        }
        foreach($user->albums as $album){
            $album->delete();
        }

        $user->delete();
        Session::flash('status',true);
        Session::flash('messages',array('Đã xóa user'));
        return Redirect::route('admin.user.index');
    }


}