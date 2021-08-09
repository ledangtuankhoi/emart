<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $users = User::orderBy('id','DESC')->get();
        return view('backend.users.index',compact('users'));
    }

    
    public function productStatus(Request $request)
    {
        if ($request->mode == true) {
            DB::table('users')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('users')->where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'Successfully update status users ', 'status' => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $this->validate($request,[
            'full_name'=>'required|string',
            'username'=>'required|string',
            'email'=>'email|required|unique:users,email',
            'address'=>'nullable|string',
            'phone'=>'nullable| string',
            'photo'=>'nullable|string',
            'password'=>'min:4|required',
            'role'=>'required|in:admin,customer,vendor',
            'status'=>'required|in:active,inactive', 
        ]);
        // return $request->all();
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        
 
        // return $data;
        $status = User::create($data);
        if ($status) {
            return redirect()->route('user.index')->with('success', 'user Succsessfully create ');
        } else {
            return back()->with('errors', 'Somthing went wrong');
        }

        return $request->all();
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
        $user = User::find($id);
        if($user){
            return view('backend.users.edit',compact('user' ));
        }else{
            return back()->with('error','data not found');
        }
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
}
