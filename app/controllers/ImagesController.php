<?php
class ImagesController extends BaseController{
    public function postSave(){
//      $status =   $this->saveImagesToDB();
//        
        $categories = Input::get('category');
        $titles = Input::get('title');
        $descriptions = Input::get('description');
        $files = Input::file('path');
        $upload_folder = "/upload/images/";
        $status = 'success';
        foreach($files as $index => $file){
            if($file->isValid()) {
                $image = new Image;
                $name= $file->getFilename().uniqid().$file->getExtension();
                $file->move(public_path() . $upload_folder,$name);
                $image->user_id = Session::get('current_user')['id'];
                $image->path='public/upload/'.$name;
                $image->title = $titles[$index];
                $image->description = $descriptions[$index];
                $image->category_id = $categories[$index];
                $image->album_id = 0;
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
        $image = Image::where('id', $id)->first();
        return View::make('frontend/images/view')->with('image',$image);
    }
}
