<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $users = User::orderBy('name')->get();
            return view('admin.users.index',compact('users'));
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
        try{
            $roles = Role::orderBy('name')->get();
            return view('admin.users.create',compact('roles'));
        }catch(\Exception $e){
            return Redirect::back()->with('error',$e->getMessage());
        }
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
            'email' => 'required|unique:users',
            'name' => 'required',
            'city' => 'required',
            'area' => 'required',
            'pincode' => 'required',
            'password' => 'required',
            'role_id' => 'required',
            'phone' => 'required',
        ]);
       
        try{

            $input=$request->all();
            $input['password'] = Hash::make($request->password);
            $input['address'] = $request->area.' '.$request->city.' '.$request->pincode;
            User::create($input);
            
            return redirect()->back()
                ->with('success', 'User created successfully.');

        }catch(\Exception $e){
            DB::rollback();
            return Redirect::back()->with('error',$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        try{
            $roles = Role::orderBy('name')->get();
            return view('admin.users.edit',compact('roles','user'));
        }catch(\Exception $e){
            return Redirect::back()->with('error',$e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required',
            'name' => 'required',
            'city' => 'required',
            'area' => 'required',
            'pincode' => 'required',
            'password' => 'required',
            'role_id' => 'required',
            'phone' => 'required',
        ]);
       
        try{

            $input=$request->all();
            unset($input['_token']);
            unset($input['_method']);
            $input['password'] = Hash::make($request->password);
            $input['address'] = $request->area.' '.$request->city.' '.$request->pincode;
            
            User::where('id',$user->id)->update($input);
            
            return redirect()->back()
                ->with('success', 'User updated successfully.');

        }catch(\Exception $e){
            DB::rollback();
            return Redirect::back()->with('error',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try{
            $user->delete();
            return redirect()->back()
                ->with('success', 'User Deleted successfully.');
        }catch(\Exception $e){
            DB::rollback();
            return Redirect::back()->with('error',$e->getMessage());
        }
    }
}
