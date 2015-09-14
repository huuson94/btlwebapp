<?php
class ImagesController extends BaseController{
    public function postSave(){
        
    }
    
    public function getView($id){
        $image = Image::where('id', $id)->first();
        return View::make('frontend/images/view')->with('image',$image);
    }
}
