<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;
use Redirect;
use DB;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $promos = Promo::orderBy('title')->get();
            return view('admin.promo.index',compact('promos'));
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
        return view('admin.promo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:promo_codes',
            'start_date' => 'required',
            'end_date' => 'required',
            'minimum_order_amount' => 'required',
            'number_of_users' => 'required',
            'discount_type' => 'required',
            'discount' => 'required',
            'max_discount' => 'required',
            'number_of_usages' => 'required',
        ]);

        
        try{

            $input=$request->all();
            Promo::create($input);
            
            return redirect()->back()
                ->with('success', 'Promo Code created successfully.');

        }catch(\Exception $e){
            DB::rollback();
            return Redirect::back()->with('error',$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function show(Promo $promo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function edit(Promo $promo)
    {
        return view('admin.promo.edit',compact('promo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promo $promo)
    {
        $request->validate([
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'minimum_order_amount' => 'required',
            'number_of_users' => 'required',
            'discount_type' => 'required',
            'discount' => 'required',
            'max_discount' => 'required',
            'number_of_usages' => 'required',
        ]);

        
        try{

            $input=$request->all();
            unset($input['_token']);
            unset($input['_method']);
            Promo::where('id',$promo->id)->update($input);
            
            return redirect()->back()
                ->with('success', 'Promo Code Updated successfully.');

        }catch(\Exception $e){
            DB::rollback();
            return Redirect::back()->with('error',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promo $promo)
    {
        try{
            $promo->delete();
            return redirect()->back()
                ->with('success', 'Promo deleted successfully.');
        }catch(\Exception $e){
            DB::rollback();
            return Redirect::back()->with('error',$e->getMessage());
        }
    }
}
