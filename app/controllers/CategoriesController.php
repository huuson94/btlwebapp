<?php
class CategoriesController extends BaseController{
    public function getView($id) {
        $data['albums']=Album::where('category_id', $id)->get();
        return View::make('frontend/users/view-images')->with('data',$data);
    }
    
    public function getSearch(){
        echo Input::get('title');
    }
}