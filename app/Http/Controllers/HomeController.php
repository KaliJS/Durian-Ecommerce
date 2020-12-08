<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Banner;
use Redirect;

class HomeController extends Controller
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
            $products = Product::select("*")
            ->addSelect(\DB::raw("
                (select (CASE WHEN min(selling_price)=max(selling_price) THEN CONCAT('$',CAST(min(selling_price) as INTEGER)) 
                ELSE CONCAT('$',CAST(min(selling_price) as INTEGER),' - $',CAST(max(selling_price) as INTEGER))
                END) as price_range from product_variants where product_id=products.id) as price_range
                "
            ))
            ->orderBy('id')->offset(0)->limit(8)->get();
            
            $categories = Category::orderBy('id')->offset(0)->limit(6)->get();
            $slide = Banner::where('type','Slide')->get('image');
            $home = Banner::where('type','Home')->first('image');
            return view('shopping.index',compact('products','slide','home','categories'));
        }catch(\Exception $e){
            return Redirect::back()->with('error',$e->getMessage());
        }
    }



    
    
}
