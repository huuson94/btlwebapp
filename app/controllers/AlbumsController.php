<?php
class AlbumsController extends BaseController{
    public function getIndex() {
        $data['album_img'] = Album::all();
        return View::make('frontend/index', $data);
    }
    
    public function postSave(){
        $album = new Album;
        var_dump(Input::get('image_description'));die;
        $album->category_id = Input::get('category');
        $album->description = Input::get('description');
        $album->user_id = Session::get('current_user')['id'];
        $album->title = Input::get('title');
        $album->save();
        $upload_folder = "/upload/images/albums/";
        $files = Input::file('path');
        $status = 'success';
        foreach($files as $index => $file){
            if($file->isValid()) {
                $image = new Image;
                $name= $file->getFilename().uniqid().$file->getExtension();
                $file->move(public_path() . $upload_folder,$name);
                $image->user_id = Session::get('current_user')['id'];
                $image->path='public/upload/'.$name;
                $image->title = '';
                $image->description = '';
                $image->category_id = $album->get('category_id');
                $image->album_id = $album->get('id');
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
    }
    
    public function getView($id){
        
    }
}