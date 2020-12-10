<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariants;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Promo;
use App\Models\Orders;
use Redirect;
use Auth;
use DB;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            if(Auth::user()){
                $cart = []; 
                if(session()->has('cart')){
                    $cart = session()->get('cart');
                }
                //session()->forget('cart');
                $total_price = 0;
                foreach($cart as $key=>$value){
                    $total_price += $value['subtotal'];
                }

                $header = Banner::where('type','Header')->first('image');
                return view('shopping.checkout',compact('header','cart','total_price'));
            }else{
                return redirect('/login');
            }
            
        }catch(\Exception $e){
            return Redirect::back()->with('error',$e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function placeOrder(Request $request){
        DB::beginTransaction();
            try{
                $input = [];
                $input['user_id'] = Auth::user()->id;
                $input['actual_price'] = $request->amount;
                $input['final_price'] = $request->price_after_discount;
                $input['delivery_charge'] = '0';
                $input['payment_method'] = 'Paypal';
                $input['latitude'] = '0';
                $input['longitude'] = '0';
                $input['address'] = $request->address;
                $input['pincode'] = $request->pincode;
                $input['order_status'] = 'booked';
                //$input['payment_status'] = $request->details->status;
                //$input['paypal_transaction_id'] = $request->details->id;

                $created_order = Orders::create($input);
                //return $created_order;

                $order_items=[];
                if($created_order){
                    foreach($request->products as $key=>$order){
                    $order_items[]=array('order_id'=>$created_order->id,'product_variant_id'=>$key,'quantity'=>$order['quantity'],'price'=>$order['variant_price'],'subtotal'=>($order['quantity']*$order['variant_price']),'status'=>'booked','created_at'=>date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s"));
                    }
                    $inserted_items=DB::table('order_items')->insert($order_items);

                    $transaction[]=array('order_id'=>$created_order->id,'amount'=>$request->price_after_discount,'payment_id'=>$request->details['id'],'payer_email'=>$request->details['payer']['email_address'],'merchant_id'=>$request->details['purchase_units'][0]['payee']['merchant_id'],'payment_status'=>$request->details['purchase_units'][0]['payments']['captures'][0]['status'],'created_at'=>date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s"),'payer_id'=>$request->details['payer']['payer_id']);

                    $inserted_transaction=DB::table('transactions')->insert($transaction);

                }



           
        DB::commit();
        return 'success';
        
        }catch(\Exception $e){
            return $e->getMessage();
            DB::rollback();
            return Redirect::back()->with('error',$e->getMessage());
        }
                
    }


}
