<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariants;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Promo;
use Redirect;
use Auth;
use DB;

class CartController extends Controller
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
            $cart = []; 
            if(session()->has('cart')){
                $cart = session()->get('cart');
            }
            //session()->forget('cart');
            $total_price = 0;
            foreach($cart as $key=>$value){
                $total_price += $value['subtotal'];
            }

            $empty = '! Your Cart Is Empty';
            $header = Banner::where('type','Header')->first('image');
            return view('shopping.cart',compact('header','cart','empty','total_price'));
        }catch(\Exception $e){
            return Redirect::back()->with('error',$e->getMessage());
        }
    }

    public function updateCart(Request $request)
    {

        try{
            $final = array();
            $total_price = 0;
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
                    $product = ProductVariants::where('id',$variant_id)->with('product:id,name,images')->first();
                    
                    $image_array = explode(',',$product->product->images);
                    $image = $image_array[0];                    

                    $cart[$variant_id]['product_name'] = $product->product->name.' ('.$product->quantity.''.$product->unit->short_code.')';

                    $cart[$variant_id]['image'] = $image;
                    
                }
                $cart[$variant_id]['subtotal'] = $cart[$variant_id]['quantity']*$variant_price;
                $request->session()->put('cart',$cart);

            }else if($request->todo == 'update'){
                $quantity = $request->quantity;
                $cart[$variant_id]['quantity'] = $quantity;
                
                $cart[$variant_id]['subtotal'] = $cart[$variant_id]['quantity']*$cart[$variant_id]['variant_price'];

                foreach($cart as $key=>$value){
                    $total_price += $value['subtotal'];
                }
                
                $request->session()->put('cart',$cart);
                array_push( $final, count($cart) );
                array_push( $final, $total_price );
                array_push( $final, $cart[$variant_id]['subtotal'] );
                


            }else if($request->todo == 'delete'){
                
                unset($cart[$variant_id]);
                
                foreach($cart as $key=>$value){
                    $total_price += $value['subtotal'];
                }
                
                $request->session()->put('cart',$cart);
                array_push( $final, count($cart) );
                array_push( $final, $total_price );
                
            }

            
              return $final;  

            //return $request->session()->get('cart');
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }



    public function applyCoupon(Request $request)
    {
        try{

            $final = array();
            $coupon = $request->coupon_code;
            $promo = Promo::where('title',$coupon)->where('status',1)->first();

            if($promo){
                $cart = []; 
                if(session()->has('cart')){
                    $cart = session()->get('cart');
                }
                
                $total_price = 0;
                foreach($cart as $key=>$value){
                    $total_price += $value['subtotal'];
                }

                if($promo->minimum_order_amount>$total_price){
                    return 'less_amount';
                }else if($promo->number_of_usages<1){
                    return 'finished';
                }else if($promo->start_date > date("Y-m-d") || $promo->end_date < date("Y-m-d")){
                    return 'expire';
                }else if($promo->discount_type == 'flat'){
                    $discount = $total_price - $promo->discount;
                    if($discount>$promo->max_discount){
                        $discount = $promo->max_discount;
                    }
                }else if($promo->discount_type == 'percentage'){
                    $discount = $total_price - (($promo->discount*$total_price)/100);
                    if($discount>$promo->max_discount){
                        $discount = $promo->max_discount;
                    }
                }
                $num_of_use = $promo->number_of_usages-1;
                Promo::where('title',$coupon)->update(array('number_of_usages' => $num_of_use));
                
                $data[]=array('user_id'=>Auth::user()->id
                        ,'promo_code_id'=>$promo->id,'created_at' => date("Y-m-d H:i:s"),'updated_at' =>date("Y-m-d H:i:s")
                    );
                
                $insert_services=DB::table('users_coupon')->insert($data);

                array_push( $final, $discount );
                array_push( $final, $total_price-$discount );
                return $final;
            }else{
                return 'blank';
            }

        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    

    

    
}
