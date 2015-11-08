<?php
class AlbumsController extends BaseController{
    
    
    public function store(){
        $data = Input::all();
        $data['is_single'] = 0;
        $album = AlbumsHelper::save($data);
        
        $filesStatus = Input::get('file_status');
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
        return Redirect::to('home/upload');
    }
    
    public function show($id){
        $album = Album::where('id', $id)->first();
        return View::make('frontend/albums/show')->with('album',$album);
    }

    public function index(){
        $params = Input::all();
        $user_id = isset($params['u'])?$params['u']:"";
        if($user_id != ""){
            $albums = Album::where('user_id','=',$user_id)->get();
            return View::make('frontend/users/show-images')->with('albums',$albums);
        }else{
            $albums = Album::all();
            return View::make('frontend/index')->with('albums',$albums);
        }
        
    }
    
}