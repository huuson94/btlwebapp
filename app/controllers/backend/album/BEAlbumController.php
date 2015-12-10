<?php
class BEAlbumController extends BaseController{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
        $sortby = Input::get('sortby');
        $order  = Input::get('order');
        $keyword = Input::get('keyword');
        $option = Input::get('search_opt');

        if($sortby && $option && $keyword && $option == "fullname"){
            $users = User::where('fullname','LIKE',"%$keyword%")->get();
            $users_id = array();
            foreach ($users as $key => $user) {
                $users_id[] = $user->id;
            }
             $albums = Album::whereIn('user_id',$users_id)->orderBy($sortby, $order)->paginate(8);
        }
        elseif($sortby && $option && $keyword && $option == "title"){
            $albums = Album::select('*')->where('title','LIKE','%'.$keyword.'%')->orderBy($sortby, $order)->paginate(5);
        }
        elseif($keyword && $option == "fullname"){
            $users = User::where('fullname','LIKE',"%$keyword%")->get();
            $users_id = array();
            foreach ($users as $key => $user) {
                $users_id[] = $user->id;
            }
             $albums = Album::whereIn('user_id',$users_id)->paginate(8);
        }
        elseif($keyword && $option == "title"){
            $albums = Album::select('*')->where($option,'LIKE','%'.$keyword.'%')->paginate(5);
        }
        elseif($sortby && $order){
            $albums = Album::select('*')->orderBy($sortby, $order)->paginate(8);
        }else{
        $albums = Album::select('*')->paginate(5);
    }
            return View::make('backend.album.index',compact('albums', 'sortby', 'order','keyword','option'));
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
        $album = Album::find($id);
        $album->getEntry()->delete();
        foreach($album->images as $image){
            $image->delete();
        }
        $album->delete();
        Session::flash('status',true);
        Session::flash('messages',array('Đã xóa ảnh'));
        return Redirect::route('admin.album.index');
        
    }


}