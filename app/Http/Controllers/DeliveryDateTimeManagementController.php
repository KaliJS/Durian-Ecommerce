<?php

namespace App\Http\Controllers;

use App\Models\DeliveryManagement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;

class DeliveryDateTimeManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date_time_slots = DeliveryManagement::orderBy('day_number','asc')->get();
        return view('admin.delivery.index',compact('date_time_slots'));
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
     * @param  \App\Models\DeliveryManagement  $deliveryManagement
     * @return \Illuminate\Http\Response
     */
    public function show(DeliveryManagement $deliveryManagement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeliveryManagement  $deliveryManagement
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryManagement $deliveryManagement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeliveryManagement  $deliveryManagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeliveryManagement $deliveryManagement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeliveryManagement  $deliveryManagement
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveryManagement $deliveryManagement)
    {
        //
    }

    public function update_delivery_slot(Request $request,$day){

        try{
            $slot = DeliveryManagement::where('day_number',$request->day)->first();
            if($request->key == 'status'){

                if($slot->status == '0'){
                    $slot->status = '1';
                }else{
                    $slot->status = '0';
                }
                $slot->save();
                return $slot;
            }
            $slot->{$request->key} = $request->value;
            $slot->save();
            return $slot;
        }catch(Exception $e){
            return $e->getMessage();
        }

    }

    public function no_delivery_dates(){

        $no_delivery_dates = DB::table('no_delivery_dates')->orderBy('date','asc')->get();
        return view('admin.delivery.no_delivery_dates',compact('no_delivery_dates'));

    }

    public function delete_no_delivery_dates($id){
        try{
            DB::table("no_delivery_dates")->where('id',$id)->delete();
            return Redirect::back()->with('success','Deleted successfully!');
        }catch(Exception $e){
            return Redirect::back()->with('error',$e->getMessage());
        }
    }

    public function add_no_delivery_dates(Request $request){
        try{
            $input = ['date'=>$request->date,'start_time'=>$request->start_time,'end_time'=>$request->end_time];
            DB::table('no_delivery_dates')->insert($input);
            return Redirect::back()->with('success',"Date added successfully!");
        }catch(Exception $e){
            return Redirect::back()->with('error',$e->getMessage());
        }
    }
}
