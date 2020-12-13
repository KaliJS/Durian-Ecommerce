<?php

namespace App\Http\Controllers;

use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Auth;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $orders = Orders::orderBy('id','desc')->get();
            $delivery_boys = User::where('role_id',User::DELIVERY_BOY_ROLE_ID)->get(['id','name']);
            return view('admin.orders.index',compact('orders','delivery_boys'));
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
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(Orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orders $orders)
    {
        //
    }

    public function getOrderItems($id){
        try{
            $orderItems = OrderItems::where('order_id',$id)->get();
            $result = "";
            foreach($orderItems as $item){
                $result .= <<<DELIMETER
                <tr>
                    <td>{$item->product_variant->product->name} ({$item->product_variant->quantity} {$item->product_variant->unit->name})</td>
                    <td>{$item->quantity}</td>
                    <td>{$item->price}</td>
                </tr>
DELIMETER;
            }
            return $result;
        }catch(Exception $e){
            return Redirect::back()->with('error',$e->getMessage());
        }
    }

    public function getTransaction($id){

        try{
            $transaction = Transaction::where('order_id',$id)->first();
            $transaction->created_at = date("j F Y g:i A",strtotime($transaction->created_at));
            $transaction->payment_status = ucwords($transaction->payment_status);
            $result = <<<DELIMETER
                <tr>
                    <td class="table-plus">{$transaction->id}</td>
                    <td>{$transaction->order_id}</td>
                    <td>{$transaction->amount}</td>
                    <td>{$transaction->payment_id}</td>
                    <td>{$transaction->payer_email}</td>
                    <td>{$transaction->merchant_id}</td>
                    <td>{$transaction->payment_status}</td>
                    <td>{$transaction->payer_id}</td>
                    <td>{$transaction->created_at}</td>
                </tr>
DELIMETER;
            return $result;
        }catch(Exception $e){
            return Redirect::back()->with('error',$e->getMessage());
        }

    }

    public function assignDeliveryBoy(Request $request,$id){

        try{
            $order = Orders::find($id);
            $order->delivery_boy_id = $request->delivery_boy_id;
            $order->save();

            return Redirect::back()->with('success',"Delivery boy assigned successfully!");
        }catch(Exception $e){
            return Redirect::back()->with('error',$e->getMessage());
        }

    }

    public function changeOrderStatus(Request $request,$id){

        try{
            DB::beginTransaction();
            $order = Orders::find($id);
            $order->order_status = $request->status;
            $order->save();
            $track_order = [
                'order_id' => $order->id,
                'status' => $order->order_status,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ];
            DB::table('track_orders')->insert($track_order);
            DB::commit();
            return Redirect::back()->with('success',"Order status updated successfully!");
        }catch(Exception $e){
            DB::rollback();
            return Redirect::back()->with('error',$e->getMessage());
        }

    }

    public function getOrderStatus($id){

        try{

            $order_status = Orders::find($id)->order_status;
            $all_status = ['booked','shipped','completed','cancelled','returned'];
            $result = "";
            foreach($all_status as $status){
                if($status == $order_status){
                    $selected = 'selected';
                }else{
                    $selected = '';
                }
                $status = ucwords($status);
                $result.="<option {$selected}>{$status}</option>";
            }
            return $result;

        }catch(Exception $e){
            return Redirect::back()->with('error',$e->getMessage());
        }

    }

    public function getPaymentStatus($id){

        try{

            $payment_status = Orders::find($id)->payment_status;
            $all_status = ['failed','pending','success','cash on delivery'];
            $result = "";
            foreach($all_status as $status){
                if($status == $payment_status){
                    $selected = 'selected';
                }else{
                    $selected = '';
                }
                $status = ucwords($status);
                $result.="<option {$selected}>{$status}</option>";
            }
            return $result;

        }catch(Exception $e){
            return Redirect::back()->with('error',$e->getMessage());
        }

    }

    public function changePaymentStatus(Request $request,$id){

        try{
            $order = Orders::find($id);
            $order->payment_status = $request->status;
            $order->save();
            return Redirect::back()->with('success',"Payment status updated successfully!");
        }catch(Exception $e){
            return Redirect::back()->with('error',$e->getMessage());
        }

    }

    public function getAllOrders(){
        try{

            $orders = Orders::where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->get();
    
                return view('shopping.track-order',compact('orders'));
        }catch(Exception $e){
            return Redirect::back()->with('error',$e->getMessage());
        }
    }


     public function getDeliveryBoy($id){

        try{
            $order = Orders::find($id);
            $delivery_boy = User::where('id',$order->delivery_boy_id)->first();
           
            $result = <<<DELIMETER
               
                    <td class="table-plus">{$delivery_boy->name}</td>
                    <td>{$delivery_boy->email}</td>
                    <td>{$delivery_boy->phone}</td>
                
DELIMETER;
            return $result;
        }catch(Exception $e){
            return $e->getMessage();
        }

    }

    

    public function getAllOrderItems($id){

          try{
            $orderItems = OrderItems::where('order_id',$id)->get();
            $result = "";
            foreach($orderItems as $item){
                $result .= <<<DELIMETER
                <tr>
                    <td>{$item->product_variant->product->name} ({$item->product_variant->quantity} {$item->product_variant->unit->name})</td>
                    <td>{$item->quantity}</td>
                    <td>{$item->price}</td>
                    <td>{$item->subtotal}</td>
                </tr>
DELIMETER;
            }
            return $result;
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

}
