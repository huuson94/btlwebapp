<?php
class AlbumsController extends BaseController{
    
    public function create(){
        return View::make('frontend/albums/create');
    }
    
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
        $datas = Input::all();
        $params = array();
        if(isset($datas['u'])){
            $params['user_id'] = $datas['u'];
        }
        if(isset($datas['title'])){
            $params['title'] = $datas['title'];
        }
        $albums_d = Album::where('public','=','1');
        foreach($params as $key => $param){
            if($key == 'title'){
                $op = 'LIKE';
                $param = "%".$param."%";
            }
            if($key == 'user_id'){
                $op = '=';
            }
            $albums_d = Album::where($key,$op,$param);
        }
        $albums = $albums_d->get();
        if( !empty($params['user_id'])){
            return View::make('frontend/albums/my-images')->with('albums',$albums);
        }else{
            return View::make('frontend/index')->with('albums',$albums);
        }
        
    }
    
}