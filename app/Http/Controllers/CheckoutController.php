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
use Carbon\Carbon;

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
                $input['payment_method'] = 'paypal';
                $input['latitude'] = '0';
                $input['longitude'] = '0';
                $input['address'] = $request->address;
                $input['pincode'] = $request->pincode;
                $input['order_status'] = 'booked';
                $input['payment_status'] = 'success';
                $input['delivery_date'] = $request->date;
                $input['delivery_time'] = $request->time;

                $created_order = Orders::create($input);

                $order_items=[];
                if($created_order){
                    foreach($request->products as $key=>$order){
                    $order_items[]=array('order_id'=>$created_order->id,'product_variant_id'=>$key,'quantity'=>$order['quantity'],'price'=>$order['variant_price'],'subtotal'=>($order['quantity']*$order['variant_price']),'status'=>'booked','created_at'=>date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s"));
                    }
                    $inserted_items=DB::table('order_items')->insert($order_items);

                    $transaction[]=array('order_id'=>$created_order->id,'amount'=>$request->price_after_discount,'payment_id'=>$request->details['id'],'payer_email'=>$request->details['payer']['email_address'],'merchant_id'=>$request->details['purchase_units'][0]['payee']['merchant_id'],'payment_status'=>$request->details['purchase_units'][0]['payments']['captures'][0]['status'],'created_at'=>date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s"),'payer_id'=>$request->details['payer']['payer_id']);

                    $inserted_transaction=DB::table('transactions')->insert($transaction);

                    $track_order = [
                        'order_id' => $created_order->id,
                        'status' => $created_order->order_status,
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s"),
                    ];
                    DB::table('track_orders')->insert($track_order);

                }

                $products = $request->products;
                $address = $request->address. ' '. $request->pincode;
                $name = Auth::user()->name;
                $phone = Auth::user()->phone;
                $transaction_id = $request->details['id'];
                $amount = $request->price_after_discount;
                $date = $created_order->created_at;
                $payment_type = 'Paypal';


        DB::commit();
        return response()->json(['url'=>url('/order/success')]);
        
        }catch(\Exception $e){
            return $e->getMessage();
            DB::rollback();
            
        }
                
    }


    public function placeCashOrder(Request $request){
        DB::beginTransaction();
            try{
                $input = [];
                $input['user_id'] = Auth::user()->id;
                $input['actual_price'] = $request->amount;
                $input['final_price'] = $request->price_after_discount;
                $input['delivery_charge'] = '0';
                $input['payment_method'] = 'cash';
                $input['latitude'] = '0';
                $input['longitude'] = '0';
                $input['address'] = $request->address;
                $input['pincode'] = $request->pincode;
                $input['order_status'] = 'booked';
                $input['payment_status'] = 'cash on delivery';
                $input['delivery_date'] = $request->date;
                $input['delivery_time'] = $request->time;

                $created_order = Orders::create($input);

                $order_items=[];
                if($created_order){
                    foreach($request->products as $key=>$order){
                    $order_items[]=array('order_id'=>$created_order->id,'product_variant_id'=>$key,'quantity'=>$order['quantity'],'price'=>$order['variant_price'],'subtotal'=>($order['quantity']*$order['variant_price']),'status'=>'booked','created_at'=>date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s"));
                    }

                    $inserted_items=DB::table('order_items')->insert($order_items);


                    
                    $track_order = [
                        'order_id' => $created_order->id,
                        'status' => $created_order->order_status,
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s"),
                    ];
                    DB::table('track_orders')->insert($track_order);

                }
                $products = $request->products;
                $address = $request->address. ' '. $request->pincode;
                $name = Auth::user()->name;
                $phone = Auth::user()->phone;
                $amount = $request->price_after_discount;
                $date = $created_order->created_at;
                $payment_type = 'Cash On Delivery';
                

        DB::commit();
        return response()->json(['url'=>url('/order/success')]);
        //return view('shopping.success-order',compact('products','address','name','phone','amount','date','payment_type'));
        
        }catch(\Exception $e){
            return $e->getMessage();
            DB::rollback();
        }
                
    }

    public function successOrder(){
        try{

            if(session()->has('cart')){
                $cart = []; 
                if(session()->has('cart')){
                    $cart = session()->get('cart');
                }
                
                $order = Orders::where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->first();
    
                session()->forget('cart');
                
                return view('shopping.success-order',compact('cart','order'));
            }else{

                return redirect('/');
            }

        }catch(\Exception $e){
            return Redirect::back()->with('error',$e->getMessage());
        }
    }


    public function checkSelectedDate(Request $request){
        try{
            $data = [];
            $date = $request->date;
            $day = Carbon::parse($date)->format('l');
            $delivery = DB::table('delivery_management')->where('day',$day)->first();
            if($delivery->status =='0'){
                array_push($data,'no');
            }else{
                $selected_no_delivery_date = DB::table('no_delivery_dates')->where('date',$date)->first();
                if($selected_no_delivery_date){
                    array_push($data,'yes_no');
                    array_push($data,$selected_no_delivery_date->start_time);
                    array_push($data,$selected_no_delivery_date->end_time);
                }
                array_push($data,'yes');
                array_push($data,$delivery->start_time);
                array_push($data,$delivery->end_time);
            }
          return $data;  

        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function checkSelectedTime(Request $request){
        try{
            $data = [];
            $time = $request->time;
            $date = $request->date;
            $day = Carbon::parse($date)->format('l');
            $delivery = DB::table('delivery_management')->where('status','1')->where('day',$day)->first();

            if($time < $delivery->start_time && $time > $delivery->end_time){
                array_push($data,'no');
                return $data;
            }

            $no_delivery_date = DB::table('no_delivery_dates')->where('date',$date)->first();
           
            if($no_delivery_date){
                if($time > $no_delivery_date->start_time && $time < $no_delivery_date->end_time){
                    array_push($data,'no');
                    return $data;
                }
            }
            return 'go';

        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

}
