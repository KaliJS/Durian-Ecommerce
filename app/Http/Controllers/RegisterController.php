<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Redirect;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('shopping.register');
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
        $request->validate([
            'email' => 'required|unique:users',
            'firstname' => 'required',
            'lastname' => 'required',
            'city' => 'required',
            'address1' => 'required',
            'pincode' => 'required',
            'password' => 'required',
            'phone' => 'required'
        ]);
       
        try{

            $input=$request->all();
            $input['password'] = Hash::make($request->password);
            $input['role_id'] = User::USER_ROLE_ID;
            $input['name'] = $request->firstname.' '.$request->lastname;
            $input['area'] = $request->address1;
            if(isset($request->address2)){
                $input['area'] .= ". ".$request->address2;
            }
            $input['address'] = $input['area'].' '.$request->city.' '.$request->pincode;
            
            User::create($input);
            
            return redirect()->route('login')
                ->with('success', 'Registered successfully, Please Login.');

        }catch(\Exception $e){
            DB::rollback();
            return Redirect::back()->with('error',$e->getMessage());
        }
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
        $user = User::where('id',$id)->first();
        $split = explode(" ", $user->name);

        $firstname = array_shift($split);
        $lastname  = implode(" ", $split);
        return view('shopping.edit-profile',compact('user','firstname','lastname'));
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

        $request->validate([
            'email' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'city' => 'required',
            'address1' => 'required',
            'pincode' => 'required',
            'password' => 'required',
            'phone' => 'required'
        ]);
       
        try{

            $input=[];
            $input['password'] = Hash::make($request->password);
            $input['role_id'] = User::USER_ROLE_ID;
            $input['email'] = $request->email;
            $input['phone'] = $request->phone;
            $input['status'] = '1';
            $input['pincode'] = $request->pincode;
            $input['name'] = $request->firstname.' '.$request->lastname;
            $input['area'] = $request->address1;
            if(isset($request->address2)){
                $input['area'] .= ". ".$request->address2;
            }
            $input['address'] = $input['area'].' '.$request->city.' '.$request->pincode;
            
            User::where('id',$id)->update($input);
            
            return redirect()->back()
                ->with('success', 'Profile Edit successfully');

        }catch(\Exception $e){
            DB::rollback();
            return Redirect::back()->with('error',$e->getMessage());
        }
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
}
