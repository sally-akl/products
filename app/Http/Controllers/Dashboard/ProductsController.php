<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Session;
use Validator;


class ProductsController extends Controller
{
    protected $pagination_num = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $products = Product::with("category")->orderBy("id","desc");
      if ($request->has('name'))
      {
          $products =   $products->where('name', 'like', "%{$request->name}%");
      }
      if ($request->has('description') && !empty($request->description))
      {
         $products = $products->where('description', 'like', "%{$request->description}%");
      }
      if ($request->has('category') && !empty($request->category))
      {
         $products = $products->where('category_id', $request->category);
      }
      $products =   $products->paginate($this->pagination_num);

      return view('dashboard.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.products.create');
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
          'picture'=> ['image','mimes:jpeg,png,jpg','max:5000'],
          'category' => ['required'],
      ]);
      if ($validator->fails())
        return json_encode(array("sucess"=>false ,"errors"=> $validator->errors()));
      $product = new Product();
      $product->name = $request->name;
      $product->description = $request->description;
      $product->category_id = $request->category;

      if($request->has("picture"))
      {
        $photo = $request->picture;
        $photo_name = md5(rand(1,1000).time()).'.'.$photo->getClientOriginalExtension();
        $photo->move(public_path('/uploads/'), $photo_name);
        $product->picture = $photo_name;
      }
      $product->save();

      if($request->has("tags"))
      {
        $request->tags = implode(', ', array_column(json_decode($request->tags), 'value'));
        $request->tags = explode(",",$request->tags);
        $tags = array();
        foreach($request->tags as $tag)
        {
          $tags[] = array("name"=>$tag);
        }

        $product->productTags()->createMany($tags);
      }


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
      $product =  Product::findOrFail($id);
      return view('dashboard.products.update',compact('product'));
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
          'picture'=> ['image','mimes:jpeg,png,jpg','max:5000'],
          'category' => ['required'],
      ]);
      if ($validator->fails())
        return json_encode(array("sucess"=>false ,"errors"=> $validator->errors()));
      $product =  Product::findOrFail($id);
      $product->name = $request->name;
      $product->description = $request->description;
      $product->category_id = $request->category;

      if($request->has("picture"))
      {
        $photo = $request->picture;
        $photo_name = md5(rand(1,1000).time()).'.'.$photo->getClientOriginalExtension();
        $photo->move(public_path('/uploads/'), $photo_name);
        $product->picture = $photo_name;
      }
      $product->save();
      $product->productTags()->delete();
      if($request->has("tags"))
      {
        $request->tags = implode(', ', array_column(json_decode($request->tags), 'value'));
        $request->tags = explode(",",$request->tags);
        $tags = array();
        foreach($request->tags as $tag)
        {
          $tags[] = array("name"=>$tag);
        }

        $product->productTags()->createMany($tags);
      }


      return json_encode(array("sucess"=>true,"sucess_text"=>"Sucessfully update"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $product =  Product::findOrFail($id);
      $product->delete();
      Session::put('message', "Sucessfully delete");
      return json_encode(array("sucess"=>true));
    }
}
