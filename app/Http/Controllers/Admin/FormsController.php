<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\MyModels\Document;
use App\MyModels\Customer;
use App\MyModels\WebSalesForm;
use App\MyModels\WebSalesItems;
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
        if ( $request->post() ) {

            $validator = \Validator::make($request->all(), [
                'customer_select' => 'required',
                'sales_person' => 'required',
                'client_name' => 'required',
                'client_surname' => 'required',
                'client_contact_work' => 'required|digits:10',
                'client_email' => 'required|email',
                'project_amount' => 'required',
                'payment_type' => 'required',
                'payment_method' => 'required',
                'project_services' => 'required',
                'item_descriptions' => 'required',
                'signature_first' => 'required',
                'client_abn' => 'required|digits:11',
            ],
            [
                'customer_select.required' => 'Customer field is required',
                'sales_person.required' => 'Sales Person is required',
                'client_name.required' => 'Customer Name is required',
                'client_surname.required' => 'Customer Surname is required',
                'client_contact_work.required' => 'Customer Contact (W) is required',
                'client_contact_work.digits' => 'Customer Contact (W) should be 10 digits',
                'client_email.required' => 'Customer Email is required',
                'client_email.email' => 'Please Enter Valid Email',
                'project_amount.required' => 'Amount is required',
                'payment_type.required' => 'Payment Type is required',
                'payment_method.required' => 'Payment Method is required',
                'signature_first.required' => 'Signature is required',
            ]);

            if ($validator->fails())
            {
                return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            }

            $websale = new WebSalesForm;
            $websale->customer_id               = $request->customer_select;
            $websale->sales_person_id           = $request->sales_person;
            $websale->client_name               = $request->client_name;
            $websale->client_surname            = $request->client_surname;
            $websale->client_company_name       = $request->client_company_name;
            $websale->client_address_line_1     = $request->client_address_line_1;
            $websale->client_suburb             = $request->client_suburb;
            $websale->client_state              = $request->client_state;
            $websale->client_postcode           = $request->client_postcode;
            $websale->client_abn                = $request->client_abn;
            $websale->client_contact_work       = $request->client_contact_work;
            $websale->client_contact_mobile     = $request->client_contact_mobile;
            $websale->client_email              = $request->client_email;
            $websale->client_website            = $request->client_website;
            $websale->setAttribute('ProjectStartDate', $request->project_start_date);
            $websale->project_amount            = $request->project_amount;
            $websale->setAttribute('ProjectServices', $request->project_services);
            $websale->payment_type              = $request->payment_type;
            $websale->payment_method            = $request->payment_method;
            $websale->authorisation_date        = set_date_server($request->authorisation_date);
            $websale->authorisation_signature   = $request->signature_first;
            $websale->created_by                = \Auth::user()->id;
            $websale->modified_by               = \Auth::user()->id;
            $websale->save();

            $response = array();
            $response['code'] = 200;

            $_sub_total = $_gst_total = 0;

            if( !empty($websale->id) ) {
                // now add the data to items table
                for ($i=0; $i < count($request->unit_price); $i++) {
                    // create new object
                    $item = new WebSalesItems;
                    $item->web_sales_id         = $websale->id;
                    $item->item_descriptions    = $request->item_descriptions[$i];
                    $item->unit_price           = $request->unit_price[$i];
                    $item->quantity             = $request->quantity[$i];
                    $thistotal = $request->unit_price[$i] * $request->quantity[$i];
                    $_sub_total += $thistotal;
                    $item->total                = $thistotal;
                    $item->created_by           = \Auth::user()->id;
                    $item->modified_by          = \Auth::user()->id;
                    $item->save();
                }
                $websale->sub_total = $_sub_total;
                $_gst_total = ( $_sub_total * get_gst_percentage() ) / 100;
                $websale->gst_total = $_gst_total;
                $websale->total_amt = $_sub_total + $_gst_total;
                $websale->save();

                $response['status'] = true;
                $response['msg'] = 'Web Sales Form created Successfully';
                setflashmsg('Web Sales Form created Successfully','1');
            } else {
                $response['status'] = false;
                $response['msg'] = 'Some error occured. Please try again';
                setflashmsg('Some error occured. Please try again','0');
            }

            return response()->json($response);
        }
        return view('forms.websales',compact('customers','user_role_id', 'users'));
    }

    public function digitalSalesForm(Request $request)
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
        return view('forms.digitalsales',compact('customers','user_role_id', 'users'));
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
