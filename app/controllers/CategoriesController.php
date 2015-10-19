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

    public function index()
    {
        // if($this->checkIsAdmin()) {
        //     $users = User::all();
        //     return View::make('backend.users.list')->with('users',$users);
        // }else{
        //     return Redirect::to('home/index');
        // }
        $categories = Category::all();
        return View::make('backend.category.list')->with('categories',$categories);
    }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
      {
        return View::make('backend.category.create');
      }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
      {
      	$input = array(
            'title' => Input::get('title')
        );
        $rule = array(
            'title'              => 'min:2|required'
        );
        $validator = \Validator::make($input,$rule);
        if($validator->fails()){
            return Redirect::route('admin-category.create', $id)
            ->withInput()
            ->withErrors($validator)
            ->with('message', 'There were validation errors.');
        }
        else{
            $category = new Category;

            $title = Input::get('title');

            $category->title = $title;

            $category->save();
            return Redirect::route('admin-category.index');
        }
        
      }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
      {
        //
      }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $category = Category::find($id);
    if (is_null($category))
    {
        return Redirect::route('admin-category.index');
    }
        return View::make('backend.category.edit', compact('category'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    $input = array(
            'title' => Input::get('title')
        );
        $rule = array(
            'title'              => 'min:2|required'
        );
        $validator = \Validator::make($input,$rule);
        if($validator->fails()){
            return Redirect::route('admin-category.edit', $id)
            ->withInput()
            ->withErrors($validator)
            ->with('message', 'There were validation errors.');
        }
        else{
            $category = Category::find($id);

            $title = Input::get('title');

            $category->title = $title;

            $category->save();
            return Redirect::route('admin-category.index');
        }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    //
        Category::find($id)->delete();
        return Redirect::route('admin-category.index');
  }
}