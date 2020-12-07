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

    public function addToCart(Request $request)
    {

        try{
            // $request->session()->forget('cart');
            // return $request->session()->all();
            $variant_id = $request->selected_variant_id;

            if($request->session()->has('cart')){
                $cart = $request->session()->get('cart');
            }
                 
            if($request->todo == 'add'){
                $quantity = $request->selected_quantity;
                $variant_price = $request->selected_selling_price;

                if(!$request->session()->has('cart')){
                    $request->session()->put('cart',[]);
                }

                $cart = $request->session()->get('cart');
                if(isset($cart[$variant_id])){
                    $cart[$variant_id]['quantity'] += $quantity;
                }else{
                    $cart[$variant_id]['quantity'] = $quantity;
                    $cart[$variant_id]['variant_price'] = $variant_price;
                }
                $cart[$variant_id]['subtotal'] = $cart[$variant_id]['quantity']*$variant_price;
                $request->session()->put('cart',$cart);

            }else if($request->todo == 'update'){
                $get_cart = $request->session()->get('cart');
                $quantity = $request->quantity;
                $get_cart[$variant_id]['quantity'] = $quantity;
                $request->session()->put('cart',$get_cart);

            }else if($request->todo == 'delete'){
                $get_cart = $request->session()->get('cart');
                unset($get_cart[$variant_id]);
                $request->session()->put('cart',$get_cart);
               

            }
            return $request->session()->get('cart');
        }catch(\Exception $e){
            return $e->getMessage();
        }
        

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
            
            $relatedProducts = Product::where('category_id',$product->category_id)->where('slug','!=',$data)->offset(0)->limit(8)->get();
            $header = Banner::where('type','Header')->first('image');
            return view('shopping.single-product',compact('relatedProducts','header','product','first_image','price'));
        }catch(\Exception $e){
            return Redirect::back()->with('error',$e->getMessage());
        }
    }

    
}
