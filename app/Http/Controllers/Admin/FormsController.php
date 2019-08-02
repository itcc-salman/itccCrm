<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\MyModels\Document;
use App\MyModels\Lead;
use App\MyModels\Customer;
use App\MyModels\DirectDebitForm;
use App\MyModels\WebSalesForm;
use App\MyModels\WebSalesItems;
use App\MyModels\DigitalSalesForm;
use App\MyModels\DigitalSalesItems;
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
        if ($request->post()) {
            $validator = \Validator::make($request->all(), [
                'header_business_name' => 'required',
                'header_state' => 'required',
                'main_customer_name' => 'required',
                'main_customer_surname' => 'required',
                // 'client_contact_work' => 'required|digits:10',
                'main_customer_email' => 'required|email',
                'signature_first' => 'required',
            ],
            [
                'header_business_name.required' => 'Business Name is required',
                'header_state.required' => 'State is required',
                'main_customer_name.required' => 'Customer Name is required',
                'main_customer_surname.required' => 'Customer Surname is required',
                // 'client_contact_work.required' => 'Customer Contact (W) is required',
                // 'client_contact_work.digits' => 'Customer Contact (W) should be 10 digits',
                'main_customer_email.required' => 'Customer Email is required',
                'main_customer_email.email' => 'Please Enter Valid Email',
                'signature_first.required' => 'Signature is required',
            ]);

            if ($validator->fails())
            {
                return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            }

            $directdebit = new DirectDebitForm;
            $directdebit->header_business_name = $request->header_business_name;
            $directdebit->header_state = $request->header_state;
            $directdebit->header_ref_no = $request->header_ref_no;
            $directdebit->header_staff_ref = $request->header_staff_ref;
            $directdebit->header_customer_req = $request->header_customer_req;

            $directdebit->main_company_name = $request->main_company_name;
            $directdebit->main_customer_name = $request->main_customer_name;
            $directdebit->main_customer_surname = $request->main_customer_surname;
            $directdebit->main_customer_dob = set_date_server($request->main_customer_dob);
            $directdebit->main_customer_driver_licence_no = $request->main_customer_driver_licence_no;
            $directdebit->main_customer_address_line_1 = $request->main_customer_address_line_1;
            $directdebit->main_customer_suburb = $request->main_customer_suburb;
            $directdebit->main_customer_state = $request->main_customer_state;
            $directdebit->main_customer_postcode = $request->main_customer_postcode;
            $directdebit->main_customer_email = $request->main_customer_email;
            $directdebit->main_customer_contact_home = $request->main_customer_contact_home;
            $directdebit->main_customer_contact_work = $request->main_customer_contact_work;
            $directdebit->main_customer_contact_mobile = $request->main_customer_contact_mobile;

            $directdebit->payment_details_regular_debit_amt = $request->payment_details_regular_debit_amt;
            $directdebit->payment_details_commencing_on = $request->payment_details_commencing_on;
            // $directdebit->payment_details_until_further_notice = $request->
            // $directdebit->payment_details_for_payments = $request->
            // $directdebit->payment_details_contract_value = $request->

            $directdebit->payment_details_plus_approp = $request->payment_details_plus_approp;
            $directdebit->payment_details_variation_amt = $request->payment_details_variation_amt;
            $directdebit->payment_details_special_condition = $request->payment_details_special_condition;

            $directdebit->direct_debit_bank_bank_name = $request->direct_debit_bank_bank_name;
            $directdebit->direct_debit_bank_branch_account = $request->direct_debit_bank_branch_account;
            $directdebit->direct_debit_bank_bsb_number = $request->direct_debit_bank_bsb_number;
            $directdebit->direct_debit_bank_account_number = $request->direct_debit_bank_account_number;
            $directdebit->direct_debit_bank_account_holder_name = $request->direct_debit_bank_account_holder_name;
            $directdebit->direct_debit_bank_account_holder_surname = $request->direct_debit_bank_account_holder_surname;
            $directdebit->direct_debit_bank_verified_by = $request->direct_debit_bank_verified_by;

            $directdebit->debit_credit_card_card_type = $request->debit_credit_card_card_type;
            $directdebit->debit_credit_card_name = $request->debit_credit_card_name;
            $directdebit->debit_credit_card_surname = $request->debit_credit_card_surname;
            $directdebit->debit_credit_card_number = $request->debit_credit_card_number;
            $directdebit->debit_credit_card_expiry_date = $request->debit_credit_card_expiry_date;

            $directdebit->authorisation_signature_first = $request->signature_first;
            $directdebit->authorisation_signature_second = $request->signature_second;
            // $directdebit->authorisation_date = $request->

            $directdebit->created_by                = \Auth::user()->id;
            $directdebit->modified_by               = \Auth::user()->id;
            $directdebit->save();

            $response = array();
            $response['code'] = 200;
            $response['status'] = true;
            $response['msg'] = 'Direct Debit Form created Successfully';
            setflashmsg('Direct Debit Form created Successfully','1');
            return response()->json($response);

        }
        return view('forms.directdebit');
    }

    public function webSalesForm(Request $request)
    {
        $leads = Lead::where('is_deleted', 0)->whereIn('lead_status',[1,3,5])->get();
        $user_role_id = User::find(\Auth::id())->roles->first()->id;
        $users = User::where('is_deleted', 0)->get();
        if ( $request->post() ) {

            $validator = \Validator::make($request->all(), [
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
            $websale->lead_id                   = $request->lead;
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

                // update the lead status to sold
                $_lead = Lead::find($websale->lead_id);
                if($_lead) {
                    $_lead->lead_status = 7;
                    $_lead->save();
                }

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
        return view('forms.websales',compact('leads','user_role_id', 'users'));
    }

    public function digitalSalesForm(Request $request)
    {
        $leads = Lead::where('is_deleted', 0)->whereIn('lead_status',[1,3,5])->get();
        $user_role_id = User::find(\Auth::id())->roles->first()->id;
        $users = User::where('is_deleted', 0)->get();
        if ( $request->post() ) {
            $validator = \Validator::make($request->all(), [
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
                'project_minimum_agreed_term' => 'required',
            ],
            [
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
                'project_minimum_agreed_term.required' => 'Minimum Agreed Term is required',
            ]);

            if ($validator->fails())
            {
                return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            }

            $digitalsale = new DigitalSalesForm;
            $digitalsale->lead_id                   = $request->lead;
            $digitalsale->sales_person_id           = $request->sales_person;
            $digitalsale->client_name               = $request->client_name;
            $digitalsale->client_surname            = $request->client_surname;
            $digitalsale->client_company_name       = $request->client_company_name;
            $digitalsale->client_address_line_1     = $request->client_address_line_1;
            $digitalsale->client_suburb             = $request->client_suburb;
            $digitalsale->client_state              = $request->client_state;
            $digitalsale->client_postcode           = $request->client_postcode;
            $digitalsale->client_abn                = $request->client_abn;
            $digitalsale->client_contact_work       = $request->client_contact_work;
            $digitalsale->client_contact_mobile     = $request->client_contact_mobile;
            $digitalsale->client_email              = $request->client_email;
            $digitalsale->client_website            = $request->client_website;
            $digitalsale->setAttribute('ProjectStartDate', $request->project_start_date);
            $digitalsale->project_amount            = $request->project_amount;
            $digitalsale->project_minimum_agreed_term = $request->project_minimum_agreed_term;
            $digitalsale->setAttribute('ProjectServices', $request->project_services);
            $digitalsale->payment_type              = $request->payment_type;
            $digitalsale->payment_method            = $request->payment_method;
            $digitalsale->authorisation_date        = set_date_server($request->authorisation_date);
            $digitalsale->authorisation_signature   = $request->signature_first;
            $digitalsale->created_by                = \Auth::user()->id;
            $digitalsale->modified_by               = \Auth::user()->id;
            $digitalsale->save();

            $response = array();
            $response['code'] = 200;

            $_sub_total = $_gst_total = 0;

            if( !empty($digitalsale->id) ) {
                // now add the data to items table
                for ($i=0; $i < count($request->unit_price); $i++) {
                    // create new object
                    $item = new DigitalSalesItems;
                    $item->digital_sales_id     = $digitalsale->id;
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
                $digitalsale->sub_total = $_sub_total;
                $_gst_total = ( $_sub_total * get_gst_percentage() ) / 100;
                $digitalsale->gst_total = $_gst_total;
                $digitalsale->total_amt = $_sub_total + $_gst_total;
                $digitalsale->save();

                // update the lead status to sold
                $_lead = Lead::find($digitalsale->lead_id);
                if($_lead) {
                    $_lead->lead_status = 7;
                    $_lead->save();
                }

                $response['status'] = true;
                $response['msg'] = 'Digital Sales Form created Successfully';
                setflashmsg('Digital Sales Form created Successfully','1');
            } else {
                $response['status'] = false;
                $response['msg'] = 'Some error occured. Please try again';
                setflashmsg('Some error occured. Please try again','0');
            }
        }
        return view('forms.digitalsales',compact('leads','user_role_id', 'users'));
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

    public function leadSelect()
    {
        $lead_id = $_POST['lead_id'];
        $response = array();
        $response['code'] = 200;
        $data = Lead::find($lead_id);
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
