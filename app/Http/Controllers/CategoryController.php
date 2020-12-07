<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Redirect;
use Str;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $categories = Category::orderBy('name')->get();
            return view('admin.products.categories.index',compact('categories'));
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
        return view('admin.products.categories.create');
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
            'name' => 'required|unique:categories',
            'description' => 'required',
            'image' => 'required'
        ]);

        
        try{

            $input=$request->all();
            $name = $input['name'];
            $input['slug']=Str::slug($name);

            if($file=$request->file('image')){

                $file_name=time().$file->getClientOriginalName();
                $file->move('uploads/categories',$file_name);
                $input['image'] = $file_name;
            }

            Category::create($input);
            
            return redirect()->back()
                ->with('success', 'Category created successfully.');

        }catch(\Exception $e){
            DB::rollback();
            return Redirect::back()->with('error',$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.products.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        
        try{

            $input=$request->all();
            unset($input['_method']);
            unset($input['_token']);
            unset($input['_wysihtml5_mode']);
            $name = $input['name'];
            $input['slug']=Str::slug($name);

            if($file=$request->file('image')){

                unlink(public_path().'/uploads/categories/'.$category->image);
                $file_name=time().$file->getClientOriginalName();
                $file->move('uploads/categories',$file_name);
           
                $input['image'] = $file_name;

            }else{

                $input['image'] = $category->image;
            }

            Category::where('id',$category->id)->update($input);
            
            return redirect()->back()
                ->with('success', 'Category Updated successfully.');

        }catch(\Exception $e){
            DB::rollback();
            return Redirect::back()->with('error',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {     
        
        DB::beginTransaction();
        try{

            unlink(public_path().'/uploads/categories/'.$category->image);          
            $category->delete();
            DB::table('products')->where('category_id',$category->id)->delete();
            DB::commit();
            return Redirect::back()->with('success','Category Deleted Successfully!');
    
        }catch(\Exception $e){
            DB::rollback();
            return Redirect::back()->with('error',$e->getMessage());
        }

    }

}
