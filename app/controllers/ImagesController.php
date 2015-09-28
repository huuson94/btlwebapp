<?php
class ImagesController extends BaseController{
    public function postSave(){
//      $status =   $this->saveImagesToDB();
        $files = Input::file('path');
        $filesStatus = Input::get('file_status');
        $status = 'success';
        foreach($files as $index => $file){
            if($file->isValid() && $filesStatus[$index] != 0) {
                $album = $this->saveAlbum($index);
                if($album){
                    if(!$this->saveImage($index, $album->id)){
                        $status = 'false';
                        break;
                    }
                }else{
                    $status = 'false';
                    break;
                }
                
            }
        }
        Session::flash('status',$status);
        return Redirect::to('user/upload');

    }
    
    private function saveAlbum($index){
        $categories = Input::get('category');
        $publices = Input::get('public');
        $titles = Input::get('title');
        $descriptions = Input::get('description');
        $files = Input::file('path');
        $file = $files[$index];
        if($file->isValid()) {
            $album = new Album;
            $album->category_id = $categories[$index];
            $album->user_id = Session::get('current_user');
            $album->public = $publices[$index];
            $album->title = $titles[$index];
            $album->description = "";
            if($album->save() == FALSE){
                return false;
            }else{
                return $album;
            }
        }
    }
    
    private function saveImage($index, $album_id){
        $files = Input::file('path');
        $captions = Input::get('caption');
        $file = $files[$index];
        $name = $file->getFilename().uniqid().".".$file->getClientOriginalExtension();
        $upload_folder = "upload/images/". uniqid(date('ymdHisu'));
        $image = new Image;
        $image->path = $upload_folder."/".$name;
        $image->album_id = $album_id;
        $image->caption = $captions[$index];
        $image->count_like = $image->count_share = $image->count_unlike = 0;
        
        $file->move(public_path() ."/". $upload_folder,$name);
        if($image->save() == false){
            return false;
        }else{
            return $image;
        }
    }
    
    public function getView($id){
        
    }
}
