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
        $album->save();
        $upload_folder = "upload/albums/". uniqid(date('ymdHisu'));
        $files = Input::file('path');
        $images_description = Input::get('image_description');
        $status = 'success';
        foreach($files as $index => $file){
            if($file->isValid()) {
                $image = new Image;
                $name= $file->getFilename().uniqid().".".$file->getClientOriginalExtension();
                $file->move(public_path() ."/". $upload_folder,$name);
                $image->user_id = Session::get('current_user');
                $image->path= $upload_folder.$name;
                $image->title = '';
                $image->description = $images_description[$index];
                $image->category_id = $album->category_id;
                $image->album_id = $album->id;
                $image->count_share = 0;
                $image->count_like = 0;
                $image->count_unlike = 0;
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
        
    }
}