<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Redirect;
use DB;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $banners = Banner::orderBy('id')->get();
            return view('admin.banner.index',compact('banners'));
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
        return view('admin.banner.create');
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
            'type' => 'required|unique:banners',
            'image' => 'required'
        ]);

        
        try{

            $input=$request->all();

            if($file=$request->file('image')){

                $file_name=time().$file->getClientOriginalName();
                $file->move('uploads/banners',$file_name);
                $input['image'] = $file_name;
            }

            Banner::create($input);
            
            return redirect()->back()
                ->with('success', 'Banner created successfully.');

        }catch(\Exception $e){
            DB::rollback();
            return Redirect::back()->with('error',$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return view('admin.banner.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'type' => 'required'
        ]);
 
        try{

            $input=$request->all();
            unset($input['_method']);
            unset($input['_token']);

            if($file=$request->file('image')){

                unlink(public_path().'/uploads/banners/'.$banner->image);
                $file_name=time().$file->getClientOriginalName();
                $file->move('uploads/banners',$file_name);
           
                $input['image'] = $file_name;

            }else{

                $input['image'] = $banner->image;
            }

            Banner::where('id',$banner->id)->update($input);
            
            return redirect()->back()
                ->with('success', 'Banner Updated successfully.');

        }catch(\Exception $e){
            DB::rollback();
            return Redirect::back()->with('error',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        DB::beginTransaction();
        try{

            unlink(public_path().'/uploads/banners/'.$banner->image);
           
            $banner->delete();

            DB::commit();
            return Redirect::back()->with('success','Banner Deleted Successfully!');
    
        }catch(\Exception $e){
            DB::rollback();
            return Redirect::back()->with('error',$e->getMessage());
        }
    }
}
