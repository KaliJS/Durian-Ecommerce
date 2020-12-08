<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariants;
use App\Models\Category;
use App\Models\Banner;
use Redirect;

class SingleProductController extends Controller
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
        
    }

    

    public function getProductDetails($data)
    {
        try{
           
            // session()->put('name', 'khalid');
            // $value = session()->get('name');
            // $_SESSION['cart'][$i]['qty']=$qty;$_SESSION['cart'][$i]['price']=$price;

            $price = '';

            $product = Product::where('slug',$data)->first();
            
            $max_price=ProductVariants::where('product_id',$product->id)->max('selling_price');
            $min_price=ProductVariants::where('product_id',$product->id)->min('selling_price');

            if($min_price == $max_price){
                $price = '$'.$min_price;
            }else{
                $price = '$'.$min_price.' - $'.$max_price;
            }

            $arr = explode(",", $product->images, 2);
            $first_image = $arr[0];
            
            $relatedProducts = Product::where('category_id',$product->category_id)->where('slug','!=',$data)->select("*")
            ->addSelect(\DB::raw("
                (select (CASE WHEN min(selling_price)=max(selling_price) THEN CONCAT('$',CAST(min(selling_price) as INTEGER)) 
                ELSE CONCAT('$',CAST(min(selling_price) as INTEGER),' - $',CAST(max(selling_price) as INTEGER))
                END) as price_range from product_variants where product_id=products.id) as price_range
                "
            ))
            ->orderBy('id')->offset(0)->limit(8)->get();
            $header = Banner::where('type','Header')->first('image');
            return view('shopping.single-product',compact('relatedProducts','header','product','first_image','price'));
        }catch(\Exception $e){
            return Redirect::back()->with('error',$e->getMessage());
        }
    }

    
}
