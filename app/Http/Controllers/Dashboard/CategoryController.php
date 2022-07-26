<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Session;
use Validator;

class CategoryController extends Controller
{
    protected $pagination_num = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $categories = Category::orderBy("id","desc");
       if ($request->has('name'))
       {
          $categories = $categories->where('name', 'like', "%{$request->name}%");
       }
       if ($request->has('isactive') && !empty($request->isactive))
       {
          $categories = $categories->where('is_active', $request->isactive);
       }
       $categories = $categories->paginate($this->pagination_num);

       return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
          'name' => ['required', 'string', 'max:255'],
      ]);
      if ($validator->fails())
        return json_encode(array("sucess"=>false ,"errors"=> $validator->errors()));
      $category = new Category();
      $category->name = $request->name;
      $category->parent_name = $request->pname;
      $category->is_active = $request->isactive;
      $category->save();
      return json_encode(array("sucess"=>true,"sucess_text"=>"Sucessfully Add"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category =  Category::findOrFail($id);
        return view('dashboard.categories.update',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
          'name' => ['required', 'string', 'max:255'],
      ]);
      if ($validator->fails())
        return json_encode(array("sucess"=>false ,"errors"=> $validator->errors()));
      $category = Category::findOrFail($id);
      $category->name = $request->name;
      $category->parent_name = $request->pname;
      $category->is_active = $request->isactive;
      $category->save();
      return json_encode(array("sucess"=>true,"sucess_text"=>"Sucessfully Update"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $category =  Category::findOrFail($id);
      $category->delete();
      Session::put('message', "Sucessfully delete");
      return json_encode(array("sucess"=>true));
    }
}
