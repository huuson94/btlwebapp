<?php
class BEImageController extends BaseController{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
        $keyword = Input::get('keyword');
        if($keyword){
            $users = User::where('name','LIKE',"%$keyword%")->get();
            $users_id = array();
            foreach ($users as $key => $user) {
                $users_id[] = $user->id;
            }
             $images = Image::whereIn('user_id',$users_id)->paginate(5);
        }
       
        else{
        $images = Image::select('*')->paginate(5);
        }
        return View::make('backend.image.index',compact('images','keyword'));
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //

        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
        $image = Image::find($id);
        $image->delete();
        Session::flash('status',true);
        Session::flash('messages',array('Đã xóa ảnh'));
        return Redirect::route('admin.image.index');
        
    }


}