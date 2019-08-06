<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;

class UserController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:user-list');
        $this->middleware('permission:user-create', ['only' => ['userCreate']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','userEdit']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::pluck('name','name')->all();
        if ($request->ajax()) {
            $response = array();
            $response['code'] = 200;

            $data = User::where('is_deleted', 0)->orderBy('id','DESC')->paginate(5);
            $response['html'] =  view('users._partial_userlist',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5)->render();
            return response()->json($response);
        }
        return view('users.index',compact('roles'));
    }

    public function userCreate(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'commission' => 'nullable|integer|between: 0,100',
            'roles' => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => false, 'errors' => $validator->getMessageBag()->toArray()]);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->commission = $request->commission;
        $user->password = Hash::make($request->password);
        $user->created_by = \Auth::user()->id;
        $user->modified_by = \Auth::user()->id;
        $user->save();
        $user->assignRole($request->input('roles'));
        return response()->json(['status' => true, 'msg' => 'User created successfully']);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $user = User::find($request->id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name')->first();

        $response = array();
        $response['code'] = 200;
        $response['status'] = true;

        $response['html'] =  view('users._partial_useredit',compact('user','roles','userRole'))->render();
        return response()->json($response);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userEdit(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'commission' => 'nullable|integer|between: 0,100',
            'roles' => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => false, 'errors' => $validator->getMessageBag()->toArray()]);
        }

        /* if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));
        } */


        $user = User::find($request->user_id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->commission = $request->commission;
        $user->modified_by = \Auth::user()->id;
        $user->save();
        DB::table('model_has_roles')->where('model_id',$request->user_id)->delete();

        $user->assignRole($request->input('roles'));
        return response()->json(['status' => true, 'msg' => 'User updated successfully']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->is_deleted = 1;
        $user->save();
        return response()->json(['status' => true, 'msg' => 'User deleted successfully']);
    }
}
