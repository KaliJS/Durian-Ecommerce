<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Banner;
use Redirect;

class ShopController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try{
            $products = Product::paginate(20);     
            $header = Banner::where('type','Header')->first('image');
            return view('shopping.shop',compact('products','header'));
        }catch(\Exception $e){
            return Redirect::back()->with('error',$e->getMessage());
        }
    }

    public function getCategoryProducts($data)
    {
        try{
           
            $category = Category::where('slug',$data)->first();
            $products = Product::where('category_id',$category->id)->paginate(20);
            $header = Banner::where('type','Header')->first('image');
            return view('shopping.shop',compact('products','header','category'));
        }catch(\Exception $e){
            return Redirect::back()->with('error',$e->getMessage());
        }
    }

    public function getAllCategories()
    {
        try{
            
            $categories = Category::orderBy('id')->get();
            $header = Banner::where('type','Header')->first('image');
            return view('shopping.category',compact('header','categories'));
        }catch(\Exception $e){
            return Redirect::back()->with('error',$e->getMessage());
        }
    }
}
