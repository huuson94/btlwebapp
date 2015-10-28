<?php
class AlbumsController extends BaseController{
    public function getIndex() {
        $data['album_img'] = Album::all();
        return View::make('frontend/index', $data);
    }
    
    public function postSave(){
        $album = new Album;
        $album->category_id = Input::get('category');
        $album->description = Input::get('description');
        $album->user_id = Session::get('current_user');
        $album->title = Input::get('title');
        $album->public = Input::get('public');
        $album->is_single = 0;
        $filesStatus = Input::get('file_status');
        $album->save();
        $upload_folder = "upload/albums/". uniqid(date('ymdHisu'));
        $files = Input::file('path');
        $captions = Input::get('caption');
        $status = 'success';
        foreach($files as $index => $file){
            if($file->isValid() && $filesStatus[$index] != 0) {
                $image = new Image;
                $name= $file->getFilename().uniqid().".".$file->getClientOriginalExtension();
                $file->move(public_path() ."/". $upload_folder,$name);
                $image->path= $upload_folder."/".$name;
                $image->caption = $captions[$index];
                $image->album_id = $album->id;
                $status = $image->save();
                if($status == FALSE){
                    $status = 'fail';
                    break;
                }
            }
        }
        Session::flash('status',$status);
        return Redirect::to('user/upload');
    }
    
    public function getView($id){
        $album = Album::where('id', $id)->first();
        return View::make('frontend/albums/view')->with('album',$album);
    }

    public function index()
    {
        
        $sortby = Input::get('sortby');
        $order = Input::get('order');
        if ($sortby && $order) {
            $albums = Album::select('*')->orderBy($sortby, $order)->paginate(10);
        }else {
            $albums = Album::paginate(10);
        }
            return View::make('backend.album.list', compact('albums', 'sortby', 'order'));
    }
}