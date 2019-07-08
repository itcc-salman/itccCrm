<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MyModels\Customer;
use App\MyModels\Industry;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

class CustomerController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:customer-list');
        $this->middleware('permission:customer-create', ['only' => ['customerCreate','customerCreateStore']]);
        $this->middleware('permission:customer-edit', ['only' => ['customerEdit','customerEditStore']]);
        $this->middleware('permission:customer-delete', ['only' => ['destroy']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $response = array();
            $response['code'] = 200;

            $data = Customer::where('is_deleted', 0)->orderBy('id','DESC')->paginate(5);
            $response['html'] =  view('customers._partial_customerlist',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5)->render();
            return response()->json($response);
        }
        return view('customers.index');
    }

    public function customerCreate()
    {
        $industry = Industry::where('is_deleted', 0)->orderBy('name')->get();
        return view('customers.create', compact('industry'));
    }

    public function customerCreateStore(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:customers,email',
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }

        $input['first_name']        = $request->first_name;
        $input['last_name']         = $request->last_name;
        $input['email']             = $request->email;
        $input['company_name']      = $request->company_name;
        $input['abn']               = $request->abn;
        $input['address_line1']     = $request->address_line1;
        $input['suburb']            = $request->suburb;
        $input['state']             = $request->state;
        $input['post_code']         = $request->post_code;
        $input['contact_work']      = $request->contact_work;
        $input['contact_mobile']    = $request->contact_mobile;
        $input['website_url']       = $request->website_url;
        $input['no_of_employees']   = $request->no_of_employees;
        $input['industry']          = $request->industry;
        $input['status']            = 0;
        $input['created_by']        = \Auth::user()->id;
        $input['modified_by']       = \Auth::user()->id;

        $user = Customer::create($input);
        setflashmsg('Customer created successfully',1);
        return response()->json(['status' => true, 'msg' => 'Customer created successfully']);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = Customer::find($request->id);
        $response = array();
        $response['code'] = 200;
        $response['status'] = true;
        $response['html'] =  view('customers._partial_customerview',compact('data'))->render();
        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function customerEdit(Request $request,$id)
    {
        $data = Customer::where('id',$id)->first();
        $industry = Industry::where('is_deleted', 0)->orderBy('name')->get();
        return view('customers.edit', compact('data','industry'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function customerEditStore(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => array( 'required', 'email', Rule::unique('customers')->ignore($request->id) ),
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }

        /* if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));
        } */

        $customer = Customer::find($request->id);
        $customer->first_name        = $request->first_name;
        $customer->last_name         = $request->last_name;
        $customer->email             = $request->email;
        $customer->company_name      = $request->company_name;
        $customer->abn               = $request->abn;
        $customer->address_line1     = $request->address_line1;
        $customer->suburb            = $request->suburb;
        $customer->state             = $request->state;
        $customer->post_code         = $request->post_code;
        $customer->contact_work      = $request->contact_work;
        $customer->contact_mobile    = $request->contact_mobile;
        $customer->website_url       = $request->website_url;
        $customer->no_of_employees   = $request->no_of_employees;
        $customer->industry          = $request->industry;
        $customer->modified_by       = \Auth::user()->id;
        $customer->save();
        setflashmsg('Customer updated successfully',1);

        return response()->json(['status' => true, 'msg' => 'Customer updated successfully']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $customer = Customer::find($request->id);
        $customer->is_deleted = 1;
        $customer->save();
        return response()->json(['status' => true, 'msg' => 'Customer deleted successfully']);
    }
}
