<?php
class CategoriesController extends BaseController{
    public function getView($id) {
        $data['categories'] = Category::all();
        $data['category'] = Category::where('id', $id)->first();
        $data['album'] = Album::where('category_id', $id)->get();
        return View::make('frontend/categories/view')->with('data', $data);
    }
    
    public function getSearch($title){
        
    }
}