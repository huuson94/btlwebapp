<?php
class CategoriesController extends BaseController{
    public function getView($id) {
        $data['category'] = Category::where('id', $id)->first();
        $data['albums'] = Album::where('category_id', $id)->where('public', '=', 1)->get();
        return View::make('frontend/categories/view')->with('data', $data);

    }
    
    public function getSearch(){
        echo Input::get('title');
    }
}