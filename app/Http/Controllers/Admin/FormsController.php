<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\MyModels\Document;
use Illuminate\Validation\Rule;
use App\MyModels\Customer;
use App\User;

class FormsController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('permission:user-list');
        // $this->middleware('permission:role-create', ['only' => ['roleCreate']]);
        // $this->middleware('permission:role-edit', ['only' => ['edit','roleEdit']]);
        // $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function directDebitForm(Request $request)
    {
        if ($request->ajax()) {
            $response = array();
            $response['code'] = 200;

            $data = Document::where('is_deleted', 0)->orderBy('id','DESC')->paginate(5);
            $response['html'] =  view('master.documents._partial_list',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5)->render();
            return response()->json($response);
        }
        return view('forms.directdebit');
    }

    public function webSalesForm(Request $request)
    {
        $customers = Customer::where('is_deleted', 0)->get();
        $user_role_id = User::find(\Auth::id())->roles->first()->id;
        $users = User::where('is_deleted', 0)->get();
        if ($request->ajax()) {
            $response = array();
            $response['code'] = 200;

            $data = Document::where('is_deleted', 0)->orderBy('id','DESC')->paginate(5);
            $response['html'] =  view('master.documents._partial_list',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5)->render();
            return response()->json($response);
        }
        return view('forms.websales',compact('customers','user_role_id', 'users'));
    }

    public function digitalSalesForm(Request $request)
    {
        if ($request->ajax()) {
            $response = array();
            $response['code'] = 200;

            $data = Document::where('is_deleted', 0)->orderBy('id','DESC')->paginate(5);
            $response['html'] =  view('master.documents._partial_list',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5)->render();
            return response()->json($response);
        }
        return view('forms.digitalsales');
    }

    public function customerSelect()
    {
        $customer_id = $_POST['customer_id'];
        $response = array();
        $response['code'] = 200;
        $data = Customer::find($customer_id);
        if( $data ) {
            $response['data'] = $data;
            $response['status'] = true;
        } else {
            $response['status'] = false;
            $response['data'] = [];
            $response['msg'] = 'No Customer Found';
        }

        // $data = Customer::find($customer_id);
        return response()->json($response);
    }

}
